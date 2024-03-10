<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update City</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Update city</h1>
</body>
<form action="{{ route('city.update',$city->id) }}" method="POST">
@csrf
@method('PUT')

<table>

    <tr>
        <td>Select country</td>
        <td>
            <select name="country_id" id="countryId">
                <option value="">Select</option>
                @foreach ($countryData as $_countryData)
                    
                <option value="{{$_countryData->id}}" {{($city->country_id==$_countryData->id)?'selected':''}}>{{$_countryData->name}}</option>
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
                    
                <option value="{{$_stateData->id}}" {{($city->state_id==$_stateData->id)?'selected':''}}>{{$_stateData->name}}</option>
                @endforeach
            </select>
        </td>
    </tr>
 
 <tr>
    
        <table class="table-data">
            <td>City</td>
            <th>City Name</th>
            <th>City Status</th>
            {{-- <td><button type="button" class="add">+</button></td> --}}

            <tr>
                <td></td>
                <td><input type="text" name="city_name[]" value="{{$city->name}}"></td>   
               
            <td>
                   <select name="city_status[]" id="">
                    <option value="">Select</option>
                    <option value="1"{{($city->status==1)?"selected":""}}>Enable</option>
                    <option value="2"{{($city->status==2)?"selected":""}}>Disable</option>
                   </select>
                </td>
                {{-- <td><button type="button" class="remove">X</button></td> --}}

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
{{-- <script>
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
</script> --}}

<script>
    $(document).ready(function(){
        $("#countryId").change(function(){
            var cntId = $(this).val();
            
            $.ajax({
                url:'{{route("country-state")}}',
                type:"GET",
                data:{'cntrId':cntId}, 
                success: function(req){
    
                    console.log(req);
                 $("#stateId").html(req);
                },
                error:function(er){
                    console.log(er);
                }
            });
        });
    });
</script>

</html>