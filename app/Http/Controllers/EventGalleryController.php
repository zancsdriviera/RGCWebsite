<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventGalleryController extends Controller
{
    public function show(Request $request)
    {
        // Example galleries. In real app, fetch images from DB or storage.
        $galleries = [
            // gallery id => array of image paths (can be asset() or full URLs)
            'tournament-list' => [
                asset('images/COURSES/Couples/Couples1.jpg'),
                asset('images/COURSES/Couples/Couples2.jpg'),
                asset('images/COURSES/Couples/Couples3.jpg'),
                asset('images/COURSES/Couples/Couples4.jpg'),
            ],
            'veranda' => [  
                'https://ik.imagekit.io/w87y1vfrm/HOME/Carousel/Home_Image_1.webp',
                'https://ik.imagekit.io/w87y1vfrm/HOME/Carousel/Home_Image_2.webp',
                'https://ik.imagekit.io/w87y1vfrm/HOME/Carousel/Home_Image_3.webp',
                'https://ik.imagekit.io/w87y1vfrm/HOME/Carousel/Home_Image_4.webp',
            ],
            // add more gallery groups here...
        ];

        $galleryId = $request->query('gallery', 'tournament-list'); // fallback
        $openIndex = intval($request->query('open', -1)); // -1 = don't auto-open

        // ensure gallery exists
        $images = $galleries[$galleryId] ?? [];

        return view('eventGal', [
            'galleryId' => $galleryId,
            'images' => $images,
            'openIndex' => $openIndex,
        ]);
    }
}
