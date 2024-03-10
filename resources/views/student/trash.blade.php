<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Student trash</h1>
    {{ session()->get('success') }}
   <a href="{{ route('student.create') }}"><button style=" cursor:pointer;">Add Student</button></a>
  <table border="1" cellspacing="0">
    <tr>
        <th>Sr.No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Address</th>
        <th>City</th>
        <th>Pincode</th>
        <th>State</th>
        <th>Country</th>
        <th>Hobbies</th>
        <th>Other Hobbies</th> 
        <th>Applied Course</th>
        <th>Action</th>
    </tr>
    @php
    $i = 1;
    @endphp
    @if($students->count())
        
   
    @foreach ($students as $_student)
       <tr>
        <td>{{$i++}}</td>
        <td>{{ $_student->first_name }}</td>
        <td>{{ $_student->last_name }}</td>
        <td>{{ $_student->dob }}</td>
        <td>{{ $_student->email }}</td>
        <td>{{ $_student->phone }}</td>
        <td>{{ ($_student->gender=='m')?'Male':'Female' }}</td>
        <td>{{ $_student->address }}</td>
        <td>{{ $_student->city }}</td>
        <td>{{ $_student->pincode }}</td>
        <td>{{ $_student->state->name??"" }}</td>
        <td>{{ $_student->country->name??"" }}</td>
        <td>{{ $_student->hobbies }}</td>
        <td>{{ $_student->other_hobbies }}</td>
        <td>{{ $_student->course }}</td>
        <td>
            <a href="{{ route('student.edit',$_student->id)}}">Restore</a>|| 
            <form action="{{ route('student.destroy',$_student->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="DELETE" name="delete">
            </form>
        </td>
       </tr>
    @endforeach
    @else
        <tr>
            <td colspan="17" align="center">Data not found</td>
        </tr>
    @endif
  </table>
  {{ $students->links()}}  

</body>
</html>