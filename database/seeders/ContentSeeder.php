<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contents')->upsert([
            [
                'key' => 'courses_card1_image',
                'type' => 'image',
                'value' => 'https://ik.imagekit.io/w87y1vfrm/COURSES/LangerCopy.png',
            ],
            [
                'key' => 'courses_card1_title',
                'type' => 'text',
                'value' => 'Langer Course',
            ],
            [
                'key' => 'courses_card1_description',
                'type' => 'text',
                'value' => 'This is a short description for the first card.',
            ],
            [
                'key' => 'courses_card2_image',
                'type' => 'image',
                'value' => 'https://ik.imagekit.io/w87y1vfrm/COURSES/CouplesCopy.jpg',
            ],
            [
                'key' => 'courses_card2_title',
                'type' => 'text',
                'value' => 'Couples Course',
            ],
            [
                'key' => 'courses_card2_description',
                'type' => 'text',
                'value' => 'This is a short description for the second card.',
            ],
        ], ['key']);
    }
}
