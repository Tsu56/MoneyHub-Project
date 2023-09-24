<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Career;
use App\Models\Category;
use App\Models\Gender;
use App\Models\TransactionType;
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
        $gender = [
            [
                'gender_name' => 'Male'
            ],
            [
                'gender_name' => 'Female'
            ]
        ];

        $career = [
            [
                'career_name' => 'Students'
            ],
            [
                'career_name' => 'Bussiness Owner'
            ]
        ];

        $transactiontype = [
            [
                'transaction_type_name' => 'รายรับ'
            ],
            [
                'transaction_type_name' => 'รายจ่าย'
            ]
        ];

        $category = [
            [
                'category_name' => 'ค่าจ้าง',
                'transaction_type_id' => 1
            ],
            [
                'category_name' => 'โบนัส',
                'transaction_type_id' => 1
            ],
            [
                'category_name' => 'การลงทุน',
                'transaction_type_id' => 1
            ],
            [
                'category_name' => 'อาหาร',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'เดินทาง',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'ปาร์ตี้',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'ที่อยู่อาศัย',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'สื่อสาร',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'เสื้อผ้า',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'ทางการแพทย์',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'ภาษี',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'การศึกษา',
                'transaction_type_id' => 2
            ],
            [
                'category_name' => 'สัตว์เลี้ยง',
                'transaction_type_id' => 2
            ]
        ];

        foreach($gender as $key => $value){
            Gender::create($value);
        }

        foreach($career as $key => $value){
            Career::create($value);
        }

        foreach($transactiontype as $key => $value){
            TransactionType::create($value);
        }
    
        foreach($category as $key => $value){
            Category::create($value);
        }
    }
}