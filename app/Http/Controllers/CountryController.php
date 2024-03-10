<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country::all();
        // dd($country);
        return view('country.index',compact('country'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
      
        $data = $request->all();
        $country = Country::create($data);
        $countryId = $country->id;
        // ---------------End country------------------
        
        $stName = $request->state_name;
        $stStatus = $request->state_status;

        foreach ($stName as $key => $_stName) {
            $_stStatus = $stStatus[$key];
            State::create([
                "country_id" =>$countryId,
                 "name"  =>$_stName,
                 "status" =>$_stStatus

            ]);
        }
        return redirect()->route('country.index')->withSuccess("Data Add Successfully");
       
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
        $country = Country::find($id);   // state data ke liye country ke model me states function me State model ka use kiya hai
       
        // $state = State::where('country_id',$id)->get();
        // $country = Country::where('id',$id)->with('states')->first(); // country  with state model use
        // dd($country);
        return view('country.edit',compact('country'));
        // return view('country.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
 
       Country::whereId($id)->update([
        "name" =>$request->name,
        "status" =>$request->status
       ]);
     
       $stateName =  $request->state_name;
       $stateStatus =  $request->state_status;
       $stateId =  $request->Sid;
    
       if (empty($stateId)) {
                
                State::where('country_id', $id)->delete();
       } else {
        State::whereNotIn('id', $stateId)->where('country_id', $id)->delete();
       }
       
       if(($stateName)) {
        foreach($stateName as $key => $_stateName) {
        $stId = $stateId[$key]??0;
        // dd($stId);     
        if($stId) {
            State::where('id', $stId)->update([
                'name' => $_stateName,
                'status' => $stateStatus[$key],
               
            ]);
        } else {
            State::create([
                'name' => $_stateName,
                'status' => $stateStatus[$key],
                'country_id' => $id,
                // dd($_stateName),
            ]);
        }
    }
}

    return redirect()->route("country.index")->withSuccess('Updated Successfully...');
    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::find($id)->delete();
        State::where('country_id',$id)->delete();
        City::where('country_id',$id)->delete();
        return redirect()->route('country.index')->withSuccess('Data Delete successfully.');
    }


    public function getState(Request $request){      //web.php me getState
          $countryId = $request->cntrId;             //cityCreate & edit page ->cntrId
    
      $states = State::where("country_id",$countryId)->get();
    
      echo "<option value='' Selected Disabled>Select</option>";
      foreach ($states as $key => $state) {

        echo "<option value='{$state->id}'>$state->name</option>";
      }
    }
}
