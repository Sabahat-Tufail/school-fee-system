<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['name' => 'Sabahat Tufail', 'email' => '23pwcse2236@uetpeshawar.edu.pk'],
            ['name' => 'Kashaf Zahid', 'email' => '23pwcse2259@uetpeshawar.edu.pk'],
            ['name' => 'Ahlam Orakzai', 'email' => '23pwcse2333@uetpeshawar.edu.pk'],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make('123456'),
                    'role' => 'admin',
                    'roll_number' => null,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
