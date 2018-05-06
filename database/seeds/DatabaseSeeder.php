<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(KlassesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
		$this->call(FileuploadsTableSeeder::class);	
		$this->call(TopicsTableSeeder::class);
        $this->call(ReplysTableSeeder::class);
    }
}
