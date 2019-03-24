<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller {

    public function show(Request $request)
    {
        $parse_url = explode('/', parse_url(url()->current())['path'])[2];        
        $partition = \App\Partition::where('url', '=', $parse_url)            
            ->get()
            ->first()
            ->toArray();
        
        // get images name for gallery
        $images = scandir(public_path('storage/gallery/' . $partition['id']) . '/thumbs');
        if (count($images) > 2) {
            unset($images[0], $images[1]);
        }

        // pagination
        $img_per_page = 16;
        $img_total = count($images);
        $cur_page = $request->input('page');
        $offset = 0;
        if ($cur_page) {
            $offset = $img_per_page * $cur_page - $img_per_page;
        }

        if ($offset >= $img_total) {
            abort(404);
        }

        $arr = new \ArrayIterator(array_values($images));
        $images = new \LimitIterator($arr, $offset, $img_per_page);

        $gallery = [
            'images' => $images,
            'title' => $partition['seo_title'],
            'coll_id' => $partition['id'],
            'label' => $partition['name'],
            'pages' => round($img_total / $img_per_page, 0, PHP_ROUND_HALF_UP),
            'cur_page' => $cur_page

        ];

        return view('layouts/pages/gallery', $gallery);
    }
}

