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
    <div class="m-3">
        <h3> WEB SCRAPE RESULT </h3>
        <table class="table table-stripe">

            <tr>
                <th>Fullname</th>
                <th>Nick Name</th>
                <th>Age</th>
                <th> Phone Number </th>
                <th>Address</th>
                <th>Associates</th>
                <th>Action</th>
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
                <!-- <td>
                        @foreach($person->previousAddresses as $preAddress)
                        - {{$preAddress->address}} <br>
                        @endforeach
                    </td> -->
                <td>
                    @foreach($person->associates as $associate)
                    - {{$associate->name}} <br>
                    @endforeach
                </td>
                <td> <a href="#" data-bs-toggle="modal" data-bs-target="#myModal_{{$person->id}}">See more</a></td>

                <!-- The Modal -->
                <div class="modal" id="myModal_{{$person->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Detail</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <h3>{{$person->fullname}}</h3>
                                <hr>
                                <p><strong>Age:</strong> {{$person->age}}</p>
                                <p> <strong>Address:</strong> {{$person->current_address}}</p>

                                <hr>
                                <strong>Employment</strong>
                                <p> {{$person->current_employment}} </p>
                                <hr>
                                <!-- Phone Numbers -->
                                <hr>
                                <strong>Phone Numbers</strong> <br>
                                <div class="row">
                                    @foreach($person->phones as $phone)
                                    <div class="col-6">
                                        <span>- {{$phone->phone_no}}</span> <br>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>

                                <!-- Associates -->
                                <hr>
                                <strong>Associates</strong> <br>
                                <div class="row">
                                    @foreach($person->associates as $associate)
                                    <div class="col-6">
                                        <span>- {{$associate->name}}</span> <br>
                                        <span class="mx-3"><strong>Age:</strong> {{$associate->age}}</span><br>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>

                                <!-- Relatives -->
                                <hr>
                                <strong>Relatives</strong> <br>
                                <div class="row">
                                    @foreach($person->relatives as $relative)
                                    <div class="col-6">
                                        <span>- {{$relative->name}}</span> <br>
                                        <span class="mx-3"> {{$relative->age}}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <hr>

                                <!-- Businesses -->
                                <hr>
                                <strong>Businesses</strong> <br>
                                @foreach($person->businesses as $business)
                                <span>- {{$business->name}}</span> <br>
                                @endforeach
                                <hr>

                                <!-- Education -->
                                <hr>
                                <strong>Educations</strong> <br>
                                @foreach($person->educations as $education)
                                <span>- {{$education->data}}</span> <br>
                                @endforeach
                                <hr>

                                <!-- Previous Addresses -->
                                <hr>
                                <strong>Previous Addresses</strong> <br>
                                @foreach($person->previousAddresses as $preAddress)
                                <span>- {{$preAddress->address}}</span> <br>
                                @endforeach
                                <hr>

                                <!-- Work Exp -->
                                <hr>
                                <strong>Work experiences</strong> <br>
                                @foreach($person->works as $work)
                                <span>- {{$work->work_exp}}</span> <br>
                                <br>
                                @endforeach
                                <hr>

                                <!-- Summary-->
                                <hr>
                                <strong>Summary</strong> <br>
                                <p>{{$person->report}}</p>
                                <hr>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </tr>


            @endforeach

        </table>
    </div>


</body>

</html>