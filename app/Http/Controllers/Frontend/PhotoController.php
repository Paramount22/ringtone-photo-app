<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(10);
        return view('frontend.photos.index', compact('photos'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadPhoto800x600($id)
    {
        return $this->downloadPhoto($id, 'uploads/');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadPhoto1280x1024($id)
    {
       return $this->downloadPhoto($id, 'uploads/1280x1024/');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadPhoto316x255($id)
    {
        return $this->downloadPhoto($id, 'uploads/316x255/');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadPhoto118x95($id)
    {
        return $this->downloadPhoto($id, 'uploads/118x95/');
    }

    /**
     * @param $id
     * @param $path
     * @return mixed
     */
    private function downloadPhoto($id, $path)
    {
        $photo = Photo::findOrFail($id);
        $photoName = $photo->file;
        $filePath = public_path($path) . $photoName;
        return \Response::download($filePath);
    }
}
