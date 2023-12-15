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
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',
            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'new_recla' => 'oui',
            'list_recla' => 'oui',
            'list_cause' => 'oui',
            'suivi_act' => 'oui',
            'act_eff' => 'oui',
            'list_act' => 'oui',
            'user_id' => $user->id,
        ]);

    }
}
