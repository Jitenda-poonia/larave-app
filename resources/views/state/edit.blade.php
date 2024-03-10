<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit State </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Update State & City</h1>
</body>
<form action="{{ route('state.update' ,$state->id) }}" method="POST">
@csrf
@method('PUT')
<table>
    <tr>
        <td>Select Country</td>
        <td>
            <select name="country_id" id="">
                <option value="">Select</option>
                @foreach ($countryData as $_countryData)
                    
                <option value="{{$_countryData->id}}" {{($state->country_id==$_countryData->id)?'selected':''}}>{{$_countryData->name}}</option>
                @endforeach
            </select>
        </td>
    </tr>

 <tr>
    <td> <label>State Name</label></td>
    <td><input type="text" name="state_name" value="{{$state->name}}"></td>   
   
</tr>
 <tr>
    <td><label>Status</label></td>
    <td>
       <select name="state_status" id="">
        <option value="">Select</option>
        <option value="1"{{($state->status==1)?"selected":""}}>Enable</option>
        <option value="2"{{($state->status==2)?"selected":""}}>Disable</option>
       </select>
    </td>
 </tr>
 <tr>
    
        <table class="table-data">
            <td>City</td>
            <th>City Name</th>
            <th>City Status</th>
            <td><button type="button" class="add">+</button></td>
             
            @foreach ($state->cities as $_city)
                 
            <tr>
                <input type="hidden" name="city_id[]" value="{{$_city->id}}">
                <td></td>
                <td><input type="text" name="city_name[]" value="{{$_city->name}}"></td>   
               
            <td>
                   <select name="city_status[]" id="">
                    <option value="">Select</option>
                    <option value="1"{{($_city->status==1)?"selected":""}}>Enable</option>
                    <option value="2"{{($_city->status==2)?"selected":""}}>Disable</option>
                   </select>
                </td>
                <td><button type="button" class="remove">X</button></td>

             </tr>
             @endforeach
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


</html>