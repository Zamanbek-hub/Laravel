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
  @include('layouts.header') 

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
                          <div class="list-group mb-5">  
                              <a href="#" class="list-group-item list-group-item-action disabled d-flex" >
                                 <span class="material-icons" style="margin-right:5px; ">face</span> {{$student->name}} {{$student->surname}}
                              </a>
                              <a href="#" class="list-group-item list-group-item-action d-flex" >
                                      <span class="material-icons" style="margin-right:5px;">event_note</span> My events
                              </a>
                              <a href="#" class="list-group-item list-group-item-action d-flex"> 
                                    <span class="material-icons" style="margin-right:5px;">star_outline</span>Selected vacancies
                              </a>
                              <a href="#" class="list-group-item list-group-item-action d-flex">
                                    <span class="material-icons" style="margin-right:5px;">contact_mail</span>My responses
                              </a>
                              <a href="#" class="list-group-item list-group-item-action d-flex">  
                                    <span class="material-icons" style="margin-right:5px;">remove_red_eye</span>Resume views
                              </a>
                              <a href="#" class="list-group-item list-group-item-action d-flex">
                                    <span class="material-icons" style="margin-right:5px;">settings</span>Settings
                              </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if(count($resumes)==0)
                            <p> You don't have a resume</p>
                        @elseif(count($resumes)!=0)
                          @for($i=0; $i<count($resumes); $i++)
                              <div class="card mb-4" >
                                <div class="card-body">
                                      <h5 class="card-title" style="font-weight: bold;"> Resume № {{$i+1}} </h5>
                                      <p class="card-subtitle mb-2 text-muted" >Last changes in {{$resumes[$i]->updated_at}}</p>
                                      <p class="card-text" style="font-weight: bolder;">
                                        @foreach($specialties as $sp)
                                          @if($sp->id==$resumes[$i]->spec_id)
                                              {{$sp->name}}
                                          @endif
                                        @endforeach
                                      </p>
                                      <a href="/resume/{{$resumes[$i]->id}}" class="btn btn-outline-warning " type="button" style="color: black; border-color: grey; "> More details</a>
                                </div>
                            </div>
                          @endfor
                        @endif
                    </div>
                    <div class="col-md-3">
                        <div class="tile wide quote">
                            <div class="header">
                              <div class="left">
                                <div class="count">Almaty AI Laboratory</div>
                                <div class="title"><a href="#" >Open vacancy</a></div>
                              </div>
                              
                            </div>
                            <div class="body">
                              <div class="title">Python Developer</div>
                            </div>
                        </div>

                          <div class="tile wide quote">
                            <div class="header">
                              <div class="left">
                                <div class="count">Kaspi Bank</div>
                                <div class="title"><a href="#" >Open vacancy</a></div>
                              </div>
                              
                            </div>
                            <div class="body">
                              <div class="title">Middle C# Developer</div>
                            </div>
                        </div>

                        <div class="tile wide quote">
                            <div class="header">
                              <div class="left">
                                <div class="count">Voix Almaty</div>
                                <div class="title"><a href="#" >Open vacancy</a></div>
                              </div>
                              
                            </div>
                            <div class="body">
                              <div class="title"> Junior System Analyst</div>
                            </div>
                        </div>
                        <div class="tile wide quote">
                            <div class="header">
                              <div class="left">
                                <div class="count">Kaspi Bank</div>
                                <div class="title"><a href="#" >Open vacancy</a></div>
                              </div>
                              
                            </div>
                            <div class="body">
                              <div class="title">Middle Java Developer</div>
                            </div>
                        </div>

                        <div class="tile wide quote">
                            <div class="header">
                              <div class="left">
                                <div class="count">Voix Almaty</div>
                                <div class="title"><a href="#" >Open vacancy</a></div>
                              </div>
                              
                            </div>
                            <div class="body">
                              <div class="title"> Junior System Analyst</div>
                            </div>
                        </div>


                    </div>
                      
            </div>
              <hr style="color: #343434;">
              <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-outline-warning mb-5" type="button" style="color: black; border-color: grey; ">Recommendations</a>
            </div>
            
        </div>
    </div>
  </body>
  @include('layouts.footer')
@endsection