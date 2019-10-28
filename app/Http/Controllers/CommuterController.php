<?php

namespace App\Http\Controllers;

use App\Commuter;
use App\Card;
use Illuminate\Http\Request;

class CommuterController extends Controller
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
        $commuters = Commuter::with('card')->with('user')->get();
        $applications = Card::where('status', 0)->count();
        $granted = Card::where('status', 1)->orWhere('status', 4)->count();
        $rejections = Card::where('status', 2)->count();
        $blocked = Card::where('status', 3)->count();
        return view('passengers/index')
        ->with('commuters', $commuters)
        ->with('applications', $applications)
        ->with('granted', $granted)
        ->with('rejections', $rejections)
        ->with('blocked', $blocked);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commuter  $commuter
     * @return \Illuminate\Http\Response
     */
    public function show(Commuter $commuter)
    {
        //
        $commuter = Commuter::findOrFail($commuter)->with('card')->with('user');
        return view('passengers/index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commuter  $commuter
     * @return \Illuminate\Http\Response
     */
    public function edit(Commuter $commuter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commuter  $commuter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commuter $commuter)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commuter  $commuter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commuter $commuter)
    {
        //
    }
}
