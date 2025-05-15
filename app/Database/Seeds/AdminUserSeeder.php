<?php

namespace App\Database\Seeds;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $user = new User([
            'email'    => 'ilham@gmail.com',
            'username' => 'ilham',
            'password' => 'Password123',
            'first_name' => 'Ilham',
            'last_name' => ''
        ]);
        $userModel->insert($user);
        $userId = $userModel->getInsertID();

        $db = \Config\Database::connect();
        $db->table('auth_groups_users')->insert([
            'user_id'  => $userId,
            'group'    => 'admin',
        ]);
    }
}
