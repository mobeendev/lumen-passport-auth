<?php

use Illuminate\Database\Seeder;

class temp_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Abdul Mobeen',
            'email' => 'mobeen@rocketmail.com',
            'password' => password_hash('abc123', PASSWORD_BCRYPT)
        ]);
        factory(App\User::class)->create([
            'name' => 'James Jones',
            'email' => 'jesse@breakingbad.com',
            'password' => password_hash('chilli_powder', PASSWORD_BCRYPT)
        ]);
    }
}
