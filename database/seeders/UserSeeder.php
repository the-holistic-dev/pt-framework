<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $admin = User::create(['name' => 'Admin', 'email' => 'admin@email.com', 'password' => Hash::make('Pa$$word')]);
    $admin->assignRole('Admin');
    $trainer = User::create(['name' => 'Trainer', 'email' => 'trainer@email.com', 'password' => Hash::make('Pa$$word')]);
    $trainer->assignRole('Trainer');
    $client = User::create(['name' => 'Client', 'email' => 'client@email.com', 'password' => Hash::make('Pa$$word')]);
    $client->assignRole('Client');
    $client->trainer_id = $trainer->id;
    $client->save();
  }
}
