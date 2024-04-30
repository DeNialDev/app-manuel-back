<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'id' => '1',
                'email' => 'admin@manuelapp.com.mx',
            ],
        ];

        foreach ($users as $user) {
            User::withTrashed()->firstOrCreate(['id' => $user['id']], $user);
        }
    }
}
