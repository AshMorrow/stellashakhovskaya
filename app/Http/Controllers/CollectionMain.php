<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collections_main;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CollectionMain extends Controller
{
    public function showAll()
    {
        $collections['collections'] = DB::table('collections_main')->get()->toArray();
        return view('layouts/pages/collections_main', $collections);
    }

    public function show($name)
    {
        $collections['collections'] = DB::table('collections AS c')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('c.*', 'cm.url AS cm_url', 'cm.name AS coll_name', 'cm.seo_title AS title')->where([['cm.url', '=', $name], ['c.is_archived', '=', 0]])->orderBy('c.year', 'DESC')->get()->toArray();
        return view('layouts/pages/collections', $collections);
    }

    public function showCollection($name, $coll_name)
    {
        $collections['collections'] = DB::table('collections AS c')
            ->leftJoin('dress AS d', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('d.*', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   url',
                'c.name AS coll_name', 'd.id AS dress_id', 'c.seo_title AS title')
            ->where('c.url', '=', $coll_name)->orderBy('d.dress_code')->paginate(16);

        $collections['favorite_dress'] = isset($_COOKIE['favorite_dress']) ? json_decode($_COOKIE['favorite_dress'])->dress : false;
        return view('layouts/pages/collection_dress', $collections);
    }

    public function showDress($name, $coll_name, $dress_code)
    {

        // get main dress
        $collections['collections'] = DB::table('collections AS c')
            ->leftJoin('dress AS d', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('d.*', 'd.id AS d_id', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   url', 'c.name AS coll_name')->where([
                ['c.url', '=', $coll_name],
                ['d.dress_code', '=', $dress_code]
            ])->first();

        // get same dress in collections
        $collections['others_dress'] = DB::table('collections AS c')
            ->leftJoin('dress AS d', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('d.*', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   url', 'c.name AS coll_name')->where([
                ['c.url', '=', $coll_name],
                ['d.dress_code', '<>', $dress_code]
            ])->inRandomOrder()->limit(3)->get();

        // get images name for main dress
        $images_folder = public_path('storage/collections_img/' . $collections['collections']->cm_id . '/' . $collections['collections']->c_id . '/' . $collections['collections']->dress_code);
        $images = scandir($images_folder);
        if (count($images) > 2) {
            unset($images[0], $images[1]);
            $collections['images'] = array_values($images);
        }

        $fav_dress = isset($_COOKIE['favorite_dress']) ? $_COOKIE['favorite_dress'] : 0;
        if ($fav_dress) {
            $fav_dress = json_decode($fav_dress)->dress;
            if (in_array($collections['collections']->d_id, $fav_dress)) {
                $collections['in_favorite'] = 1;
            } else {
                $collections['in_favorite'] = 0;
            }
        } else {
            $collections['in_favorite'] = 0;
        }

        return view('layouts/pages/dress', $collections);
    }

    public function showGallery(Request $request)
    {
        $parse_url = explode('/', parse_url(url()->current())['path'])[2];
        $data = DB::table('collections_main AS cm')->select('cm.id', 'cm.seo_title', 'cm.name')->where('cm.url', '=', $parse_url)->first();

        // get images name for gallery
        $images = scandir(public_path('storage/gallery/' . $data->id) . '/thumbs');
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

        $collection = [

            'images' => $images,
            'title' => $data->seo_title,
            'coll_id' => $data->id,
            'label' => $data->name,
            'pages' => round($img_total / $img_per_page, 0, PHP_ROUND_HALF_UP),
            'cur_page' => $cur_page

        ];

        return view('layouts/pages/gallery', $collection);
    }
}