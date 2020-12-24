@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/home.css">
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
              <div class="row " >
                      <div class="col-md-3">
                      @include('layouts.menu_admin') 
                    </div>
                    <div class="col-md-9"> 
                     <div class="jumbotron">
                          <h4 class="">Hello, Admin!</h4>
                          <p class="lead"></p>
                          <hr class="my-4">
                          <p>Employment of students and graduates.</p>
                          <a class="btn btn-primary btn-lg" href="#" role="button">See statistics</a>
                    </div>
                    
                    </div>
                </div>
        </div>
    </div>
  </body>
  <!-- @include('layouts.footer') -->
@endsection