<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
        $this->call('PositionSeeder');

        $this->command->info('Positions table seeded!');
	}

}

class PositionSeeder extends Seeder {

    public function run()
    {
        DB::table('positions')->delete();

        DB::table('positions')->insert(array(
            array('name'=>'Product Owner','updated_at'=>date('Y-m-d H:i:s'),'created_at'=>date('Y-m-d H:i:s')),
            array('name'=>'Scrum Master','updated_at'=>date('Y-m-d H:i:s'),'created_at'=>date('Y-m-d H:i:s')),
            array('name'=>'Developpeur','updated_at'=>date('Y-m-d H:i:s'),'created_at'=>date('Y-m-d H:i:s')),
        ));
    }

}