<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\LinkCollection;
use App\Links;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LinksController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //arguments??
    public function index()
    {
        $links = Links::orderBy('name', 'ASC')->get();
        return new LinkCollection($links);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $link = new Links([
        'name' => $request->get('name'),
        'description' => $request->get('description'),
        'urlname' => $request->get('urlname'),
      ]);

      $link->save();
        
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
        $link = DB::table('links')
        ->where('links.id','=',$id)
        ->first();
      
        app('debugbar')->error($link);
        return response()->json($link);
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
      $link = Links::find($id);
      $link->update($request->all());
      return response()->json('successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      $link = Links::find($id);

      $link->delete();

      return response()->json('successfully deleted');
    }
}
