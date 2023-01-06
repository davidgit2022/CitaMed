<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties =[
            'Neurología',
            'Quirúrgía',
            'Pediatría',
            'Cardiología',
            'Urología',
            'Medicina forense',
            'Dermatología',
        ];

        foreach ($specialties as $specialtyName) {
            $specialty = Specialty::create([
                'name' => $specialtyName,
            ]);

            $specialty->users()->saveMany(
                User::factory(4)->state(['role' => 'doctor'])->make()
            );
        }
        User::find(3)->specialties()->save($specialty);
    }
}
