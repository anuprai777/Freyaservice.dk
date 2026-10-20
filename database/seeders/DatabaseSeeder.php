<?php

namespace Database\Seeders;

use App\Models\ClientProfile;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * All accounts share the same email and password: freyaservicevikar@gmail.com
     * Password is written via DB::table() to bypass the Eloquent 'hashed' cast
     * (which would otherwise double-hash the value and break login).
     */
    public function run(): void
    {
        $email    = 'freyaservicevikar@gmail.com';
        $hashedPw = Hash::make('freyaservicevikar@gmail.com');

        // 1. Admin Account
        $admin = User::updateOrCreate(
            ['role' => 'admin'],
            [
                'name'            => 'Freya Admin',
                'email'           => $email,
                'password'        => 'temp',
                'phone'           => '+45 70 20 30 40',
                'locale'          => 'da',
                'gdpr_consent_at' => now(),
                'is_active'       => true,
            ]
        );

        // 2. Client Account (Company)
        $clientUser = User::updateOrCreate(
            ['role' => 'client'],
            [
                'name'            => 'Lars Møller (Hotel Nordic)',
                'email'           => $email,
                'password'        => 'temp',
                'phone'           => '+45 33 12 34 56',
                'locale'          => 'da',
                'gdpr_consent_at' => now(),
                'is_active'       => true,
            ]
        );

        ClientProfile::firstOrCreate(
            ['user_id' => $clientUser->id],
            [
                'company_name'   => 'Hotel Nordic A/S',
                'cvr'            => '12345678',
                'address'        => 'Vesterbrogade 42',
                'city'           => 'København V',
                'postcode'       => '1620',
                'contact_person' => 'Lars Møller',
                'phone'          => '+45 33 12 34 56',
                'billing_email'  => $email,
                'industry'       => 'Hotel & Restauration',
                'status'         => 'active',
                'notes'          => 'Tidligere samarbejde på store konferencer og weekend-peaks.',
            ]
        );

        // 3. Worker Account
        $workerUser = User::updateOrCreate(
            ['role' => 'worker'],
            [
                'name'            => 'Mette Jensen',
                'email'           => $email,
                'password'        => 'temp',
                'phone'           => '+45 20 11 22 33',
                'locale'          => 'da',
                'gdpr_consent_at' => now(),
                'is_active'       => true,
            ]
        );

        WorkerProfile::firstOrCreate(
            ['user_id' => $workerUser->id],
            [
                'skills'              => ['Tjener', 'Bartender', 'Opvasker', 'Hotel Service', 'Rengøring'],
                'city'                => 'København',
                'postcode'            => '2100',
                'lat'                 => 55.6761,
                'lng'                 => 12.5683,
                'hourly_rate'         => 195.00,
                'rating_avg'          => 4.90,
                'ratings_count'       => 18,
                'availability_type'   => 'any',
                'status'              => 'approved',
                'bank_reg_number'     => '1234',
                'bank_account_number' => '1234567890',
                'notes'               => 'Meget pålidelig, taler flydende dansk og engelsk.',
            ]
        );

        // Write the real password hash directly via DB::table() to bypass the
        // Eloquent 'hashed' cast (which would otherwise double-hash the value).
        // Also mark all seed accounts as email-verified so login works immediately.
        DB::table('users')
            ->whereIn('role', ['admin', 'client', 'worker'])
            ->update([
                'password'          => $hashedPw,
                'email_verified_at' => now(),
            ]);
    }
}
