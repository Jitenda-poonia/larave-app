<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $faker = Faker::create();
        for ($i=1; $i <= 10 ; $i++) { 
            $data= [
            "first_name" => $faker->name,
            "last_name" => $faker->name,
            "email" => $faker->email,
            "phone" => $faker->numberBetween($min = 1000000000, $max = 9999999999),
            "gender" => "m",
            "address" => $faker->address,
            "city" => $faker->city,
            "pincode" => $faker->numberBetween($min = 100000, $max = 999999),
            "dob" => $faker->date
            ];
            Student::create($data);
        }
    }
}
