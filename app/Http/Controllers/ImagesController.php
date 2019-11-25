<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IImagesRepository;

class ImagesController extends Controller
{
    public function __construct(IImagesRepository $imagesRepo)
    {
        $this->imagesRepo = $imagesRepo;
    }

    public function destroy(Request $request, $id) {
        $this->imagesRepo->delete($id);
        return response()->json(['status' => 'success']);
    }
}
