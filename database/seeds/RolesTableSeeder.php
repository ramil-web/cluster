<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('roles')->insert([
            [
                'name'         => 'super',
                'display_name' => 'Супер администратор',
                'description'  => 'Роль супер админа',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Администратор',
                'description'  => 'Роль админа',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'name'         => 'editor',
                'display_name' => 'Редактор',
                'description'  => 'Роль редактора',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

        ]);
    }
}
