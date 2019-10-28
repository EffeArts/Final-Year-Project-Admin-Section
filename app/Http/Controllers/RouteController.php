<?php

namespace App\Http\Controllers;

use App\Route;
use App\Bus;
use App\EndPoint;
use Illuminate\Http\Request;

class RouteController extends Controller
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
        $routes = Route::get();
        $endpoints = EndPoint::get();
        $buses = Bus::get();
        return view('routes/index')->with('routes', $routes)
        ->with('endpoints', $endpoints)
        ->with('buses', $buses);
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
        $departure =  $request->input('departure');
        $destination  = $request->input('destination');
        $fare = $request->input('fare');

        //Validating route duplicates, to disallow creation of routes duplication
        $route_duplicate = Route::get()->where('departure_id', $departure)->where('destination_id', $destination)->count();
        if($route_duplicate > 0){
            return back()->withInput()->with('danger', 'Another Route with the same departure and destination already exists.');
        }

        //Validating route, to disallow creation of routes with the same destination as departure
        if($departure === $destination){
            return back()->withInput()->with('warning', 'The route you are trying to create has the same destination as the departure.');
        }

        $route = Route::create([
            'departure_id' => $departure,
            'destination_id' => $destination,
            'fare' => $fare
        ]);

        if($route){
            return redirect()->route('routes.index')->with('success', 'New route has been successfully created.');
        }
        return back()->withInput()->with('danger', 'Error adding a new route');  
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        $departure = $request->input('departure1');
        $destination = $request->input('destination1');

        //Validation: It shouldn't allow to put in a route with same departure and destination
        if($departure === $destination){
            return back()->withInput()->with('danger', 'Route could not be updated, because it has same destination as departure!');
        }

        else {

            // Another Validation: To check if the route is not being edited to be similar
            //to the one that is already in the Database

            $route_duplicate_check = Route::get()->where('departure', $departure)->where('destination', $destination)->count();
            if($route_duplicate_check > 0){
                return back()->withInput()->with('danger', 'Another Route with the same departure and destination already exists.');
            }

            $route_update = Route::where('id', $route->id)
            ->update([
                'departure_id' => $departure,
                'destination_id' => $destination,
                'fare' => $request->input('fare1')
            ]);
            if($route_update)
            {
                return redirect()->route('routes.index')->with('success', 'Route updated successfully');
            }
            return back()->withInput()->with('danger', 'Route could not be updated');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {

        

        //First of all, check if no bus is registered to the route that is being thrown under the bus.
        $check_bus = Bus::where('route_id', $route->id)->count();
        if($check_bus > 0){
            return back()->withInput()->with('warning', 'The route you are trying to delete has buses registered to it, first delete the bus!');
        }

        else{
            $route = Route::findOrFail($route->id);
            if($route->delete())
            {

                return redirect()->route('routes.index')->with('success', 'Route successfully deleted');
                
            }
            return back()->withInput()->with('danger', 'Route removal failed!');
        }
    }
}
