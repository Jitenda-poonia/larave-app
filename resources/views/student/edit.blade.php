<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Edit</title>
</head>

<body>
    <h1>Student Edit</h1>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student form</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
            .error {
                color: red
            }
        </style>
    </head>

    <body>
        <form action="{{ route('student.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table cellspacing="5px">
                <tr>
                    <td><label for="">First Name</label></td>
                    <td><input type="text" name="first_name" id="" maxlength="30"
                            value="{{ $student->first_name }}">

                        @error('first_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">List Name</label></td>
                    <td><input type="text" name="last_name" id="" maxlength="30"
                            value="{{ $student->last_name }}"></td>
                </tr>
                <tr>
                    <td><label for="">DOB</label></td>
                    <td><input type="date" name="dob" id="" value="{{ $student->dob }}">
                        @error('dob')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">Email</label></td>
                    <td><input type="email" name="email" id="" value="{{ $student->email }}">

                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">Mobile</label></td>
                    <td><input type="tel" name="phone" id="" maxlength="10"
                            value="{{ $student->phone }}">

                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">Gender</label></td>
                    <td>
                        <input type="radio" name="gender" id="" value="m"
                            {{ $student->gender == 'm' ? 'checked' : '' }}>Male
                        <input type="radio" name="gender" id="" value="f"
                            {{ $student->gender == 'f' ? 'checked' : '' }}>Feale
                    </td>
                </tr>
                <tr>
                    <td><label for="">Address</label></td>
                    <td>
                        <textarea name="address" id="" cols="30" rows="4">{{ $student->address }}</textarea>

                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">City</label></td>
                    <td><input type="text" name="city" id="" value="{{ $student->city }}">
                        @error('city')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">Pincode</label></td>
                    <td><input type="number" name="pincode" min="100000" max="999999"  value="{{ $student->pincode }}">

                        @error('pincode')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Select country</td>
                    <td>
                        <select name="country_id" id="countryId">
                            <option value="">Select</option>
                            @foreach ($countryData as $_countryData)
                                
                            <option value="{{$_countryData->id}}" {{($student->country_id==$_countryData->id)?'selected':''}}>{{$_countryData->name}}</option>
                            @endforeach
                        </select>
                       
                    </td>
                </tr>
            
                <tr>
                    <td>Select State</td>
                    <td>
                        <select name="state_id" id="stateId">
                            <option value="">Select</option>
                            @foreach ($stateData as $_stateData)
                                
                            <option value="{{$_stateData->id}}" {{($student->state_id==$_stateData->id)?'selected':''}}>{{$_stateData->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="">Hobbies</label></td>
                    @php
                        $explod_hobbies = explode(',', $student->hobbies);
                    @endphp
                    {{-- {{print_r($explod_hobbies) }} --}}
                    <td>
                        <input type="checkbox" name="hobbies[]" value="drawing"
                            {{ in_array('drawing', $explod_hobbies) ? 'checked' : '' }}>Drawing
                        <input type="checkbox" name="hobbies[]" value="singing"
                            {{ in_array('singing', $explod_hobbies) ? 'checked' : '' }}>singing
                        <input type="checkbox" name="hobbies[]" value="dancing"
                            {{ in_array('dancing', $explod_hobbies) ? 'checked' : '' }}>Dancing
                        <input type="checkbox" name="hobbies[]"
                            value="sketching"{{ in_array('sketching', $explod_hobbies) ? 'checked' : '' }}>sketching
                        <input type="checkbox" name="hobbies[]" value="other"
                            {{ in_array('other', $explod_hobbies) ? 'checked' : '' }}>other
                        <input type="text" name="other_hobbies" value="{{ $student->other_hobbies }}">
                    </td>
                </tr>
                <tr>
                    <th><label for="">Qualification</label></th>


                    <td>

                        <table id="table-data">
                            <th>Sr.No</th>
                            <th>Examination</th>
                            <th>Bord/University</th>
                            <th>percentage</th>
                            <th>Passing year</th>
                            <td>
                                <button type="button" class="add-rows" style="{{ (count($student->stuQul)==4)?'display: none;':'' }}">+add</button>
                            </td>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($student->stuQul as $_stuQul)  
                            {{-- stuQul->  Student Model me stuQul function h  jisme Student_qualfication modl ka use kiya gay hai  --}}
                                <tr>
                                    <input type="hidden" name="stuQul_id[]" value="{{ $_stuQul->id }}">
                                    <td>{{ $i++ }}</td>
                                    <td><input type="text" name="examination[]"
                                            value="{{ $_stuQul->examination }}" readonly></td>
                                    <td><input type="text" name="board[]" value="{{ $_stuQul->board }}"></td>
                                    <td><input type="number" name="percentage[]" size="6"
                                            value="{{ $_stuQul->percentage }}"></td>
                                    <td><input  type="number" min="1000" max="9999" step="1" name="year[]" id="" size="6"
                                            value="{{ $_stuQul->year_of_passing }}"></td>
                                            
                                            @if ($_stuQul->examination != 'Class-X')
                                                <td><button type="button" class="remove">X</button></td>
                                            @endif
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Course Apply For</td>
                    <td>
                        <input type="radio" name="course" id="" value="BCA"
                            {{ $student->course == 'BCA' ? 'checked' : '' }}>BCA
                        <input type="radio" name="course" id="" value="BCOM"
                            {{ $student->course == 'BCOM' ? 'checked' : '' }}>B.COM
                        <input type="radio" name="course" id="" value="BSC"
                            {{ $student->course == 'BSC' ? 'checked' : '' }}>B.SC
                        <input type="radio" name="course" id="" value="BA"
                            {{ $student->course == 'BA' ? 'checked' : '' }}>B.A
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="reset" value="Reset">
                        <input type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
        
       
        <script>
            $(document).ready(function() {
                $(".add-rows").click(function() {
                    var tableRec = `<tr>
   
                                           <td>{{ $i++ }}</td>
                                           <td><input type="text" name="examination[]"></td>
                                           <td><input type="text" name="board[]" ></td>
                                           <td><input type="number" name="percentage[]" size="6" ></td>
                                           <td><input  type="number" min="1000" max="9999" step="1" name="year[]" id="" size="6" ></td>
                                            <td><button class="remove">X</button></td>
                                         </tr>`;

                   
                    $("#table-data").append(tableRec);
                    if($("#table-data tr").length == 5) {
                        $('.add-rows').hide();
                    }
                });
                $("#table-data").delegate(".remove", "click", function() {
                    $(this).closest("tr").remove();
                    $('.add-rows').show();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#countryId").change(function() {
                    var cntId = $(this).val();
                    // alert(cntId);    
                    $.ajax({
                        url: '{{ route('country-state') }}',
                        type: "GET",
                        data: {
                            'cntrId': cntId
                        }, //countryController
                        success: function(req) {

                            console.log(req);
                            $("#stateId").html(req);
                        },
                        error: function(er) {
                            console.log(er);
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
</body>

</html>
