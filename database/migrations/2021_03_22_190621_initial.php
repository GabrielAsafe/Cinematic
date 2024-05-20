<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('abreviatura', 20);
            $table->string('nome');
            $table->enum('tipo', ['Licenciatura', 'Mestrado', 'Curso Técnico Superior Profissional']);
            $table->integer('semestres');
            $table->integer('ECTS');
            $table->integer('vagas');
            $table->string('contato');
            $table->text('objetivos');

            $table->primary('abreviatura');
        });

        Schema::create('disciplinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('curso', 20);
            $table->integer('ano');
            $table->integer('semestre');
            $table->string('abreviatura', 20);
            $table->string('nome');
            $table->integer('ECTS');
            $table->integer('horas');
            $table->boolean('opcional')->default(false);

            $table->foreign('curso')->references('abreviatura')->on('cursos');
        });

        Schema::create('candidaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('curso', 20);
            $table->string('nome');
            $table->string('email');
            $table->string('telefone1', 20)->nullable();
            $table->string('telefone2', 20)->nullable();
            $table->enum('genero', ['M', 'F']);
            $table->decimal('media', 4, 2);
            $table->boolean('m23')->default(false);
            $table->enum('origem', ['P', 'UE', 'O']);
            $table->text('obs')->nullable();

            $table->foreign('curso')->references('abreviatura')->on('cursos');
        });

        Schema::create('candidaturas_estatutos', function (Blueprint $table) {
            $table->unsignedBigInteger('candidatura_id');
            $table->enum('estatuto', ['TE', 'NE', 'E']);
            $table->boolean('pretende')->default(false);

            $table->primary(['candidatura_id', 'estatuto']);
            $table->foreign('candidatura_id')->references('id')->on('candidaturas');
        });

        Schema::create('departamentos', function (Blueprint $table) {
            $table->string('abreviatura', 20);
            $table->string('nome');

            $table->primary('abreviatura');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('admin')->default(false);
            // Types D- Docente; A- Aluno; O= Outro
            $table->enum('tipo', ['D', 'A', 'O']);
            $table->enum('genero', ['M', 'F']);
            $table->string('url_foto')->nullable();
        });

        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('departamento', 20);
            $table->string('gabinete', 50)->nullable();
            $table->string('extensao', 20)->nullable();
            $table->string('cacifo', 20)->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('departamento')->references('abreviatura')->on('departamentos');
        });


        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('numero', 20);
            $table->string('curso', 20);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('curso')->references('abreviatura')->on('cursos');
        });

        Schema::create('docentes_disciplinas', function (Blueprint $table) {
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->boolean('responsavel')->default(false);

            $table->primary(['docente_id', 'disciplina_id']);
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });

        Schema::create('alunos_disciplinas', function (Blueprint $table) {
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->boolean('repetente')->default(false);

            $table->primary(['aluno_id', 'disciplina_id']);
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos_disciplinas');
        Schema::dropIfExists('docentes_disciplinas');
        Schema::dropIfExists('alunos');
        Schema::dropIfExists('docentes');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['admin', 'tipo', 'genero', 'url_foto']);
        });
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('candidaturas_estatutos');
        Schema::dropIfExists('candidaturas');
        Schema::dropIfExists('disciplinas');
        Schema::dropIfExists('cursos');
    }
}
