<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentGalleryContent;

class EventGalleryController extends Controller
{
    // Path: GET /event-gallery
    public function show(Request $request)
    {
        $galleryId = $request->query('gallery', null);
        $openIndex = intval($request->query('open', -1));

        if (!$galleryId) {
            // show main listing (this route could be tournamentgal view instead)
            // but for backward compatibility, if no gallery param treat like list
            $galleries = TournamentGalleryContent::orderByDesc('event_date')->get();
            return view('tournamentgal', compact('galleries'));
        }

        // find by slug
        $gallery = TournamentGalleryContent::where('slug', $galleryId)->first();
        if (!$gallery) {
            // fallback: empty page but avoid 500
            return view('eventGal', [
                'galleryId' => $galleryId,
                'gallery' => null,
                'images' => collect(),
                'openIndex' => $openIndex
            ]);
        }

        $images = $gallery->images()->get();

        return view('eventGal', [
            'galleryId' => $galleryId,
            'gallery' => $gallery,
            'images' => $images,
            'openIndex' => $openIndex
        ]);
    }
}
