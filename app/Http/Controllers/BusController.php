<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Driver;
use App\Route;
use App\EndPoint;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $buses = Bus::get();
        // It will only fetch drivers whose status 0, which means who aren't assigned to any bus
        $drivers = Driver::get()->where('status', 0); 
        $routes = Route::get();
        $endpoints = EndPoint::get();
        return view('buses/index')->with('buses', $buses)
        ->with('drivers', $drivers)
        ->with('routes', $routes)
        ->with('endpoints', $endpoints);
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
        //
        $driver =  $request->input('driver');
        $route  = $request->input('route');
        $number_plate = $request->input('number_plate');
        $model = $request->input('model');

        $bus = Bus::create([
            'driver_id' => $driver,
            'route_id' => $route,
            'number_plate' => $number_plate,
            'model' => $model
        ]);

        if($bus){

            $driver_update = Driver::where('id', $driver)
            ->update([
                'status' => 1
            ]);
            if($driver_update){
              return redirect()->route('buses.index')->with('success', 'New bus has been successfully added.');  
          }
      }
      return back()->withInput()->with('danger', 'Error adding a new bus!');
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //First I get the drivers_ID
        $driver = Bus::where('id', $bus->id)->value('driver_id');
        $bus = Bus::findOrFail($bus->id);
        if($bus->delete())
        {
            $driver_update = Driver::where('id', $driver)
            ->update([
                'status' => 0
            ]);
            if($driver_update){
                return redirect()->route('buses.index')->with('success', 'Bus successfully removed');
            }
        }
        return back()->withInput()->with('danger', 'Bus removal failed!');
    }
}
