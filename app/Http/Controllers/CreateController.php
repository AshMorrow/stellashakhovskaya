<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CreateController extends Controller
{
    const COLLECTION_ID = 1;
    const MAIN_COLLECTION_ID = 1;

    public function processed() {
        $storage = Storage::disk('public');
        $collections = $storage->directories('create');
        foreach ($collections as $collection) {
            $dresses = $storage->directories($collection);
            $collectionId = DB::table('collections')->insertGetId([
                'cm_id' => self::MAIN_COLLECTION_ID,
                'name' => 'Satin - 2020',
                'year' => '2020',
                'url' => 'satin-2020',
                'seo_title' => 'Свадебные платья - Satin 2020 в Киеве, Львове, Черновцах.',
                'seo_description' => '',
            ]);

            $collectionGalleryPath = 'collections_img/'.self::MAIN_COLLECTION_ID.'/'.$collectionId;
            $collectionGalleryThumbPath = $collectionGalleryPath.'/thumb';
            $storage->makeDirectory($collectionGalleryPath);
            $storage->makeDirectory($collectionGalleryThumbPath);

            foreach ($dresses as $dress) {
                $dressCode = basename($dress);
                $dressGalleryPath = $collectionGalleryPath."/{$dressCode}";
                $dressGalleryThumbPath = $collectionGalleryThumbPath."/{$dressCode}";
                $storage->makeDirectory($dressGalleryPath);
                $storage->makeDirectory($dressGalleryThumbPath);

                $dressPhotos = $storage->files($dress);


                DB::table('dress')->insert([
                    'c_id' => $collectionId,
                    'name' => null,
                    'dress_code' => $dressCode,
                    'seo_title' => 'Коллекция Satin 2020 | Свадебное платье - '. $dressCode,
                    'seo_description' => ''
                ]);

                $photoCounter = 0;
                foreach ($dressPhotos as $photo) {
                    $photoName = basename($photo);

                    $tempPhoto = Image::make($storage->path($photo));

                    if ($tempPhoto->width() > $tempPhoto->height()) {
                        continue;
                    }

                    $tempPhoto->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $storage->put($dressGalleryPath."/{$photoName}", $tempPhoto->encode('jpg', 80));

                    if ($photoCounter == 0) {
                        $tempPhoto->resize(270, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $storage->put($dressGalleryThumbPath."/front.jpg", $tempPhoto->encode('jpg', 80));
                    }

                    $tempPhoto->destroy();

                    $photoCounter += 1;
                }
            }
        }

        echo 'OK';
    }
}