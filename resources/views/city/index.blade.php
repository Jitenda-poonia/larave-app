<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City list</title>
</head>
<body>
    <h1>City List</h1>
    <a href="{{route('city.create')}}">City State</a>
    {{session()->get('success')}}
    <table border="1" cellspacing="0">
        <tr>
            <th>Sr.No</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php
         $i = 1;   
        @endphp
        @foreach ($city as $_city)
            
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_city->country->name??""}}</td>
            <td>{{$_city->state->name??""}}</td>
            <td>{{$_city->name}}</td>
            <td>{{($_city->status==1)?"Enable":"Disable"}}</td>
            <td>
                <a href="{{route('city.edit',$_city->id)}}">Edit</a> ||
       
                <form action="{{ route('city.destroy',$_city->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="DELETE" name="delete">
                    </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>