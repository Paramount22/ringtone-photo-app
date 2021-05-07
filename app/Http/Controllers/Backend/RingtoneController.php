<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRingtoneRequest;
use App\Http\Requests\UpdateRingtoneRequest;
use App\Models\Category;
use App\Models\Ringtone;
use Illuminate\Http\Request;


class RingtoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ringtones = Ringtone::latest()->paginate(5);
        return view('backend.ringtone.index', compact('ringtones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.ringtone.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRingtoneRequest $request)
    {
        $fileName = $request->file->hashName();
        $format = $request->file->getClientOriginalExtension();
        $size = $request->file->getSize();
        $request->file->move(public_path('audio'), $fileName);

        $ringtone = new Ringtone;
        $ringtone->title = $request->get('title');
        $ringtone->slug =  $request->get('title');
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $format;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->save();

        return redirect()->back()->with('success', 'Ringtone added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ringtone = Ringtone::findOrFail($id);
        $categories = Category::all();
        return view('backend.ringtone.edit', compact('ringtone', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRingtoneRequest $request, $id)
    {
        $ringtone = Ringtone::findOrFail($id);
        $fileName = $ringtone->file;
        $format = $ringtone->format;
        $size = $ringtone->size;
        $ringtone->download;
        if($request->hasFile('file')) {
            $fileName = $request->file->hashName();
            $format = $request->file->getClientOriginalExtension();
            $size = $request->file->getSize();
            $request->file->move(public_path('audio'), $fileName);
            unlink(public_path('/audio/'.$ringtone->file));  // remove ringtone from public folder
            $ringtone->download = 0;

        }

        $ringtone->title = $request->get('title');
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $format;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->download;
        $ringtone->save();

        return redirect()->route('ringtones.index')->with('success', 'Ringtone updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ringtone = Ringtone::findOrFail($id);
        $fileName = $ringtone->file;
        $ringtone->delete();
        unlink(public_path('/audio/'.$ringtone->file));  // remove ringtone from public folder
        return redirect()->back()->with('success', 'Ringtone deleted.');

    }
}
