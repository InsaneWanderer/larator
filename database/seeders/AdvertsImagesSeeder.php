<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AdvertsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagesPath = asset('img/start_images');
        $imagesPath = str_replace("localhost", "larator", $imagesPath);
        $images = array("1.png", "2.png", "3.png", "4.png", "5.png", "6.png");
        
        $mediaData = [];
        $adverts = Advert::all();
        foreach ($adverts as $advert) {
            $imgs = array_rand($images, rand(1, sizeof($images)));
            if (gettype($imgs) != "array") $imgs = [$imgs];
            foreach ($imgs as $imgKey) {
                $img = $images[$imgKey];
                Storage::put("adverts/{$advert->id}/images/{$img}", file_get_contents("$imagesPath/$img"));
                $mediaData[] = [
                    "mediaable_type" => Advert::class,
                    "mediaable_id" => $advert->id,
                    "file_name" => Storage::url("adverts/{$advert->id}/images/{$img}"),
                ];
            }
        }
        
        Media::insert($mediaData);
    }
}
