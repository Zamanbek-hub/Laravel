@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>
@include('layouts.header_without_reg')

<form class="form-inline my-2 my-lg-0 search_form container">

    <div class="search_from_in_div">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Job" aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit">Search</button>
    </div>
    </form>

    <div class="body_main " >
        <div class="container mt-5">
            <div class="row ">
                <div class="col-md-6">
                    @foreach($favorites as $favorite)
                        <div class="card mb-4" >
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold;">Vacancy :{{$favorite->description}}</h5>
                                <p class="card-subtitle mb-2 text-muted" >Last changes in {{$favorite->updated_at}}</p>
                                <p class="card-text" style="font-weight: bolder;"> Company: {{$favorite->employer->company_name}}</p>
                                <a href="/vacancy/{{$vacancy->id}}" class="btn btn-outline-warning " type="button" style="color: black; border-color: grey; "> More details</a>
                                <a href="#" class="btn btn-outline-warning" type="button" style="color: black; border-color: grey;  margin: 8px;">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
            <hr style="color: #343434;">
            <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-outline-warning mb-5" type="button" style="color: black; border-color: grey; ">Recommendations</a>
        </div>

        </div>
    </div>

    @include('layouts.footer')
</body>
@endsection

