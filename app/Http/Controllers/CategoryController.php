<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->image = "";
        $category->save();

        $imgName = $request->photo;

        $category->save();


        $extension = $imgName->getClientOriginalExtension();;
        $fileName = $category->id . "-category." . $extension;
        $category->image = $fileName;


        $category->save();
        $request->photo->storeAs('public/img', $fileName);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(Auth::user()->rol === 'admin') {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            if($request->new_photo) {
                $imgName = $request->new_photo;
                $extension = $imgName->getClientOriginalExtension();;
                $fileName = $category->id . "-category." . $extension;
                $category->image = $fileName;
                $request->new_photo->storeAs('public/img', $fileName);
            }
            $category->save();
        }
        return $this->index();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->index();
    }
}
