<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::all()->where("status",1);
       return view('city.index',compact('city'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     $countryData = Country::all();
        //   $stateData = State::all();
        return view('city.create',compact('countryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $cntID =  $request->country_id;
       $stID =  $request->state_id;
       $cityName =  $request->city_name;
       $cityStatus =  $request->city_status;
    foreach ($cityName as $key => $_cityName) {
       $ctStatus =  $cityStatus[$key];
    
      City::create([
        "country_id" => $cntID ,
        "state_id" => $stID,
        "name" => $_cityName,
        "status" => $ctStatus
      ]);
    } 
     return redirect()->route('city.index')->withSuccess('Data Save successfully');
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
        $city = City::find($id); 
           
        $countryData = Country::select('id','name')->where('status',1)->get(); 

        // $stateData = State::where('state_status',1)->where('country_id',$city->country_id)->get(); 
        $stateData = State::select('id','name')->where('country_id',$city->country_id)->where('status',1)->get();  //use of where -> edit ke time jo county select h only uske hi sate show ho baki state country change pr ho show ho
    
        return view('city.edit',compact('city','countryData','stateData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
       $cntID =   $request->country_id;
       $stID =   $request->state_id;
       $cityName = $request->city_name;
        $cityStatus = $request->city_status;
        
        foreach ($cityName as $key => $_cityName) {
            $_cityStatus =  $cityStatus[$key]??0;
            $city->update([
                "country_id" => $cntID,
                "state_id" => $stID,
                "name" => $_cityName,
                "status" => $_cityStatus 
            ]);
        }

      
        return redirect()->route('city.index')->withSuccess("Data Update Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        City::find($id)->delete();
        State::where('state_id',$id)->delete();
        return redirect()->route('city.index')->withSuccess("Data delete Successfully");
        
    }
}
 