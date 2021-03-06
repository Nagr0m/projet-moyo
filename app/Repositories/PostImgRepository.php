<?php

namespace App\Repositories;

use File;
use Image;

class PostImgRepository 
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path('img/posts/');
    }

    /**
     * Enregistre une image d'article et sa miniature
     *
     * @param \Illuminate\Http\UploadedFile $imgFile
     * @return string $imgName
     */
    public function saveThumbnail (\Illuminate\Http\UploadedFile $imgFile)
    {
        $imgName = str_random(12) . '.' . $imgFile->extension();
        # Traitement de l'image
        $ImageMaster = Image::make($imgFile)
                            ->resize(env('THUMBNAIL_SIZE', 800), env('THUMBNAIL_SIZE', 800), function ($constraint) {
                                $constraint->aspectRatio(); # Respecte le ratio
                                $constraint->upsize(); # Évite le upsize si image plus petite que 800*800
                            });
        $ImageMaster->save($this->uploadPath . $imgName, 100);

        # Traitement de la miniature carrée
        $squarePath = $this->uploadPath . 'square_' . $imgName;
        $ImageMaster->resize(400, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->crop(200, 200)->save($squarePath, 100);

        return $imgName;
    }

    /**
     * Supprime une image et sa miniature associée
     *
     * @param string $imgName
     * @return void
     */
    public function destroyThumbnail (string $imgName)
    {
        # Suppression de l'image
        if (File::exists($this->uploadPath . $imgName))
            File::delete($this->uploadPath . $imgName);

        # Suppression de la miniature
        if (File::exists($this->uploadPath . 'square_' . $imgName))
            File::delete($this->uploadPath . 'square_' . $imgName);
    }
}