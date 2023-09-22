<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Career;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $gender = [
        //     [
        //         'gender_name' => 'Male'
        //     ],
        //     [
        //         'gender_name' => 'Female'
        //     ]
        // ];

        // $career = [
        //     [
        //         'career_name' => 'Students'
        //     ],
        //     [
        //         'career_name' => 'Bussiness Owner'
        //     ]
        // ];

        // foreach($gender as $key => $value){
        //     Gender::create($value);
        // }

        // foreach($career as $key => $value){
        //     Career::create($value);
        // }

        $transactiontype = [
            [
                'transaction_type_name' => 'Income'
            ],
            [
                'transaction_type_name' => 'Expense'
            ]
        ];

        $category = [
            [
                'category_name' => 'Food',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'T',
                'transaction_type_id' => 2
            ],
            [

            ]
        ];
    }
}
