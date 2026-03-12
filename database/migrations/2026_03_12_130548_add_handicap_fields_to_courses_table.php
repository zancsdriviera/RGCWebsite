<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;

return new class extends Migration
{
    public function up()
    {
        // Update existing courses to include handicap fields in the JSON structure
        $courses = Course::all();
        foreach ($courses as $course) {
            $updated = false;
            
            // Update langer_images
            if ($course->langer_images) {
                $images = $course->langer_images;
                foreach ($images as &$image) {
                    if (!isset($image['men_handicap'])) {
                        $image['men_handicap'] = 0;
                        $image['ladies_handicap'] = 0;
                        $updated = true;
                    }
                }
                if ($updated) {
                    $course->langer_images = $images;
                }
            }
            
            // Update couples_images
            $updated = false;
            if ($course->couples_images) {
                $images = $course->couples_images;
                foreach ($images as &$image) {
                    if (!isset($image['men_handicap'])) {
                        $image['men_handicap'] = 0;
                        $image['ladies_handicap'] = 0;
                        $updated = true;
                    }
                }
                if ($updated) {
                    $course->couples_images = $images;
                }
            }
            
            if ($updated) {
                $course->save();
            }
        }
    }

    public function down()
    {
        // No need to revert
    }
};