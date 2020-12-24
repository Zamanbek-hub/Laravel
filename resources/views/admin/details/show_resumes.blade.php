@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
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
                        <div class="card mb-4" >
                            <div class="card-body"> 
                                <h5 class="card-title mt-3 mb-3" align="center" style="font-weight: bold; "> Resume </h5>
                                <p class="card-text" > Fullname:<span style="font-weight: bolder;"> {{$resume->full_name}}  </span></p>
                                    @if(count($resume->specialties)!=0)
                                        <p class="card-text pr-2" > Specialty :  
                                            @for($i=0; $i<count($resume->specialties); $i++)
                                                <span style="font-weight: bolder;">  {{ $resume->specialties[$i]->name }} 
                                                @if($i<count($resume->specialties)-1)
                                                    ,
                                                @endif
                                                </span> 
                                            @endfor
                                        </p>
                                    @else
                                    <p class="card-text" > Specialty: <em>no specialty</em> </p>
                                @endif
                                <p class="card-text" > Salary:<span style="font-weight: bolder;"> {{$resume->salary}} KZT  </span></p>
                                <p class="card-text" > Email:<span style="font-weight: bolder;"> {{$resume->email}}  </span></p>

                                <p class="card-text" > Telephone number:<span style="font-weight: bolder;"> <em>{{$resume->phone_number}} </em> </span></p>
                                <p class="card-text" > Portfolio URL:<span style="font-weight: bolder;"> {{$resume->url_portfolio}}  </span></p>
                                    @if(count($resume->skills)!=0)
                                        <p class="card-text" > Skills: 
                                            @foreach($resume->skills as $skill)
                                                <span style="background-color:#E5E7E9; margin-right: 5px;">  {{ strtolower($skill->name) }}</span>
                                                {{"  "}}
                                            @endforeach
                                        </p>
                                    @else
                                    <p class="card-text" > Skills: <em>no skills</em> </p>
                                    @endif
                                <p class="card-text mb-4" > About myself:<span style="font-weight: bolder;"> {{$resume->description}}  </span></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-subtitle mb-2 text-muted" >Last changes in {{$resume->updated_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
  </body>
  <!-- @include('layouts.footer') -->
@endsection