<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ringtone;
use Illuminate\Http\Request;

class RingtoneController extends Controller
{
    /**
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
    public function index()
    {
        $ringtones = Ringtone::paginate(20);
        $categories = Category::all();
        return view('frontend.ringtone.index', compact('ringtones', 'categories'));
    }

    /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id, $slug)
    {
        $ringtone = Ringtone::where('id', $id)->where('slug', $slug)->first();
        return view('frontend.ringtone.show', compact('ringtone'));

    }


    /**
     * @param $id
     * @return mixed
     */
    public function downloadRingtone($id)
    {
         $ringtone = Ringtone::findOrFail($id);
         $ringtonePath = $ringtone->file;
         $filePath = public_path('audio/') . $ringtonePath;
         $ringtone->increment('download');
         $ringtone->save();

         return \Response::download($filePath);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category($id)
    {
        $ringtones = Ringtone::where('category_id', $id)->paginate(10);
        $categories = Category::all();
        return view('frontend.ringtone.category', compact('ringtones', 'categories'));
    }

}
