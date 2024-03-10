<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>State list</title>
</head>
<body>
    <h1>State List</h1>
    <a href="{{route('state.create')}}">Add State</a>
    {{session()->get('success')}}
    <table border="1" cellspacing="0">
        <tr>
            <th>Sr.No</th>
            <th>Country</th>
            <th>State</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php
         $i = 1;   
        @endphp
        @foreach ($state as $_state)
        
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_state->country->name??""}}</td>
            
            <td>{{$_state->name??""}}</td>
            <td>{{($_state->status==1)?"Enable":"Disable"}}</td>
            <td>
                <a href="{{route('state.edit',$_state->id)}}">Edit</a> ||
                <form action="{{ route('state.destroy',$_state->id) }}" method="POST">
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