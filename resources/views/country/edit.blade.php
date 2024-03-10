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
    <h1>Update country</h1>
</body>
<form action="{{ route('country.update', $country->id) }}" method="POST">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td> <label>Country Name</label></td>
            <td><input type="text" name="name" value="{{ $country->name }}"></td>

        </tr>
        <tr>
            <td><label>Status</label></td>
            <td>
                <select name="status" id="">
                    <option value="">Select</option>
                    <option value="1"{{ $country->status == 1 ? 'selected' : '' }}>Enable</option>
                    <option value="2"{{ $country->status == 2 ? 'selected' : '' }}>Disable</option>
                </select>
            </td>
        </tr>
        <tr>

            <table class="table-data">
                <td>State</td>
                <th>State Name</th>
                <th>State Status</th>
                <td><button type="button" class="add"
                        style="{{ count($country->states) == 4 ? 'display: none;' : '' }}">+</button></td>

                @foreach ($country->states as $_state)
                    {{-- country ke model me state function ,state model ka use --}}


                    <tr>
                        <input type="hidden" name="Sid[]" value="{{ $_state->id }}">
                        <td></td>
                        <td><input type="text" name="state_name[]" value="{{ $_state->name }}"></td>

                        <td>
                            <select name="state_status[]" id="">
                                <option value="">Select</option>
                                <option value="1" {{ $_state->status == 1 ? 'selected' : '' }}>Enable</option>
                                <option value="2" {{ $_state->status == 2 ? 'selected' : '' }}>Disable</option>
                            </select>
                        </td>
                        <td><button type="button" class="remove">X</button></td>
                    </tr>
                @endforeach
            </table>

        </tr>
        <tr>

            <td>
                <button type="submit">Update</button>

            </td>
        </tr>
    </table>
</form>
<script>
    $(document).ready(function() {
        $(".add").click(function() {
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
            if ($(".table-data tr").length == 5) {
                $(".add").hide();
            }
        });
        $(".table-data").delegate(".remove", "click", function() {
            $(this).closest("tr").remove();
            $(".add").show();

        });
    });
</script>


</html>
