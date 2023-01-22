<?php

namespace App\Http\Controllers;

use App\Models\Ganga;
use App\Models\User;
use App\Models\Votos;
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
        $gangas = Ganga::where('available', '=', 1)->orderBy('title', 'ASC')
            ->paginate(5);
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
        $voto = null;
        if(Auth::check()) {
            $voto = Votos::where('user_id', "=", Auth::id())
                ->where('ganga_id', "=", $ganga->id)->first();
        }
        return view('gangas.show', compact('ganga', 'voto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function edit(Ganga $ganga)
    {
        $categories = Category::all();
        return view('gangas.edit', compact('categories', 'ganga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function update(GangaRequest $request, $id)
    {
        $ganga = Ganga::findOrFail($id);
        if(Auth::id() == $ganga->user->id || (Auth::user()->rol === 'admin')) {
            $ganga->title = $request->title;
            $ganga->description = $request->description;
            $ganga->url = $request->url;
            $ganga->price = $request->price;
            $ganga->price_sale = $request->price_sale;
            $ganga->category_id = $request->category_id;
            $ganga->available = $request->available ? 1 : 0;
            if($request->new_photo) {
                $imgName = $request->new_photo;
                $extension = $imgName->getClientOriginalExtension();;
                $fileName = $ganga->id . "-ganga-severa." . $extension;
                $ganga->photo = $fileName;
                $request->new_photo->storeAs('public/img', $fileName);
            }

            $ganga->save();
            return $this->show($ganga);
        }

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
        $voto = Votos::where('user_id', '=', Auth::id())
            ->where('ganga_id', '=', $request->id)->first();
        $ganga = Ganga::findOrFail($request->id);
        $ganga->likes++;
        if($voto) {
            $voto->vote = true;
            $ganga->unlikes--;
        } else {
            $voto = new Votos();
            $voto->user_id = Auth::id();
            $voto->ganga_id = $ganga->id;
            $voto->vote = true;

        }
        $ganga->save();
        $voto->save();



        return $this->show($ganga);

    }

    public function unlike(Request $request)
    {

        $voto = Votos::where('user_id', '=', Auth::id())
            ->where('ganga_id', '=', $request->id)->first();
        $ganga = Ganga::findOrFail($request->id);
        $ganga->unlikes++;
        if($voto) {
            $voto->vote = false;
            $ganga->likes--;
        } else {
            $voto = new Votos();
            $voto->user_id = Auth::id();
            $voto->ganga_id = $ganga->id;
            $voto->vote = false;

        }
        $ganga->save();
        $voto->save();



        return $this->show($ganga);

    }

    public function gangasUsuario()
    {
        $user = User::findOrFail(Auth::id());
        $gangas = Ganga::where('user_id' , "=" , Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $gangas = $gangas ? $gangas : [];
        $title = "Ganges de " . $user->name;
        return view('gangas.userGangas', compact('gangas', "title"));
    }

    public function nuevasGangas()
    {
        $gangas = Ganga::orderBy('created_at', 'DESC')
            ->paginate(10);
        $title = "Noves Ganges";
        return view('gangas.newsGangas', compact('gangas', "title"));
    }

    public function mejoresGangas()
    {
        $gangas = Ganga::orderByRaw('likes - unlikes desc')
            ->paginate(5);
        $title = "Ganges destacades";
        return view('gangas.bestGangas', compact('gangas', "title"));
    }

}
