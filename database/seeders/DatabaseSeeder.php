<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin123456@gmail.com',
                'password'=> Hash::make('123456'),
                'role' => 1,
            ]
        ]);

        // Table product
        DB::table('product')->insert([
            [
                'name' => 'Ban',
                'cate_id' => 1,
                // 'image'=> 'np4-1267.jpg',
                'description'=>'Ban go cao cap',
                'noi_bat' => true
            
            ],
            [
                'name' => 'Ghe',
                'cate_id' => 2,
                // 'image'=> 'hinh2.jpg',
                'description'=>'Ghe da cao cap',
                'noi_bat' => true
            
            ],
            [
                'name' => 'Ban da',
                'cate_id' => 3,
                // 'image'=> 'hinh3.jpg',
                'description'=>'Ban da cao cap',
                'noi_bat' => true
            
            ]
        ]);

         // Table product_image
        // DB::table('product_image')->insert([
        //     [
        //         'pro_image'=> 'hinh1.jpg',
        //         'pro_id' => 1,
        //     ],
        //     [
        //         'pro_image'=> 'hinh2.jpg',
        //         'pro_id' => 1,
        //     ],
        //     [
        //         'pro_image'=> 'hinh3.jpg',
        //         'pro_id' => 2,
        //     ],
        //     [
        //         'pro_image'=> 'hinh4.jpg',
        //         'pro_id' => 2,
        //     ],
        //     [
        //         'pro_image'=> 'hinh5.jpg',
        //         'pro_id' => 3,
        //     ],
        //     [
        //         'pro_image'=> 'hinh6.jpg',
        //         'pro_id' => 3,
        //     ]
        // ]);

         // Table comment
        DB::table('comment')->insert([
            [
                'pro_id' => 1,
                'name' => 'customer1',
                'email' => 'cus1@gmail.com',
                'content' => 'Ban ghe noi that tot'
            ],
            [
                'pro_id' => 2,
                'name' => 'customer2',
                'email' => 'cus2@gmail.com',
                'content' => 'Ban ghe noi that tot'
            ],
            [
                'pro_id' => 3,
                'name' => 'customer3',
                'email' => 'cus3@gmail.com',
                'content' => 'Ban ghe noi that tot'
            ],
        ]);
        // Table category
        DB::table('category')->insert([
            [
                'cate_name' => 'Nội Thất Phòng Khách',
                'noi_bat' => true
            ],
            [
                'cate_name' => 'Nội Thất Phòng Bếp',
                'noi_bat' => true
            ],
            [
                'cate_name' => 'Nội Thất Phòng Ngủ',
                'noi_bat' => true
            ],
        ]);
         // Table policy
        DB::table('policy')->insert([
            [
                'poli_name' => 'Chinh sach doi tra',
                'poli_image' => 'tin-tuc-1.jpg',
                'poli_desc' => 'Noi dung dang duoc cap nhat',
                'noi_bat' => true
            ],
            [
                'poli_name' => 'Chinh sach mua ban',
                'poli_image' => 'tin-tuc-2.jpg',
                'poli_desc' => 'Noi dung dang duoc cap nhat',
                'noi_bat' => true
            ],
            [
                'poli_name' => 'Chinh sach hoan tien',
                'poli_image' => 'tin-tuc-3-9112.jpg',
                'poli_desc' => 'Noi dung dang duoc cap nhat',
                'noi_bat' => true
            ],
        ]);

        // Table policy
        DB::table('customer')->insert([
            [
                'cus_name' => 'Cus1',
                'email' => 'cus1@gmail.com',
                'cus_phone' => '0159357862',
                'cus_content' => 'No comment'
            ],
            [
                'cus_name' => 'Cus2',
                'email' => 'cus2@gmail.com',
                'cus_phone' => '0159357862',
                'cus_content' => 'No comment'
            ],
            [
                'cus_name' => 'Cus3',
                'email' => 'cus3@gmail.com',
                'cus_phone' => '0159357862',
                'cus_content' => 'No comment'
            ],
        ]);

        // Table policy
        DB::table('news')->insert([
            [
                'news_name' => 'Bai viet 1',
                'news_image' => 'tin-tuc-1.jpg',
                'news_desc' => 'Noi dung bai viet o day',
                'cus_id' => 1,
                'noi_bat' => true
            ],
            [
                'news_name' => 'Bai viet 1',
                'news_image' => 'tin-tuc-2.jpg',
                'news_desc' => 'Noi dung bai viet o day',
                'cus_id' => 2,
                'noi_bat' => true
            ],
            [
                'news_name' => 'Bai viet 1',
                'news_image' => 'tin-tuc-3-9112.jpg',
                'news_desc' => 'Noi dung bai viet o day',
                'cus_id' => 3,
                'noi_bat' => true
            ],
        ]);
        // Table info_admin
        DB::table('info_admin')->insert([
            [
                'info_name' => 'Admin1',
                'hotline' => '1234567890',
                'phone' => '0123456789',
                'gioitinh' => 'male',
                'diachi' => 'Thu duc'
            ],
        ]);
    }
    
}
