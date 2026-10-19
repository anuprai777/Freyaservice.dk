<?php

namespace Database\Seeders;

use App\Models\ClientProfile;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Account
        $admin = User::firstOrCreate(
            ['email' => 'admin@freyaservice.dk'],
            [
                'name' => 'Freya Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+45 70 20 30 40',
                'locale' => 'da',
                'gdpr_consent_at' => now(),
                'is_active' => true,
            ]
        );

        // 2. Client Account (Company)
        $clientUser = User::firstOrCreate(
            ['email' => 'client@hotel-nordic.dk'],
            [
                'name' => 'Lars Møller (Hotel Nordic)',
                'password' => Hash::make('password'),
                'role' => 'client',
                'phone' => '+45 33 12 34 56',
                'locale' => 'da',
                'gdpr_consent_at' => now(),
                'is_active' => true,
            ]
        );

        ClientProfile::firstOrCreate(
            ['user_id' => $clientUser->id],
            [
                'company_name' => 'Hotel Nordic A/S',
                'cvr' => '12345678',
                'address' => 'Vesterbrogade 42',
                'city' => 'København V',
                'postcode' => '1620',
                'contact_person' => 'Lars Møller',
                'phone' => '+45 33 12 34 56',
                'billing_email' => 'faktura@hotel-nordic.dk',
                'industry' => 'Hotel & Restauration',
                'status' => 'active',
                'notes' => 'Tidligere samarbejde på store konferencer og weekend-peaks.',
            ]
        );

        // 3. Worker Account
        $workerUser = User::firstOrCreate(
            ['email' => 'worker@freyaservice.dk'],
            [
                'name' => 'Mette Jensen',
                'password' => Hash::make('password'),
                'role' => 'worker',
                'phone' => '+45 20 11 22 33',
                'locale' => 'da',
                'gdpr_consent_at' => now(),
                'is_active' => true,
            ]
        );

        WorkerProfile::firstOrCreate(
            ['user_id' => $workerUser->id],
            [
                'skills' => ['Tjener', 'Bartender', 'Opvasker', 'Hotel Service', 'Rengøring'],
                'city' => 'København',
                'postcode' => '2100',
                'lat' => 55.6761,
                'lng' => 12.5683,
                'hourly_rate' => 195.00,
                'rating_avg' => 4.90,
                'ratings_count' => 18,
                'availability_type' => 'any',
                'status' => 'approved',
                'bank_reg_number' => '1234',
                'bank_account_number' => '1234567890',
                'notes' => 'Meget pålidelig, taler flydende dansk og engelsk.',
            ]
        );
    }
}
