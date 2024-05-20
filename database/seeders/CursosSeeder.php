<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    public function run()
    {
        DB::table('cursos')->truncate();
        $this->loadFromJson();
    }

    private function loadFromJson()
    {
        $this->command->line('--- > Criar Cursos');
        DB::table('cursos')->truncate();

        $cursosFromJSONFile = json_decode(file_get_contents(database_path('seeders/data') . "/cursos.json"), true);
        DB::table('cursos')->insert($cursosFromJSONFile);
    }
}
