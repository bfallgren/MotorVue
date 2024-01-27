<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MotorCollection;
use App\Motor;
use Barryvdh\Debugbar\Facade as DebugBar;

class MotorController extends Controller
{
    public function store(Request $request)
    {
      $request->validate([
        'make' => 'required',
        'model' => 'required',
        'mfg_year' => 'required',
        'current_mileage' => 'required',
        
      ]);
      $default_type = 1;
      $refer = request()->headers->get('referer');
      Debugbar::info('#refer ',$refer);
      if (str_contains($refer, 'powerdevs')) {
        $default_type = 2;
      }

      //Debugbar::info('#2 ',request()->headers->get('referer'));
      //Debugbar::info('#4 ',url()->previous());

      $motor = new Motor([
        'motor_type' => $default_type,
        'make' => $request->get('make'),
        'model' => $request->get('model'),
        'mfg_year' => $request->get('mfg_year'),
        'current_mileage' => $request->get('current_mileage'),
        'vid' => $request->get('vid'),
        'license_tag' => $request->get('license_tag'),
        'insurance_policy' => $request->get('insurance_policy'),
        'insurance_provider' => $request->get('insurance_provider'),
        'mfg_warr' => $request->get('mfg_warr'),
        'ext_warr' => $request->get('ext_warr'),
        'ext_warr_provider' => $request->get('ext_warr_provider'),
        'ext_warr_phone' => $request->get('ext_warr_phone'),
        'ext_warr_contract' => $request->get('ext_warr_contract'),
        'avatar' => $request->get('avatar')

      ]);

      $motor->save();

      return response()->json('successfully added');
    }

    public function index()
    {
      $default_type = 1;
      $refer = request()->headers->get('referer');
      Debugbar::info('#refer ',$refer);
      if (str_contains($refer, 'powerdevs')) {
        $default_type = 2;
      }
      $motors = Motor::orderBy('mfg_year', 'DESC')->where('motor_type','=',$default_type)->get();
      return new MotorCollection($motors);
     
    }

    public function show($id)
    {
      $motor = Motor::find($id);
      return response()->json($motor);
    }

    public function edit($id)
    {
      $motor = Motor::find($id);
      return response()->json($motor);
    }

    public function update($id, Request $request)
    {
      $motor = Motor::find($id);

      $motor->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $motor = Motor::find($id);

      $motor->delete();

      return response()->json('successfully deleted');
    }
}
