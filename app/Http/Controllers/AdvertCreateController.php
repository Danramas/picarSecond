<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvertPost;
use Illuminate\Support\Facades\Auth;
use App\Advert;
use App\CarMark;

class AdvertCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('advertCreate', ['marks'=>CarMark::all()]);
    }

    public function store(CreateAdvertPost $request)
    {
            $advert = Advert::create([
                'modification_id' => $request->input('selectModification'),
                'user_id' => Auth::user()->id,
                'year' => $request->input('year'),
                'img1' => !empty($request->file('image')[0])
                    ? $request->file('image')[0]->store('images', ['disk' => 'public']) : null,
                'img2' => !empty($request->file('image')[1])
                    ? $request->file('image')[1]->store('images', ['disk' => 'public']) : null,
                'img3' => !empty($request->file('image')[2])
                    ? $request->file('image')[2]->store('images', ['disk' => 'public']) : null,
                'img4' => !empty($request->file('image')[3])
                    ? $request->file('image')[3]->store('images', ['disk' => 'public']) : null,
                'img5' => !empty($request->file('image')[4])
                    ? $request->file('image')[4]->store('images', ['disk' => 'public']) : null,

            ]);

        return redirect('/adverts/'.$advert->id);
    }
}
