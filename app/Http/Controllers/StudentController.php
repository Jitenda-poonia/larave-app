<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\student_qualification;
use App\Models\Country;
use App\Models\State;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = Student::all(); //->toArray();
        $students = Student::paginate(5);
        // dd($students );
        return view('student.index', compact('students')); //view('student.index'-> student= folder indecx.blade.php,compact('students'->$students)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $countryData = Country::all();
       
        return view('student.create',compact('countryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "first_name" => 'required',
            "dob" => 'required',
            "phone" => 'required|between:10,12',
            // "email" => 'required |email|unique:students',
            "email" => 'required |email',
            "gender" => 'required',
            "address" => 'required',
            "pincode" => 'required',
            "city" => 'required',
            "state_id" => 'required',
            "country_id" => 'required',
            "course" => 'required',
            "hobbies" => 'required', 
            "board.0" => 'required',
            "percentage.0" => 'required',
            "year.0" => 'required',
        ], [
            'first_name.required' => 'Enter your  first name',
            // 'board.*.required' => 'Qualification is raquired field',
            'email.email' => "plz enter your vaild email",
            // 'country_id.required' =>'plesae Country',
        ]);

        $data = $request->except('_token');

        // dd($data); 
        $data["hobbies"] = implode(',', $data["hobbies"]);
        $student = Student::create($data);
        $stuId = $student->id;
        
        $exam = $request->examination;
        
        $board = $request->board;
        $percent = $request->percentage;
        $year = $request->year;

        foreach ($board as $key => $_board) {
            if($_board){

                student_qualification::create([
                    "examination" => $exam[$key],
                    "board" => $_board,
                    "percentage" => $percent[$key],
                    "year_of_passing" => $year[$key],
                    "student_id" => $stuId
                ]);
            }
        }
        
        return redirect()->route('student.index')->withSuccess('Data insterd successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $student = Student::where('id',$id)->get();
        
        // return view('student.show',compact('student'));
        $student = student_qualification::where('student_id',$id)->get();
        
        return view('student.show',compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {  
    //    $student = Student::find($id);
    //    return view('student.edit',compact('student'));

    // }
    public function edit($id)
    {  

        $student = Student::find($id);
        $countryData = Country::select('id','name')->get();
        $stateData = State::select('id','name')->where('country_id', $student->country_id)->get();
    //    dd($stateData);
        // $stuQul = student_qualification::where('student_id', $id)->get();
        //    dd($stuQul);
        return view('student.edit', compact('student','countryData','stateData'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $data = $request->except('_token','_method');
    //    $data["hobbies"] = implode(",",$data["hobbies"]);
    //    $student =  Student::where('id',$id)->update($data);
    // return redirect()->route('student.index')->withSuccess("Data Update Successfully.");

    // }

    //   2nd method

    public function update(Request $request, Student $student)
    {

        $request->validate([
            'first_name' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required'
        ]);
        $data = $request->except('_token', '_method');
       
        $data["hobbies"] = implode(",", $data["hobbies"]);
        $student->update($data);

        $stId = $student['id'];
        $stuQul_id = $request->stuQul_id;
        $exam = $request->examination;
        $board = $request->board;
        $percent = $request->percentage;
        $year = $request->year;

        student_qualification::whereNotIn('id',$stuQul_id )->where('student_id',$stId)->delete();

        if($exam){
        foreach ($exam as $key => $_exam) {
            $stuQulId = $stuQul_id[$key]??0;
            if($stuQulId){

                student_qualification::where('id', $stuQulId)->update([
                    "examination" => $_exam,
                    "board" => $board[$key],
                    "percentage" => $percent[$key],
                    "year_of_passing" => $year[$key]
                ]);
            } else{
                student_qualification::create([
                    "student_id" => $stId,
                    "examination" => $_exam,
                    "board" => $board[$key],
                    "percentage" => $percent[$key],
                    "year_of_passing" => $year[$key]
                ]);
            }


        }
    }

    
        return redirect()->route('student.index')->withSuccess("Data Update Successfully.");

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     Student::where('id',$id)->delete();
    //     return redirect()->route('student.index')->withSuccess('Record Delate successfully.'); 
    // }

    // 2nd method

    public function destroy($id)  //Student-> modal file, $student-> model file ke ka veriable
    {   
    
       student_qualification::where('student_id',$id)->delete();
       Student::where('id',$id)->delete();
      
        return redirect()->route('student.index')->withSuccess('Record Delate successfully.');
    }
//    public function trash(){
//     $students = Student::onlyTrashed();
//     // dd($students);
//     return view('student.trash',compact('students'));
//    }
}
