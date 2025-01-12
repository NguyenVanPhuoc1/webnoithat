<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'id' => Str::uuid()->toString(),
                'name' => 'admin',
                'email' => 'admin123456@gmail.com',
                'password'=> Hash::make('123456'),
                'is_admin' => 0,
            ],
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Nguyễn Bá Trung',
                'email' => 'nguyenvanphuoc031123@gmail.com',
                'password'=> Hash::make('123456'),
                'is_admin' => 1,
            ],
        ]);
        // Table category
        DB::table('settings')->insert([
            [
                'id' => Str::uuid()->toString(),
                'key' => 'logo',
                'value' => 'logo_web.png',
                'type' => 'image',
            ],
            [
                'id' => Str::uuid()->toString(),
                'key' => 'favicon',
                'value' => 'logo_web.png',
                'type' => 'image',
            ],
        ]);
        // Table category
        DB::table('category')->insert([
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'noi-that-phong-khach',
                'cate_name' => 'Nội Thất Phòng Khách',
                'noi_bat' => true
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'noi-that-phong-bep',
                'cate_name' => 'Nội Thất Phòng Bếp',
                'noi_bat' => true
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'noi-that-phong-ngu',
                'cate_name' => 'Nội Thất Phòng Ngủ',
                'noi_bat' => true
            ],
        ]);

        // Table news
        DB::table('news')->insert([
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'bai-viet-1',
                'news_image' => 'tin-tuc-1.jpg',
                'noi_bat' => true,
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'bai-viet-2',
                'news_image' => 'tin-tuc-2.jpg',
                'noi_bat' => true,
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'bai-viet-3',
                'news_image' => 'tin-tuc-3.jpg',
                'noi_bat' => true,
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'bai-viet-4',
                'news_image' => 'tin-tuc-1.jpg',
                'noi_bat' => true,
            ],
        ]);
        // Table news_translations
        DB::table('news_translations')->insert([
            // Bài viết 1
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-1')->value('id'),
                'language_code' => 'vi',
                'news_name' => 'Bai viet 1',
                'news_desc' => 'Noi dung bai viet o day',
            ],
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-1')->value('id'),
                'language_code' => 'en',
                'news_name' => 'News 1',
                'news_desc' => 'Content of the news here',
            ],

            // Bài viết 2
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-2')->value('id'),
                'language_code' => 'vi',
                'news_name' => 'Bai viet 2',
                'news_desc' => 'Noi dung bai viet o day',
            ],
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-2')->value('id'),
                'language_code' => 'en',
                'news_name' => 'News 2',
                'news_desc' => 'Content of the news here',
            ],

            // Bài viết 3
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-3')->value('id'),
                'language_code' => 'vi',
                'news_name' => 'Bai viet 3',
                'news_desc' => 'Noi dung bai viet o day',
            ],
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-3')->value('id'),
                'language_code' => 'en',
                'news_name' => 'News 3',
                'news_desc' => 'Content of the news here',
            ],

            // Bài viết 4
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-4')->value('id'),
                'language_code' => 'vi',
                'news_name' => 'Bai viet 4',
                'news_desc' => 'Noi dung bai viet o day',
            ],
            [
                'id' => Str::uuid()->toString(),
                'news_id' => DB::table('news')->where('slug', 'bai-viet-4')->value('id'),
                'language_code' => 'en',
                'news_name' => 'News 4',
                'news_desc' => 'Content of the news here',
            ],
        ]);
        // Table policy
        DB::table('policy')->insert([
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'chinh-sach-doi-tra',
                'poli_image' => 'doitra.png',
                'noi_bat' => true
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'chinh-sach-doi-tac',
                'poli_image' => 'doitac.jpg',
                'noi_bat' => true
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'chinh-sach-bao-hanh',
                'poli_image' => 'baohanh.png',
                'noi_bat' => true
            ],
            [
                'id' => Str::uuid()->toString(),
                'slug' => 'chinh-sach-giao-hang',
                'poli_image' => 'giaohang.png',
                'noi_bat' => true
            ],
        ]);
        // Table policy_translations
        DB::table('policy_translations')->insert([
            // Chính sách đổi trả
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-doi-tra')->value('id'),
                'language_code' => 'vi',
                'poli_name' => 'Chính Sách Đổi Trả',
                'poli_desc' => 'Noi dung chính sách ở đây',
            ],
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-doi-tra')->value('id'),
                'language_code' => 'en',
                'poli_name' => 'Return Policy',
                'poli_desc' => 'Policy content here',
            ],

            // Chính sách đối tác
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-doi-tac')->value('id'),
                'language_code' => 'vi',
                'poli_name' => 'Chính Sách Đối Tác',
                'poli_desc' => 'Noi dung chính sách ở đây',
            ],
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-doi-tac')->value('id'),
                'language_code' => 'en',
                'poli_name' => 'Partner Policy',
                'poli_desc' => 'Policy content here',
            ],

            // Chính sách bảo hành
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-bao-hanh')->value('id'),
                'language_code' => 'vi',
                'poli_name' => 'Chính Sách Bảo Hành',
                'poli_desc' => 'Noi dung chính sách ở đây',
            ],
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-bao-hanh')->value('id'),
                'language_code' => 'en',
                'poli_name' => 'Warranty Policy',
                'poli_desc' => 'Policy content here',
            ],

            // Chính sách giao hàng
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-giao-hang')->value('id'),
                'language_code' => 'vi',
                'poli_name' => 'Chính Sách Giao Hàng',
                'poli_desc' => 'Noi dung chính sách ở đây',
            ],
            [
                'id' => Str::uuid()->toString(),
                'policy_id' => DB::table('policy')->where('slug', 'chinh-sach-giao-hang')->value('id'),
                'language_code' => 'en',
                'poli_name' => 'Shipping Policy',
                'poli_desc' => 'Policy content here',
            ],
        ]);
    }
}
