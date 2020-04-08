<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)->create()->each(function ($user) {
	        $user->ticket()->save(factory(App\Ticket::class)->make());
	    });
    }
}
