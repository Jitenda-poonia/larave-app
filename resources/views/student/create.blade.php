<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .error {
            color: red;
        }
    </style>
</head>


<body>
    <h1>Student Informestion</h1>
    <table cellspacing="5px">
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <tr>
                <td><label for="">First Name</label></td>
                <td><input type="text" name="first_name" id="" maxlength="30" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>

            </tr>
            <tr>
                <td><label for="">List Name</label></td>
                <td><input type="text" name="last_name" id="" maxlength="30" value="{{ old('last_name') }}">
                </td>
            </tr>
            <tr>
                <td><label for="">DOB</label></td>
                <td><input type="date" name="dob" id="" value="{{ old('dob') }}">
                    @error('dob')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="">Email</label></td>
                <td><input type="email" name="email" id="" value="{{ old('email') }}">

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="">Mobile</label></td>
                <td><input type="tel" name="phone" id="" maxlength="" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </td>
            </tr>
            <tr>
                <td><label for="">Gender</label></td>
                <td>
                    <input type="radio" name="gender" id="" value="m"
                        {{ old('gender') == 'm' ? 'checked' : '' }}>Male
                    <input type="radio" name="gender" id="" value="f"
                        {{ old('gender') == 'f' ? 'checked' : '' }}>Female

                    @error('gender')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="">Address</label></td>
                <td>
                    <textarea name="address" id="" cols="30" rows="4">{{ old('address') }}</textarea>

                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Select Country</td>
                <td>
                    <select name="country_id" id="countryId">
                        <option value="" selected disabled>Select</option>
                        @foreach ($countryData as $_countryData)
                            <option value="{{ $_countryData->id}}" {{(old('country_id')== $_countryData->id )? 'selected':''}}>{{ $_countryData->name }}</option>
                        @endforeach

                    </select>
                </td>
            </tr>

            <tr>
                <td>Select State</td>
                <td>
                    <select name="state_id" id="stateId">

                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="">City</label></td>
                <td><input type="text" name="city" id="" value="{{ old('city') }}">

                    @error('city')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="">Pincode</label></td>
                <td><input type="number" name="pincode" min="100000" max="999999" value="{{ old('pincode') }}">

                    @error('pincode')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="">Hobbies</label></td>
                <td>
                    @php
                        $hobbies = old('hobbies') ?? [];

                    @endphp
                    <input type="checkbox" name="hobbies[]" value="drawing"
                        {{ in_array('drawing', $hobbies) ? 'checked' : '' }}>Drawing
                    <input type="checkbox" name="hobbies[]" value="singing"
                        {{ in_array('singing', $hobbies) ? 'checked' : '' }}>singing
                    <input type="checkbox" name="hobbies[]" value="dancing"
                        {{ in_array('dancing', old('hobbies') ?? []) ? 'checked' : '' }}>Dancing
                    <input type="checkbox" name="hobbies[]" value="sketching"
                        {{ in_array('sketching', old('hobbies') ?? []) ? 'checked' : '' }}>sketching
                    <input type="checkbox" name="hobbies[]" value="other">other
                    <input type="text" name="other_hobbies" value="{{ old('other_hobbies') }}">
                    @error('hobbies')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th><label for="">Qualification</label></th>


                <td>

                    <table>
                        <th>Sr.No</th>
                        <th>Examination</th>
                        <th>Bord/University</th>
                        <th>percentage</th>
                        <th>Passing year</th>

                        <tr>
                            <td>1</td>
                            <td><input type="text" name="examination[]" value="Class-X" readonly></td>
                            <td><input type="text" name="board[]" value="{{ old('board.0') }}"></td>
                            <td><input type="number" name="percentage[]" min="33" max="100"
                                    value="{{ old('percentage.0') }}"></td>
                            <td><input type="number" min="1000" max="9999" step="1" name="year[]"
                                    value="{{ old('year.0') }}">
                            </td>
                        </tr>
                        <tr>

                            <td>2</td>
                            <td><input type="text" name="examination[]" value="Class-XII" readonly></td>
                            <td><input type="text" name="board[]" value="{{ old('board.1') }}"></td>
                            <td><input type="number" name="percentage[]" min="33" max="100"
                                    value="{{ old('percentage.1') }}"></td>
                            <td><input type="number" min="1000" max="9999" step="1" name="year[]"
                                    value="{{ old('year.1') }}">
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><input type="text" name="examination[]" value="Graduation" readonly></td>
                            <td><input type="text" name="board[]" value="{{ old('board.2') }}"></td>
                            <td><input type="number" name="percentage[]" min="33" max="100"
                                    value="{{ old('percentage.2') }}"></td>
                            <td><input type="number" min="1000" max="9999" step="1" name="year[]"
                                    value="{{ old('year.2') }}">
                            </td>
                        <tr>
                            <td>4</td>
                            <td><input type="text" name="examination[]" value="Post-Graduation" readonly></td>
                            <td><input type="text" name="board[]" value="{{ old('board.3') }}"></td>
                            <td><input type="number" name="percentage[]" min="33" max="100"
                                    value="{{ old('percentage.3') }}"></td>
                            <td><input type="number" min="1000" max="9999" step="1" name="year[]"
                                    value="{{ old('year.3') }}">
                            </td>
                        </tr>
                    </table>

                    @error('board.0')
                        <span class="error">{{ $message }}</span>
                    @enderror

                    @error('percentage.0')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    @error('year.0')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Course Apply For</td>
                <td>
                    <input type="radio" name="course" value="BCA"
                        {{ old('course') == 'BCA' ? 'checked' : '' }}>BCA
                    <input type="radio" name="course"
                        value="BCOM"{{ old('course') == 'BCOM' ? 'checked' : '' }}>B.COM
                    <input type="radio" name="course" value="BSC"
                        {{ old('course') == 'BSC' ? 'checked' : '' }}>B.SC
                    <input type="radio" name="course" value="BA"
                        {{ old('course') == 'BA' ? 'checked' : '' }}>B.A

                    @error('course')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </td>
            </tr>



            <tr>
                <td></td>
                <td>
                    <input type="reset" value="Reset">
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </form>
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
       
    </table>
</body>

</html>
