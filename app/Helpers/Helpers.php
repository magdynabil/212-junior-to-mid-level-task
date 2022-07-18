<?php


namespace App\Helpers;


class Helpers
{

    public static function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        return $filename;
    }

    public static function deleteOldImage($folder, $oldimg)
    {
        try{
            \Illuminate\Support\Facades\Storage::disk($folder)->delete($oldimg);
        }
        catch (\Exception $e){

        }
    }


}
