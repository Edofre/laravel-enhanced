<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => bcrypt('hunter'),
            'remember_token' => null,
            'created_at'     => $now,
            'updated_At'     => $now,
        ]);
    }
}
