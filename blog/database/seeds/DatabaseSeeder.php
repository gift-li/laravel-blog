<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Sequence of seeding is important. Or it would fail on creating data that has foreign keys
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
