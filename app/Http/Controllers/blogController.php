<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Auth;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'countries' => 'required'
        ]);

        $b = new Blog();
        $b->title = $request['title'];
        $b->content = $request['content'];
        $b->countries = $request['countries'];
        //Here process to getting the image :
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $request->file('image')->move("images/", $filename);
        //
        $b->image = $filename;



        $user = Auth::user();
        //if someone is authenticated
        if ($user) {
            // we add him as author, save the blog post and then redirect to the homepage
            $user->blogs()->save($b);
            $b->save();
            return redirect()->action('myController@show', $b->id);
        }
        else {
            return view("auth.login");
        }
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
        $b = Blog::find($id);
        return view('about')->with('b', $b);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $showEdit = Blog::where('id', $id)->first();
        return view('edit')->with('showEdit', $showEdit);
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
        //
        $update = Blog::where('id', $id)->first();
        $update->title = $request['title'];
        $update->content = $request['content'];
        //TO DO process to getting the image
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $request->file('image')->move("images/", $filename);
        //
        $update->image = $filename;
        $update->countries = $request['countries'];
        $update->update();

        return redirect()->to('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = Blog::find($id);
        $del->delete();

        return redirect()->to('/');
    }
}
