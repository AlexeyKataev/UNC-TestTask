<?php

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
        $nowTms = new DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $users = [
            [
                'user_role_id' => '1',
                'email' => 'admin@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => 'empty',
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '2',
                'email' => 'marketer1@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameFemale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '2',
                'email' => 'marketer2@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameMale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '3',
                'email' => 'user1@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameFemale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '3',
                'email' => 'user2@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameMale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '3',
                'email' => 'user3@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameMale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '3',
                'email' => 'user4@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameFemale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '3',
                'email' => 'user5@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameFemale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
            [
                'user_role_id' => '4',
                'email' => 'locked@unicorn.ru',
                'second_name' => 'empty',
                'first_name' => Faker\Provider\ru_RU\Person::firstNameMale(),
                'middle_name' => 'empty',
                'email_verified_at' => $nowTms,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'consent_to_the_processing_of_personal_data' => TRUE,
            ],
        ];

        foreach ($users as $user)
        {
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'user_role_id' => $user['user_role_id'],
                'email' => $user['email'],
                'second_name' => $user['second_name'],
                'first_name' => $user['first_name'],
                'middle_name' => $user['middle_name'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => $user['password'],
                'consent_to_the_processing_of_personal_data' => $user['consent_to_the_processing_of_personal_data'],
            ]);
        }
    }
}
