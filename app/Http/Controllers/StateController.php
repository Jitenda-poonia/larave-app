<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country; 
use App\Models\State; 
use App\Models\City; 
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $state = State::all()->where('status',1);
        // dd($state);
       return view("state.index",compact('state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryData = Country::select('id','name')->where('status',1)->get();
        
       return view("state.create",compact('countryData'));
        
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $Data = $request->all();
    //    dd($Data);
       $stData = State::create($Data);
    
    $StId = $stData->id;
    $CountryId = $stData->country_id;
    $ctName = $request->city_name;
    $ctStatus = $request->city_status;

    foreach ($ctName as $key => $_ctName) {
        $_ctStatus = $ctStatus[$key]; 
        City::create([
            "country_id" =>$CountryId,
            "state_id" => $StId,
            "name" => $_ctName,
            "status" =>$_ctStatus
        ]); 
    }
    

    return redirect()->route('state.index')->withSuccess('Data Save Successfully');
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
      $state =  State::find($id);

     $countryData = Country::select('id','name')->where('status',1)->get();
    
    //    $city =  City::where('state_id',$id)->get();        //city ke dada ke liye State model me City Model ka use kiya h
    
       return view("state.edit",compact('state','countryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    { 
        // $data = $request->except('_token', '_method');
        // dd($data);
        
        State::whereId($id)->update([
            "country_id" => $request->country_id,
            "name" => $request->state_name,
            "status" => $request->state_status,
        ]);
        $CountryId = $request->country_id;
        $cityId  = $request->city_id;
        $cityName = $request->city_name;
        
        $cityStatus = $request->city_status;
        if ($cityName) {
           
        
        foreach ($cityName as $key => $_cityName) {
            $_cityId = $cityId[$key]??0;
            if($_cityId) {
                City::where('id',$_cityId)->update([
                    "name" => $_cityName,
                    "status" => $cityStatus[$key], 
                ]);
            } else {
                City::create([
                    "name" => $_cityName,
                    "status" => $cityStatus[$key], 
                    "state_id" => $id,
                    "country_id" => $CountryId,
                ]);
            }
              
        }

    }
      
        return redirect()->route('state.index')->withSuccess('Data update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::find($id)->delete();
        City::where('state_id' ,$id)->delete();
        return redirect()->route('state.index')->withSuccess('Data Delete Successfully');
    }
}
