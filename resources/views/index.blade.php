<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <h3> WEB SCRAPE RESULT </h3>
        <table class="table table-stripe">

            <tr>
                <th>Fullname</th>
                <th>Nick Name</th>
                <th>Age</th>
                <th> Phone Number </th>
                <th>Address</th>
                <th>Previous Address</th>
                <th>Relatives</th>
                <th>Associates</th>
            </tr>

            @foreach($persons as $person)

            <tr>
                <td>
                    {{$person->fullname}}
                </td>
                <td>
                    @foreach($person->akas as $aka)
                    - {{$aka->name}} <br>
                    @endforeach

                </td>
                <td>
                    {{$person->age}}
                </td>
                <td>
                    @foreach($person->phones as $phone)
                    {{$phone->phone_no}} <br>
                    @endforeach
                </td>
                <td>
                    {{$person->current_address}}
                </td>
                <td>
                    @foreach($person->previousAddresses as $preAddress)
                    - {{$preAddress->address}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($person->relatives as $relative)
                    - {{$relative->name}} <br>
                    @endforeach

                </td>
                <td>
                    @foreach($person->associates as $associate)
                    - {{$associate->name}} <br>
                    @endforeach
                </td>
            </tr>


            @endforeach

        </table>
    </div>


</body>

</html>