<?php

namespace App\Repositories;

use App\Image;
use App\Repositories\Interfaces\IImagesRepository;
use Illuminate\Support\Facades\Storage;

class ImagesRepository implements IImagesRepository {
    public function delete($id) {
        $image = Image::findOrFail($id);
        Storage::delete($image->path);
        $image->animals()->detach();
        $image->delete();
    }
}