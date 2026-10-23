<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    private const ADMIN_EMAIL = 'admin@bpbdbandung.test';

    private const ADMIN_PASSWORD = 'Admin12345';

    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');

        for ($number = 1; $number <= 5; $number++) {
            User::updateOrCreate(
                ['email' => sprintf('petugas%02d@bpbdbandung.test', $number)],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('Petugas123'),
                ],
            );
        }

        User::updateOrCreate(
            ['email' => self::ADMIN_EMAIL],
            [
                'name' => 'Admin BPBD',
                'password' => Hash::make(self::ADMIN_PASSWORD),
            ],
        );
    }
}
