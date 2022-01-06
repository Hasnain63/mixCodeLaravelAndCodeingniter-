<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin Testing',
                'email' => 'admin@app.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Supervisor Testing',
                'email' => 'supervisor@app.com',
                'role' => 'supervisor',
            ],
            [
                'name' => 'Group Testing',
                'email' => 'group@app.com',
                'role' => 'group',
            ],
        ];

        foreach ($users as $user) {
            $u = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt('Pa$$w0rd!'),
            ]);
            if (isset($user['role'])) {
                $role = Role::findByName($user['role']);
                $u->assignRole($role);
                if ($user['role'] == 'supervisor') {
                    Supervisor::create(['user_id' => $u->id]);
                }
            }
        }
    }
}
