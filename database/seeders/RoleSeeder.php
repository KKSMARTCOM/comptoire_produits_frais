<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        //créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'utilisateur']);
        $superAdminRole = Role::create(['name' => 'superadmin']);

        // Créer un utilisateur d'exemple pour Super Admin
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('supadmin'), // Utilise un mot de passe sécurisé
            ]);
        }

        // Assigner le rôle de superadmin à cet utilisateur
        $superAdmin->assignRole($superAdminRole);
    }
}
