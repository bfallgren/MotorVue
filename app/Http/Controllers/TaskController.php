<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;
use App\Task;
use App\Motor;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //arguments??
    public function index($id)
    {
        $task = DB::table('tasks')
        ->where('motor_id',$id)->orderBy('mileage_interval','ASC')->get();
        return response()->json($task);
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
      $task = new Task([
        'motor_id' => $request->get('motor_id'),
        'description' => $request->get('description'),
        'mileage_interval' => $request->get('mileage_interval'),
        'month_interval' => $request->get('month_interval'),
        'last_completed_miles' => $request->get('last_completed_miles'),
        'last_completed_date' => $request->get('last_completed_date'),
        'next_sched_maint' => $request->get('next_sched_maint')
        ]);

      $task->save();
        
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
       // $task = Task::find($id);
       
        $task = DB::table('tasks')
        ->join('motors','motors.id','=', 'tasks.motor_id')
        ->select('tasks.*','motors.model')
        ->where('tasks.id','=',$id)
        ->first();
      
        app('debugbar')->error($task);
        return response()->json($task);
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
      $task = Task::find($id);
      $task->update($request->all());
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
      $task = Task::find($id);

      $task->delete();

      return response()->json('successfully deleted');
    }
}
