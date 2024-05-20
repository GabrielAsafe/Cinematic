<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    private $total_users_docentes_dei = 100;
    private $total_users_docentes_outros = 20;
    private $total_outros_users = 20;
    private $total_users_alunos = 800;
    private $photoPath = 'public/fotos';
    private $files_M = [];
    private $files_F = [];
    private $files_X = [];
    private $used_emails = [
        'marco.monteiro@ipleiria.pt',
        'eduardo.silva@ipleiria.pt',
        'eugenia.bernardino@ipleiria.pt',
        'telmo.marques@ipleiria.pt'
    ];
    private $cursos = [];
    private $outros_departamentos = [];

    public function run()
    {
        $this->command->line('--- > Criar Users');

        DB::table('docentes_disciplinas')->truncate();
        DB::table('alunos_disciplinas')->truncate();
        DB::table('docentes')->truncate();
        DB::table('alunos')->truncate();
        DB::table('users')->truncate();

        Storage::deleteDirectory($this->photoPath);
        Storage::makeDirectory($this->photoPath);

        // Preencher files_M com fotos de Homens e files_F com fotos de mulheres
        $allFiles = collect(File::files(database_path('seeders/fotos')));
        foreach ($allFiles as $f) {
            if (strpos($f->getPathname(), 'M_')) {
                $this->files_M[] = $f->getPathname();
            } elseif (strpos($f->getPathname(), 'W_')) {
                $this->files_F[] = $f->getPathname();
            } elseif (strpos($f->getPathname(), 'X_')) {
                $this->files_X[] = $f->getPathname();
            }
        }

        // Podia ir à base de dados buscar os cursos:
        //$this->cursos = DB::table('cursos')->pluck('abreviatura');
        // Mas vou definir à mão, para mudar probabilidades:
        $this->cursos = [
            'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI', 'EI',
            'JDM', 'JDM', 'JDM', 'JDM', 'JDM',
            'MEI-CM', 'MEI-CM',
            'MCIF',
            'TESP-DWM', 'TESP-DWM',
            'TESP-PSI', 'TESP-PSI', 'TESP-PSI',
            'TESP-RSI', 'TESP-RSI',
            'TESP-TI'
        ];

        $this->outros_departamentos = DB::table('departamentos')->where('abreviatura', '<>', 'DEI')->pluck('abreviatura');



        $faker = \Faker\Factory::create('pt_PT');

        // Primeiro USER é sempre admin, com email sys@mail.pt
        $newUser = $this->newFakerUser($faker, 'O');
        $newUser['email'] = "sys@ipleiria.pt";
        $newUser['admin'] = true;
        $newId = DB::table('users')->insertGetId($newUser);

        $docenteAInet = -1;
        $userAInet = -1;
        $userAInetIDs = [];
        $docentesAInetIDs = [];

        for ($i = 0; $i < $this->total_users_docentes_dei; $i++) {
            $newIds = $this->newFakerDocente($faker, 'DEI');
            $changedUserData = [];
            $changedDocenteData = [];
            switch ($i) {
                case 0:
                    $docenteAInet = $newIds['docente_id'];
                    $userAInet = $newIds['user_id'];
                    $changedUserData['name'] = 'Marco António de Oliveira Monteiro';
                    $changedUserData['email'] = 'marco.monteiro@ipleiria.pt';
                    $changedUserData['genero'] = 'M';
                    $changedUserData['admin'] = true;
                    $changedDocenteData['gabinete'] = 'G.15-12';
                    $changedDocenteData['extensao'] = '203166';
                    $changedDocenteData['cacifo'] = 'A069';
                    break;
                case 1:
                    $docenteAInet = $newIds['docente_id'];
                    $userAInet = $newIds['user_id'];
                    $changedUserData['name'] = 'Eduardo Manuel Caetano da Silva';
                    $changedUserData['email'] = 'eduardo.silva@ipleiria.pt';
                    $changedUserData['genero'] = 'M';
                    $changedDocenteData['gabinete'] = 'D.S.02.48';
                    break;
                case 2:
                    $docenteAInet = $newIds['docente_id'];
                    $userAInet = $newIds['user_id'];
                    $changedUserData['name'] = 'Eugénia Moreira Bernardino';
                    $changedUserData['email'] = 'eugenia.bernardino@ipleiria.pt';
                    $changedUserData['genero'] = 'F';
                    $changedDocenteData['gabinete'] = 'G.1.5.11';
                    $changedDocenteData['extensao'] = '203167';
                    $changedDocenteData['cacifo'] = 'A064';
                    break;
                case 3:
                    $docenteAInet = $newIds['docente_id'];
                    $userAInet = $newIds['user_id'];
                    $changedUserData['name'] = 'Telmo Filipe Moreira Marques';
                    $changedUserData['email'] = 'telmo.marques@ipleiria.pt';
                    $changedUserData['genero'] = 'M';
                    $changedDocenteData['gabinete'] = 'G.L. 2.7';
                    $changedDocenteData['extensao'] = '203149';
                    break;
            }
            if ($changedUserData) {
                $userAInetIDs[] = $userAInet;
                DB::table('users')->where('id', $userAInet)->update($changedUserData);
            }
            if ($changedDocenteData) {
                $docentesAInetIDs[] = $docenteAInet;
                DB::table('docentes')->where('id', $docenteAInet)->update($changedDocenteData);
            }
            if ($i % 10 === 0) {
                $this->command->line('Criado docente do DEI ' . ($i + 1) . '/' . $this->total_users_docentes_dei);
            }
        }

        for ($i = 0; $i < $this->total_users_docentes_outros; $i++) {
            $this->newFakerDocente($faker, $faker->randomElement($this->outros_departamentos));
            if ($i % 10 === 0) {
                $this->command->line('Criado docente de outro departamento (<> DEI) ' . ($i + 1) . '/' . $this->total_users_docentes_outros);
            }
        }

        for ($i = 0; $i < $this->total_outros_users; $i++) {
            $newUser = $this->newFakerUser($faker, 'O');
            DB::table('users')->insert($newUser);

            if ($i % 10 === 0) {
                $this->command->line('Criado outro user (não docente/não aluno) ' . ($i + 1) . '/' . $this->total_outros_users);
            }
        }

        for ($i = 0; $i < $this->total_users_alunos; $i++) {
            $this->newFakerAluno($faker);
            if ($i % 10 === 0) {
                $this->command->line('Criado aluno ' . ($i + 1) . '/' . $this->total_users_alunos);
            }
        }

        // FOTOS:
        //$userAInetIDs[]
        shuffle($this->files_M);
        shuffle($this->files_F);

        $todos_users_O = DB::table('users')->where('tipo', 'O')->pluck('genero', 'id');
        $todos_users_D = DB::table('users')->where('tipo', 'D')->whereNotIn('id', $userAInetIDs)->pluck('genero', 'id');
        $todos_users_A = DB::table('users')->where('tipo', 'A')->pluck('genero', 'id');

        // Primeiros 5 users Outros, 10 docentes, 20 alunos têm sempre foto.
        $i = 1;
        foreach ($todos_users_O as $user_id => $genero) {
            $file = $genero == 'M' ? array_shift($this->files_M) : array_shift($this->files_F);
            $this->savePhotoOfUser($user_id, $file);
            $i++;
            if ($i >= 5) {
                break;
            }
        }
        $i = 1;
        foreach ($todos_users_D as $user_id => $genero) {
            $file = $genero == 'M' ? array_shift($this->files_M) : array_shift($this->files_F);
            $this->savePhotoOfUser($user_id, $file);
            $i++;
            if ($i >= 10) {
                break;
            }
        }
        $i = 1;
        foreach ($todos_users_A as $user_id => $genero) {
            $file = $genero == 'M' ? array_shift($this->files_M) : array_shift($this->files_F);
            $this->savePhotoOfUser($user_id, $file);
            $i++;
            if ($i >= 20) {
                break;
            }
        }

        $todos_users = DB::table('users')->whereNull('url_foto')->whereNotIn('id', $userAInetIDs)->orderByRaw('RAND()')->pluck('genero', 'id');

        foreach ($todos_users as $user_id => $genero) {
            if (!($this->files_M || $this->files_F)) {
                break;
            }
            $file = null;
            if ($genero == 'M' && $this->files_M) {
                $file = array_shift($this->files_M);
            } elseif ($genero == 'F' && $this->files_F) {
                $file = array_shift($this->files_F);
            }
            if ($file) {
                $this->savePhotoOfUser($user_id, $file);
            }
        }


        foreach ($this->files_X as $file) {
            $prefixoIdx = strpos($file, 'X_');
            if ($prefixoIdx) {
                $idx = substr($file, $prefixoIdx + 2, 1);
                $this->savePhotoOfUser($userAInetIDs[$idx], $file);
            }
        }


        $ainet = DB::table('disciplinas')->where('curso', 'EI')->where('abreviatura', 'AI')->pluck('id')[0];

        $i = 0;
        foreach ($docentesAInetIDs as $docenteID) {
            $docenteDisc = [
                'docente_id' => $docenteID,
                'disciplina_id' => $ainet,
                'responsavel' => false
            ];
            if ($i == 0) {
                $docenteDisc['responsavel'] = true;
            }
            $i++;
            DB::table('docentes_disciplinas')->insert($docenteDisc);
        }

        $disciplinas = DB::table('disciplinas')->where('id', '<>', $ainet)->pluck('id');

        $todos_docentes = DB::table('docentes')->pluck('id');

        $todos_alunos = DB::table('alunos')->pluck('id');

        $contadorDisc = 1;
        $totalDisc = count($disciplinas);
        foreach ($disciplinas as $disc) {
            $docentesDisc = [];
            $numDocentes = $faker->randomElement([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 4, 5]);
            $docentes = $faker->randomElements($todos_docentes, $numDocentes);
            $i = 0;
            foreach ($docentes as $docente) {
                $docentesDisc[] = [
                    'docente_id' => $docente,
                    'disciplina_id' => $disc,
                    'responsavel' => $i === 0 ? true : false
                ];
                $i++;
            }
            DB::table('docentes_disciplinas')->insert($docentesDisc);

            $alunosDisc = [];
            $alunos = $faker->randomElements($todos_alunos, random_int(4, 100));
            foreach ($alunos as $aluno) {
                $alunosDisc[] = [
                    'aluno_id' => $aluno,
                    'disciplina_id' => $disc,
                    'repetente' => random_int(1, 4) === 2 ? true : false
                ];
            }

            DB::table('alunos_disciplinas')->insert($alunosDisc);

            $this->command->line('Criadas associações com docentes e alunos para disciplina ' . ($contadorDisc) . '/' . $totalDisc);
            $contadorDisc++;
        }
    }

    private function savePhotoOfUser($user_id, $file)
    {
        $targetDir = storage_path('app/' . $this->photoPath);
        $newfilename = $user_id . "_" . uniqid() . '.jpg';
        File::copy($file, $targetDir . '/' . $newfilename);
        DB::table('users')->where('id', $user_id)->update(['url_foto' => $newfilename]);
        $this->command->info("Updated Foto of User $user_id.");
    }

    private function newFakerDocente($faker, $departamento)
    {
        $newUser = $this->newFakerUser($faker, 'D');
        $newId = DB::table('users')->insertGetId($newUser);

        $docente = [
            'user_id' => $newId,
            'departamento' => $departamento,
            'gabinete' => 'G-' . rand(1, 3) . '.' . rand(1, 30),
            'extensao' => '203' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
            'cacifo' => 'A' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT)
        ];

        $newIdDocente = DB::table('docentes')->insertGetId($docente);
        return ['user_id' => $newId, 'docente_id' => $newIdDocente];
    }

    private function newFakerAluno($faker)
    {
        $newUser = $this->newFakerUser($faker, 'A');
        $newId = DB::table('users')->insertGetId($newUser);

        $aluno = [
            'user_id' => $newId,
            'numero' => '21' . rand(5, 9) .  str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'curso' => $faker->randomElement($this->cursos),
        ];

        $newIdAluno = DB::table('alunos')->insertGetId($aluno);
        return ['user_id' => $newId, 'aluno_id' => $newIdAluno];
    }

    private function newFakerUser($faker, $tipo)
    {
        $email = "";
        $genero = "";
        $sufixoMail = $tipo == 'A' ? "@mail.pt" : "@ipleiria.pt";
        $name = $this->randomName($faker, $genero, $email, $sufixoMail);
        $createdAt = $faker->dateTimeBetween('-10 years', '-3 months');
        $email_verified_at = $faker->dateTimeBetween($createdAt, '-2 months');
        $updatedAt = $faker->dateTimeBetween($email_verified_at, '-1 months');
        return [
            'email' => $email,
            'name' => $name,
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
            'email_verified_at' => $email_verified_at,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'tipo' => $tipo,
            'admin' => false,
            'genero' => $genero,    // This will not be saved on DB
        ];
    }

    private function stripAccents($stripAccents)
    {
        $from = 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ';
        $to =   'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY';
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($stripAccents, $mapping);
    }

    private function strtr_utf8($str, $from, $to)
    {
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);
    }

    private function randomName($faker, &$genero, &$email, $sufixoMail)
    {
        $genero = $faker->randomElement(['male', 'female']);
        $firstname = $faker->firstName($genero);
        $lastname = $faker->lastName();
        $secondname = $faker->numberBetween(1, 3) == 2 ? "" : " " . $faker->firstName($genero);
        $number_middlenames = $faker->numberBetween(1, 6);
        $number_middlenames = $number_middlenames == 1 ? 0 : ($number_middlenames >= 5 ? $number_middlenames - 3 : 1);
        $middlenames = "";
        for ($i = 0; $i < $number_middlenames; $i++) {
            $middlenames .= " " . $faker->lastName();
        }
        $fullname = $firstname . $secondname . $middlenames . " " . $lastname;

        $email = strtolower($this->stripAccents($firstname) . "." . $this->stripAccents($lastname) . $sufixoMail);
        $i = 2;
        while (in_array($email, $this->used_emails)) {
            $email = strtolower($this->stripAccents($firstname) . "." . $this->stripAccents($lastname) . "." . $i . $sufixoMail);
            $i++;
        }
        $this->used_emails[] = $email;
        $genero = $genero == 'male' ? 'M' : 'F';
        return $fullname;
    }
}
