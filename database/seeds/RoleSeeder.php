<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
        ]);

        Role::create([
            'name' => 'Usuario',
        ]);

        Role::create([
            'name' => 'Cliente',
        ]);
    }
}
