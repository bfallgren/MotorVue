<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Resources\TaskCollection;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $service = DB::table('services')
        ->where('motor_id',$id)->orderBy('service_date','DESC')->get();
        return response()->json($service);
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
      $service = new Service([
        'motor_id' => $request->get('motor_id'),
        'service_date' => $request->get('service_date'),
        'location' => $request->get('location'),
        'cost' => $request->get('cost'),
        'description' => $request->get('description'),
        'mileage' => $request->get('mileage')
        ]);

      $service->save();
        
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
        //$service = Service::find($id);
        $service = DB::table('services')
        ->join('motors','motors.id','=', 'services.motor_id')
        ->select('services.*','motors.model')
        ->where('services.id','=',$id)
        ->first();

        return response()->json($service);
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
      $service = Service::find($id);
      $service->update($request->all());
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
      $service = Service::find($id);

      $service->delete();

      return response()->json('successfully deleted');
    }    
}
