<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Dropdown;
use App\Models\Map;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        User::create([
            'name' => 'admin',
            'password' => Hash::make('password'),
            'role' => '0',
        ]);

        User::create([
            'name' => 'user',
            'password' => Hash::make('password'),
            'role' => '1',
        ]);

        DB::table('dropdowns')->delete();
        DB::statement('ALTER TABLE dropdowns AUTO_INCREMENT = 1;');

        
        $dropdowns = [
            '0' => [
                'type' => ['sto'],
                'subtype' => ['ampel gading']
            ],
            '1' => [
                'type' => ['sto'],
                'subtype' => ['bantur']
            ],
            '2' => [
                'type' => ['sto'],
                'subtype' => ['batu']
            ],
            '3' => [
                'type' => ['sto'],
                'subtype' => ['blimbing']
            ],
            '4' => [
                'type' => ['sto'],
                'subtype' => ['buring']
            ],
            '5' => [
                'type' => ['sto'],
                'subtype' => ['dampit']
            ],
            '6' => [
                'type' => ['sto'],
                'subtype' => ['dono mulyo']
            ],
            '7' => [
                'type' => ['sto'],
                'subtype' => ['gadang']
            ],
            '8' => [
                'type' => ['sto'],
                'subtype' => ['gondanglegi']
            ],
            '9' => [
                'type' => ['sto'],
                'subtype' => ['gunung kawi']
            ],
            '10' => [
                'type' => ['sto'],
                'subtype' => ['karang ploso']
            ],
            '11' => [
                'type' => ['sto'],
                'subtype' => ['kepanjen']
            ],
            '12' => [
                'type' => ['sto'],
                'subtype' => ['klojen']
            ],
            '13' => [
                'type' => ['sto'],
                'subtype' => ['lawang']
            ],
            '14' => [
                'type' => ['sto'],
                'subtype' => ['malang']
            ],
            '15' => [
                'type' => ['sto'],
                'subtype' => ['malang kota']
            ],
            '16' => [
                'type' => ['sto'],
                'subtype' => ['ngantang']
            ],
            '17' => [
                'type' => ['sto'],
                'subtype' => ['pagak']
            ],
            '18' => [
                'type' => ['sto'],
                'subtype' => ['pakis']
            ],
            '19' => [
                'type' => ['sto'],
                'subtype' => ['sawojajar']
            ],
            '20' => [
                'type' => ['sto'],
                'subtype' => ['singosari']
            ],
            '21' => [
                'type' => ['sto'],
                'subtype' => ['sumber manjing']
            ],
            '22' => [
                'type' => ['sto'],
                'subtype' => ['sumber pucung']
            ],
            '23' => [
                'type' => ['sto'],
                'subtype' => ['tumpang']
            ],
            '24' => [
                'type' => ['sto'],
                'subtype' => ['turen']
            ],
            '25' => [
                'type' => ['room'],
                'subtype' => ['Rectifier']
            ],
            '26' => [
                'type' => ['room'],
                'subtype' => ['NGN']
            ],
            '27'=> [
                'type'=> ['room'],
                'subtype'=> ['Metro']
            ],
        
            
        ];

        foreach ($dropdowns as $dropdown) {
            foreach ($dropdown['type'] as $type) {
                foreach ($dropdown['subtype'] as $subtype) {
                    Dropdown::create([
                        'type' => $type,
                        'subtype' => ucfirst($subtype),
                    ]);
                }
            }
        }
    }
}
