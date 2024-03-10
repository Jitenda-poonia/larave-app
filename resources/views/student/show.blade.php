<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student</title>
</head>

<body>
    <h1>Student Show </h1>
    <table border="1" cellspacing='0'>
        <thead>
            <th>Examination</th>
            <th>Board</th>
            <th>%</th>
            <th>year passing</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($student as $_student)
                <td>{{ $_student->examination }}</td>
                <td> {{ $_student->board }}</td>
                <td> {{ $_student->percentage }}</td>
                <td> {{ $_student->year_of_passing}}</td>
            @endforeach
            
        </tbody>
    </table>

</body>

</html>
