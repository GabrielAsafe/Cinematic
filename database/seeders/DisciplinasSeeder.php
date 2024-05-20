<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinasSeeder extends Seeder
{
    public function run()
    {
        DB::table('disciplinas')->truncate();
        $this->loadFromJson();
    }

    private function loadFromJson()
    {
        $this->command->line('--- > Criar Disciplinas');
        DB::table('disciplinas')->truncate();

        $disciplinasFromJSONFile = json_decode(file_get_contents(database_path('seeders/data') . "/todas_disciplinas.json"), true);
        DB::table('disciplinas')->insert($disciplinasFromJSONFile);
    }
}
