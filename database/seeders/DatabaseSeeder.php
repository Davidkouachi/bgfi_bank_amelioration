<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poste;
use App\Models\Autorisation;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PosteSeeder::class);

        // Insérer des utilisateurs avec un ID de poste spécifique
        $poste1 = Poste::where('nom', 'ADMINISTRATEUR')->first();

        $user = User::create([
            'name' => 'David Kouachi',
            'email' => 'david@gmail.com',
            'password' => bcrypt('12345'),
            'matricule' => 'C123456',
            'tel' => '0585782723',
            'poste_id' => $poste1->id,
        ]);

        $auto = Autorisation::create([
            'new_user' => 'oui',
            'new_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',
            'new_proces' => 'non',
            'list_proces' => 'non',
            'new_recla' => 'non',
            'list_recla' => 'non',
            'list_cause' => 'non',
            'suivi_act' => 'non',
            'act_eff' => 'non',
            'list_act' => 'non',
            'user_id' => $user->id,
        ]);

    }
}
