@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Student</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
    <style>
      .bs-callout {
        padding: 10px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
      }
      .bs-callout-warning {
      border-left-color: #f0ad4e;
      }

      .bs-callout h6 {
        margin-top: 0;
        margin-bottom: 5px;
      }

      .bs-callout-warning h6 {
      color: #f0ad4e;
      }
 </style>
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
                          <div class="list-group mb-5">  
                              <a href="#" class="list-group-item list-group-item-action disabled d-flex" >
                                 <span class="material-icons" style="margin-right:5px; ">face</span> {{$student[0]->name}} {{$student[0]->surname}}
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
                                      <p class="card-text" style="font-weight: bolder;"> Specialty:
                                        @if(count(($resumes[$i])->specialties)!=0)
                                          @for($j=0; $j<count($resumes[$i]->specialties); $j++)
                                                {{$resumes[$i]->specialties[$j]->name}} 
                                                @if($j!=count(($resumes[$i]->specialties))-1)
                                                    ,
                                                @endif
                                          @endfor
                                        @endif
                                      </p>
                                      <a href="/home_s/{{$resumes[$i]->id}}" class="btn btn-outline-warning " type="button" style="color: black; border-color: grey; "> More details</a>
                                </div>
                            </div>
                          @endfor
                        @endif
                    </div>
                    <div class="col-md-3">
                      @if(count($vacanciesTop)!=0)
                        @foreach($vacanciesTop as $tops)
                            <div class="tile wide quote">
                                <div class="header">
                                  <div class="left">
                                    <div class="count"><b>{{$tops->employer->company_name}}</b> Company</div>
                                    <div class="title"><a href="#" >Open vacancy</a></div>
                                  </div>
                                </div>
                                <div class="body">
                                  <div class="title">
                                    @if(count($tops->specialties)!=0)
                                        @foreach($tops->specialties as $topsSpecs)
                                                {{$topsSpecs->name}},
                                        @endforeach      
                                    @endif
                                  </div>
                                </div>
                            </div>
                          @endforeach
                      @endif
                    </div>
                      
            </div>
              <hr style="color: #343434;">
              <div class="d-flex justify-content-center">
                <button class="btn btn-outline-warning mb-5" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color: black; border-color: grey; ">
                Recommendations
                </button>
            </div>

            <div class="collapse" id="collapseExample">
              <div class="container">
                <div class="row">
                @if(count($vacs)!=0)
                  @foreach($vacs as $vacancy)
                    <div class="col-4">
                      <div class="bs-callout bs-callout-warning">
                          <h6>
                              @for($i=0; $i<count(($vacancy->specialties)); $i++)
                                {{$vacancy->specialties[$i]->name}}
                                  @if($i!=count(($vacancy->specialties))-1)
                                      ,
                                  @endif
                              @endfor
                          </h6>
                          <p style="font-size:14px;">From {{$vacancy->salary}} KZT</p>
                          <p style="color: grey;; font-size:12px;">Region: {{$vacancy->employer->region->name}} </p>
                          <p><span style="color: #383434; font-size:16px;"> <em> {{$vacancy->employer->company_name}} </em></span></p>
                      </div>
                    </div>
                  @endforeach  
                @endif 
                  
                </div>
              </div>



              
            </div>
            
        </div>
    </div>
  </body>
  @include('layouts.footer')
@endsection