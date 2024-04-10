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
        $poste1 = Poste::where('nom', '=', 'ADMINISTRATEUR')->first();

        $user1 = User::create([
            'name' => 'David Kouachi',
            'email' => 'david@gmail.com',
            'password' => bcrypt('David001'),
            'matricule' => 'C123456',
            'tel' => '0585782723',
            'poste_id' => $poste1->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto1 = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',

            'new_recla' => 'oui',
            'verif_recla' => 'oui',
            'recla_non_a' => 'oui',
            'list_recla' => 'oui',

            'list_cause' => 'oui',
            'list_r_r' => 'oui',

            'controle_action' => 'oui',
            'list_action' => 'oui',

            'user_id' => $user1->id,
        ]);


        //-------------------------------------------------------------------------------------------


        // Insérer des utilisateurs avec un ID de poste spécifique
        $poste2 = Poste::where('nom', '=', 'ESCALADEUR')->first();

        $user2 = User::create([
            'name' => 'Chris Emmanuel',
            'email' => 'chris@gmail.com',
            'password' => bcrypt('Chris001'),
            'matricule' => 'C1234567',
            'tel' => '0102514392',
            'poste_id' => $poste2->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

    }
}
