<?php

use App\Models\Content;

if (! function_exists('getContent')) {
    function getContent(string $key, $default = null) {
        $item = Content::where('key', $key)->first();
        return $item ? $item->value : $default;
    }
}
