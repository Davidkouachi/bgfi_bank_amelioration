<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poste;

class PosteSeeder extends Seeder
{

    public function run()
    {
        Poste::create(['nom' => 'CONTRÔLEUR']);
        Poste::create(['nom' => 'OPÉRATEUR DE SAISIE']);
        Poste::create(['nom' => 'ADMINISTRATEUR']);
        Poste::create(['nom' => 'PRODUCTION']);
        Poste::create(['nom' => 'VALIDATEUR']);
    }
}
