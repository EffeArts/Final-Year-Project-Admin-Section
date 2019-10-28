<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Bus;
use Illuminate\Http\Request;

class DriverController extends Controller
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

    // Validator to check that no driver duplicates
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:drivers',
            'drivers_lic_number' => 'required|unique:drivers',
            'contact' => 'required|unique:drivers'
            
        ]);
    }
    public function index()
    {
        //
        $drivers = Driver::get();
        return view('drivers/index')->with('drivers', $drivers);
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
        $first_name =  $request->input('fname');
        $last_name  = $request->input('lname');
        $birthday = strtotime($request->input('dob'));
        $dob = date('Y/m/d', $birthday);
        $gender = $request->input('gender');
        $contact = $request->input('contact');
        $email = $request->input('email');
        $lic_num = $request->input('licence');
        $nid = $request->input('nid');
        $address = $request->input('address');

        $driver = Driver::create([
            'fname' => $first_name,
            'lname' => $last_name,
            'dob' => $dob,
            'gender' => $gender,
            'nid' => $nid,
            'address' => $address,
            'contact' => $contact,
            'email' => $email,
            'driver_lic_number' => $lic_num,
            'status' => 0
        ]);

        if($driver){
            return redirect()->route('drivers.index')->with('success', 'New driver has been successfully added.');
        }
        return back()->withInput()->with('danger', 'Error adding a new driver');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
        $driver_update = Driver::where('id', $driver->id)
        ->update([
            'fname' => $request->input('fname1'),
            'lname' => $request->input('lname1'),
            'contact' => $request->input('contact1'),
            'email' => $request->input('email1'),
            'driver_lic_number' => $request->input('licence1')
        ]);
        if($driver_update)
        {
            return redirect()->route('drivers.index')->with('success', 'Driver updated successfully');
        }
        return back()->withInput()->with('danger', 'Driver could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //First of all, check if no bus is registered to the driver

        $check_bus = Bus::where('driver_id', $driver->id)->count();
        if($check_bus > 0){
            return back()->withInput()->with('warning', 'Driver could not be removed, because he is registered to a bus');
        }

        else{
            $driver = Driver::findOrFail($driver->id);
            if($driver->delete())
            {
                return redirect()->route('drivers.index')->with('success', 'Driver removed successfully.');
            }
            return back()->withInput()->with('danger', 'Driver could not be removed!');
        }
        

    }
}
