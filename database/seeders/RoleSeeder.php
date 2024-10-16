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
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'utilisateur']);

        // Créer un utilisateur d'exemple pour Super Admin
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('P@sswor1'), // Utilise un mot de passe sécurisé
            ]);
        }

        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Administrateur',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Adm1n$'), // Utilise un mot de passe sécurisé
            ]);
        }

        // Assigner le rôle de superadmin à cet utilisateur
        $superAdmin->assignRole($superAdminRole);

        // Assigner le rôle de superadmin à cet utilisateur
        $admin->assignRole($adminRole);
    }
}
