<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('get_course_content')) {
    function get_course_content($key)
    {
        return DB::table('courses_contents')->where('key', $key)->value('value') ?? '';
    }
}
