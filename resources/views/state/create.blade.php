<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add State</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Add State And city</h1>

<form action="{{ route('state.store') }}" method="POST">
@csrf
<table>
    <tr>
        <td>Select Country</td>
        <td>
            <select name="country_id" id="">
                <option value="">Select</option>
                @foreach ($countryData as $_countryData)
                    
                <option value="{{$_countryData->id}}">{{$_countryData->name}}</option>
                @endforeach
            </select>
        </td>
    </tr>

 <tr>
    <td> <label>State Name</label></td>
    <td><input type="text" name="name"></td>   
   
</tr>
 <tr>
    <td><label>Status</label></td>
    <td>
       <select name="status" id="">
        <option value="">Select</option>
        <option value="1">Enable</option>
        <option value="2">Disable</option>
       </select>
    </td>
 </tr>
 <tr>
    
        <table class="table-data">
            <td>City</td>
            <th>City Name</th>
            <th>City Status</th>
            <td><button type="button" class="add">+</button></td>

            <tr>
                <td></td>
                <td><input type="text" name="city_name[]"></td>   
               
            <td>
                   <select name="city_status[]" id="">
                    <option value="">Select</option>
                    <option value="1">Enable</option>
                    <option value="2">Disable</option>
                   </select>
                </td>
             </tr>
            
        </table>
    
 </tr>
 <tr>
    <td>
        <button type="submit">Submit</button>
       </td>
 </tr>
</table>
</form>
<script>
    $(document).ready(function(){
        $(".add").click(function(){
            tabaleRecord = `<tr>
                <td></td>
                <td><input type="text" name="city_name[]"></td>   
               
            <td>
                   <select name="city_status[]" id="">
                    <option value="">Select</option>
                    <option value="1">Enable</option>
                    <option value="2">Disable</option>
                   </select>
                </td>
                <td><button type="button" class="remove">X</button></td>
             </tr>`;
             $(".table-data").append(tabaleRecord);
        });
        $(".table-data").delegate(".remove","click",function(){
            $(this).closest("tr").remove();
        });
    });
</script>
</body>

</html>