<?php

use Illuminate\Database\Seeder;
use Seeder\DummySeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DummySeed::class);
    }
}
