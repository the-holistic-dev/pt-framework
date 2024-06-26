<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Permission::create(['name' => 'create-users']);
    Permission::create(['name' => 'edit-users']);
    Permission::create(['name' => 'delete-users']);

    Permission::create(['name' => 'create-trainings']);
    Permission::create(['name' => 'edit-trainings']);
    Permission::create(['name' => 'delete-trainings']);

    $superAdminRole = Role::create(['name' => 'Super Admin']);
    $adminRole = Role::create(['name' => 'Admin']);
    $trainerRole = Role::create(['name' => 'Trainer']);
    $clientRole = Role::create(['name' => 'Client']);

    $trainerRole->givePermissionTo([
      'create-users',
      'create-trainings',
      'edit-trainings',
      'delete-trainings',
    ]);
  }
}
