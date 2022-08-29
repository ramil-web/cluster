<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_role')->insert([
            [
                'admin_id' => '1',
                'role_id'  => '1',
            ],
        ]);
    }
}
