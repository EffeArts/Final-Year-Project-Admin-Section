<?php

namespace App\Http\Controllers;

use App\EndPoint;
use App\Route;
use Illuminate\Http\Request;

class EndPointController extends Controller
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
        $endpoints = EndPoint::get();
        return view('endpoints/index')->with('endpoints', $endpoints);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('endpoints.create');
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
        $endpoint = EndPoint::create([
            'name' => $request->input('name'),
        ]);

        if($endpoint){
            return redirect()->route('end_points.index')->with('success', 'New end point has been successfully created.');
        }
        return back()->withInput()->with('danger', 'Error adding a new route');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EndPoint  $endPoint
     * @return \Illuminate\Http\Response
     */
    public function show(EndPoint $endPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EndPoint  $endPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(EndPoint $endPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EndPoint  $endPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EndPoint $endPoint)
    {
        //
        $endPoint_update = EndPoint::where('id', $endPoint->id)
        ->update([
            'name' => $request->input('name'),
        ]);
        if($endPoint_update)
        {
            return redirect()->route('end_points.index')->with('success', 'End Point updated successfully');
        }
        return back()->withInput()->with('danger', 'End Point could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EndPoint  $endPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(EndPoint $endPoint)
    {

         //First of all, check if no route is registered to the endpoint that is being thrown under the bus.

        $check_route = Route::where('departure_id', $endPoint->id)->orWhere('destination_id', $endPoint->id)->count();
        if($check_route > 0){
            return back()->withInput()->with('warning', 'Endpoint can not be removed because it has routes registered with it. Deletes the associated routes first!');
        }

        else{
            $endpoint = EndPoint::findOrFail($endPoint->id);
            if($endpoint->delete())
            {
                return redirect()->route('end_points.index')->with('success', 'The endpoint successfully removed.');
            }
            return back()->withInput()->with('danger', 'The endpoint could not be removed!');
        }
    }
}
