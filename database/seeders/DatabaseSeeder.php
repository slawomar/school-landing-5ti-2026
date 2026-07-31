<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminEmail = 'admin@example.com';

        User::create([
            'name' => 'Administrator',
            'email' => $adminEmail,
            'password' => Hash::make('TajneHasloAdmina123!'),
            'role' => 'admin',
        ]);

        // Wygenerowanie bezpiecznego tokena resetu hasła
        $rawToken = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $adminEmail],
            [
                'token' => Hash::make($rawToken),
                'created_at' => now(),
            ]
        );

        $this->command->info("Pomyślnie zasiano użytkownika admina!");
        $this->command->warn("Twój jawny token do resetu hasła: {$rawToken}");
    }
}