<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lastNames = ['佐藤', '鈴木', '高橋', '田中', '伊藤', '渡辺', '山本', '中村', '小林', '加藤'];
        $firstNames = ['太郎', '花子', '一郎', '美咲', '健太', '愛', '翔太', '優子', '直樹', '由美'];

        $phonePrefixes = ['080', '090', '070'];

        $bookings = [];

        $hotelIds = DB::table('hotels')->pluck('hotel_id')->toArray();

        for ($i = 1; $i <= 1000; $i++) {
            $hotelId = $hotelIds[array_rand($hotelIds)];

            $checkin = Carbon::now()->subDays(rand(1, 30))->setTime(rand(14, 17), rand(0, 59));
            $checkout = (clone $checkin)->addDays(rand(1, 3))->setTime(rand(9, 11), rand(0, 59));

            $fullName = $lastNames[array_rand($lastNames)] . ' ' . $firstNames[array_rand($firstNames)];
            $phone = $phonePrefixes[array_rand($phonePrefixes)] . rand(10000000, 99999999);

            $bookings[] = [
                'hotel_id' => $hotelId,
                'customer_name' => $fullName,
                'customer_contact' => $phone,
                'checkin_time' => $checkin,
                'checkout_time' => $checkout,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('bookings')->insert($bookings);
    }
}
