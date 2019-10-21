<?php

namespace App\Http\Controllers;

use Session;

use App\Catagory;

use Illuminate\Http\Request;

class CatagoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.catagories.index')->with('catagories', Catagory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catagories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $catagory = new Catagory;

        $catagory->name = $request->name;
        $catagory->save();

        Session::flash('success', 'You have successfully created a catagory!');

        return redirect()->route('catagories');
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
        $catagory = Catagory::find($id);
        return view('admin.catagories.edit')->with('catagory',$catagory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catagory = Catagory::find($id);

        $catagory->name = $request->name;
        $catagory->save();


        Session::flash('success', 'You have successfully updated a catagory!');

        return redirect()->route('catagories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catagory = Catagory::find($id);

        foreach($catagory->posts as $post ) {
            $post->forcedelete();
        }

        $catagory->delete();

        Session::flash('success', 'You have successfully deleted a catagory!');

        return redirect()->route('catagories');

    }
}
