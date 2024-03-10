<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Country</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Add country</h1>

<form action="{{ route('country.store') }}" method="POST">
@csrf
<table>
 <tr>
    <td> <label>Country Name</label></td>
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
            <td>State</td>
            <th>State Name</th>
            <th>State Status</th>
            <td><button type="button" class="add">+</button></td>

            <tr>
                <td></td>
                <td><input type="text" name="state_name[]"></td>   
               
            <td>
                   <select name="state_status[]" id="">
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
                <td><input type="text" name="state_name[]"></td>   
               
            <td>
                   <select name="state_status[]" id="">
                    <option value="">Select</option>
                    <option value="1">Enable</option>
                    <option value="2">Disable</option>
                   </select>
                </td>
                <td><button type="button" class="remove">X</button></td>
             </tr>`;
             $(".table-data").append(tabaleRecord);
             if ($(".table-data tr").length ==5) {     //only 4 rows
                $(".add").hide();
             }
        });
        $(".table-data").delegate(".remove","click",function(){
            $(this).closest("tr").remove();
            $(".add").show();
        });
    });
</script>
</body>

</html>