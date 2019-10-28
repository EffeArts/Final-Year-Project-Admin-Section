<?php

namespace App\Http\Controllers;
use App\Route;
use App\EndPoint;
use App\User;
use App\Bus;
use App\Trip;
use App\Driver;
use App\Card;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users = User::count();
        $total_routes = Route::count();
        $total_buses = Bus::count();
        $total_trips = Trip::count();
        $total_drivers = Driver::count();
        $total_commuters = Card::where('status', 1)->orWhere('status', 4)->count();
        return view('home/home')->with('total_users', $total_users)
                                ->with('total_routes', $total_routes)
                                ->with('total_buses', $total_buses)
                                ->with('total_trips', $total_trips)
                                ->with('total_drivers', $total_drivers)
                                ->with('total_commuters', $total_commuters);
    }
}
