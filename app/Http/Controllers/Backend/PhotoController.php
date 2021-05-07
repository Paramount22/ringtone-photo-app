<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(10);
        return view('backend.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        $image = $request->file('image');
        $size = $request->image->getSize();
        $filename = $image->hashName();


        $format = $request->image->getClientOriginalExtension();
        $path = 'uploads/'.$filename;
        $path1 = 'uploads/1280x1024/'.$filename;
        $path2 = 'uploads/316x255/'.$filename;
        $path3 = 'uploads/118x95/'.$filename;

        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(1280, 1024)->save($path1);
        Image::make($image->getRealPath())->resize(316, 255)->save($path2);
        Image::make($image->getRealPath())->resize(118, 95)->save($path3);

        $photo = new Photo();
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->file = $filename;
        $photo->format = $format;
        $photo->size = $size;
        $photo->save();

        return redirect()->route('photos.index')->with('success', 'Photo uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrfail($id);
        return view('backend.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, $id)
    {
        // deteails of the photo from db
        $photo = Photo::findOrFail($id);
        $filename = $photo->file;
        $format = $photo->format;
        $size = $photo->size;
        // if user uloaded new photo
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $size = $request->image->getSize();
            $newfilename = $image->hashName();
            $format = $request->image->getClientOriginalExtension();

            $path = 'uploads/'.$newfilename;
            $path1 = 'uploads/1280x1024/'.$newfilename;
            $path2 = 'uploads/316x255/'.$newfilename;
            $path3 = 'uploads/118x95/'.$newfilename;
            // upload and resize new updated photo
            Image::make($image->getRealPath())->resize(800, 600)->save($path);
            Image::make($image->getRealPath())->resize(1280, 1024)->save($path1);
            Image::make($image->getRealPath())->resize(316, 255)->save($path2);
            Image::make($image->getRealPath())->resize(118, 95)->save($path3);
            // delete old photo from public folder
            unlink(public_path('/uploads/'.$photo->file));  // remove photo from public folder
            unlink(public_path('/uploads/1280x1024/'.$photo->file));  // remove photo from public folder
            unlink(public_path('/uploads/316x255/'.$photo->file));  // remove photo from public folder
            unlink(public_path('/uploads/118x95/'.$photo->file));  // remove photo from public folder

            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->format = $format;
            $photo->size = $size;
            // save new filename in db
            $photo->file = $newfilename;
            $photo->save();

            return redirect()->route('photos.index')->with('success', 'Photo updated.');
        }
        // if photo remains same
        else {
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->format = $format;
            $photo->size = $size;
            $photo->file = $filename;
            $photo->save();

            return redirect()->route('photos.index')->with('success', 'Photo updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        unlink(public_path('/uploads/'.$photo->file));  // remove photo from public folder
        unlink(public_path('/uploads/1280x1024/'.$photo->file));  // remove photo from public folder
        unlink(public_path('/uploads/316x255/'.$photo->file));  // remove photo from public folder
        unlink(public_path('/uploads/118x95/'.$photo->file));  // remove photo from public folder
        return redirect()->back()->with('success', 'Photo deleted.');
    }


}
