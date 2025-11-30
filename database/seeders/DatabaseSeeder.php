<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Create sample customer
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);

        // Create rooms
        Room::create([
            'room_number' => '101',
            'type' => 'Single', 
            'price' => 99.99,
            'availability_status' => 'Available'
        ]);

        Room::create([
            'room_number' => '102', 
            'type' => 'Single',
            'price' => 99.99,
            'availability_status' => 'Available'
        ]);

        Room::create([
            'room_number' => '201',
            'type' => 'Double',
            'price' => 149.99,
            'availability_status' => 'Available'
        ]);

        Room::create([
            'room_number' => '202',
            'type' => 'Double', 
            'price' => 149.99,
            'availability_status' => 'Available'
        ]);

        Room::create([
            'room_number' => '301',
            'type' => 'Suite',
            'price' => 299.99,
            'availability_status' => 'Available'
        ]);
    }
}