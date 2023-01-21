<?php

namespace App\Http\Controllers;

use App\Models\Ganga;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GangaRequest;
use Illuminate\Support\Facades\Storage;


class GangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gangas = Ganga::orderBy('title', 'ASC')
            ->paginate(10);
        return view('welcome', compact('gangas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('gangas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GangaRequest $request)
    {
        $ganga = new Ganga();
        $ganga->title = $request->title;
        $ganga->description = $request->description;
        $ganga->url = $request->url;
        $ganga->price = $request->price;
        $ganga->price_sale = $request->price_sale;
        $ganga->category_id = $request->category_id;

        $ganga->photo = "";
        $ganga->user_id = Auth::id();
        $ganga->available = $request->available ? 1 : 0;
        $imgName = $request->photo;

        $ganga->save();


        $extension = $imgName->getClientOriginalExtension();;
        $fileName = $ganga->id . "-ganga-severa." . $extension;
        $ganga->photo = $fileName;


        $ganga->save();



        $request->photo->storeAs('public/img', $fileName);



        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function show(Ganga $ganga)
    {
        return view('gangas.show', compact('ganga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function edit(Ganga $ganga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ganga $ganga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ganga $ganga)
    {
        if(Auth::id() == $ganga->user->id || (Auth::user()->rol === 'admin')) {
            $ganga->delete();
        }
        return $this->index();
    }

    public function like(Request $request)
    {
        $ganga = Ganga::findOrFail($request->id);
        $ganga->likes++;
        $ganga->save();
        return $this->show($ganga);

    }

    public function unlike(Request $request)
    {
        $ganga = Ganga::findOrFail($request->id);
        $ganga->unlikes++;
        $ganga->save();
        return $this->show($ganga);

    }

}
