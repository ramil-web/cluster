<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('permissions')->insert([
            [
                'name'         => 'admin',
                'display_name' => 'Администрировать',
                'description'  => 'Права админа',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'name'         => 'edit',
                'display_name' => 'Редактировать',
                'description'  => 'Права редактора',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

        ]);
    }
}
