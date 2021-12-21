<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'name' => 'r_admin', ],
            [ 'name' => 'r_marketer', ],
            [ 'name' => 'r_user', ],
            [ 'name' => 'r_locked', ],
        ];

        foreach ($roles as $role)
        {
            \Illuminate\Support\Facades\DB::table('user_roles')->insert([
                'name' => $role['name'],
            ]);
        }
    }
}
