<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidaturasSeeder extends Seeder
{
    private $total_candidaturas = 320;
    private $cursos = [];
    private $used_emails = [];

    public function run()
    {
        $this->command->line('--- > Criar Candidaturas');
        DB::table('candidaturas')->truncate();
        DB::table('candidaturas_estatutos')->truncate();

        $faker = \Faker\Factory::create('pt_PT');

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

        for ($i = 0; $i < $this->total_candidaturas; $i++) {
            $newCandidatura = $this->newFakerCandidatura($faker);
            $newID = DB::table('candidaturas')->insertGetId($newCandidatura);
            DB::table('candidaturas_estatutos')->insert(
                [
                    [
                        'candidatura_id' => $newID,
                        'estatuto' => 'TE',
                        'pretende' => mt_rand(1, 10) == 1 ? true : false
                    ],
                    [
                        'candidatura_id' => $newID,
                        'estatuto' => 'NE',
                        'pretende' => mt_rand(1, 10) == 1 ? true : false
                    ],
                    [
                        'candidatura_id' => $newID,
                        'estatuto' => 'E',
                        'pretende' => mt_rand(1, 10) == 1 ? true : false
                    ]
                ]
            );
        }
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

    private function newFakerCandidatura($faker)
    {
        $email = "";
        $genero = "";
        $name = $this->randomName($faker, $genero, $email, '@gmail.pt');

        return [
            'curso' => $faker->randomElement($this->cursos),
            'nome' => $name,
            'email' => $email,
            'telefone1' => $faker->phoneNumber,
            'telefone2' => mt_rand(1, 4) == 1 ? $faker->phoneNumber : null,
            'genero' => $genero,
            'media' => $faker->randomFloat(2, 9.5, 20),
            'm23' => mt_rand(1, 10) == 1 ? true : false,
            'origem' => mt_rand(1, 10) == 1 ? $faker->randomElement(['UE', 'O']) : 'P',
            'obs' => mt_rand(1, 5) == 1 ? $faker->realText() : null,
        ];
    }
}
