@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacancy Details</title>
    <link rel="stylesheet" href="/css/resume_hire.css">
    <link rel="stylesheet" href="/css/home.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>
    @include('layouts.header') 
   
<div class="body_main " >
<div class="container mt-5">
    <div class="row " >
          <div class="col-md-9">
                <div class="card mb-4" >
                    <div class="card-body">
                        <h5 class="card-title mt-3 mb-3" align="center" style="font-weight: bold; "> Vacancy  </h5>
                        <p class="card-text" > Name:<span style="font-weight: bolder;"> {{$vacancy->name}}  </span></p>
                        <p class="card-text" > Surname:<span style="font-weight: bolder;"> {{$vacancy->surname}}  </span></p>
                        <p class="card-text" > Email:<span style="font-weight: bolder;"> {{$vacancy->email}}  </span></p>
                        <p class="card-text" > Telephone number:<span style="font-weight: bolder;"> <em>{{$vacancy->phone_number}} </em> </span></p>
                        <p class="card-text" style="font-weight: bolder;">
                            @foreach($specialties as $sp)
                            @if($sp->id==$vacancy->spec_id)
                                 Specialty: {{$sp->name}}
                            @endif
                            @endforeach
                        </p>
                        <p class="card-text" > Salary:<span style="font-weight: bolder;"> {{$vacancy->salary}} KZT  </span></p>
                        <p class="card-text mb-4" > Other requirements and descriptions:
                            <textarea name="description" style="width: 700px; height: 250px; font-weight: bolder; background: white; border-color: white;" disabled>{{$vacancy->description}}
                            </textarea>
                        </p>
                        <p class="card-text mb-4" > Views:<span style="font-weight: bolder;"> {{$vacancy->view_count}} views  </span></p>
                        <button  class="btn btn-outline-warning mt-2 " type="button" data-toggle="modal" data-target="#exampleModal" style="color: black; border-color: grey; "> Delete</button> 
                    </div>
                    <div class="card-footer">
                        <p class="card-subtitle mb-2 text-muted" >Last changes in {{$vacancy->updated_at}}</p>
                    </div>
                    <form action="/vacancy/{{$vacancy->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deleting</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            Are you seriously looking to remove this vacancy from the list?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                <button type="submit" class="btn btn-danger">YES</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
                <div class='res mt-5'>
                    <form action="/vacancy/update" method="post">
                        @csrf 
                        <h5 class="title">Edit vacancy requirements</h5>
                        <input type="hidden" value="{{$vacancy->id}}" name="id">

                        <div class="profile_form">
                            <h3>1. About company </h3>
                            <div>
                                <input type="text" value="{{$emp->company_name}}" name="company_name" placeholder="Company name" disabled>
                            </div>
                            <div>
                                <input type="text" value="{{$vacancy->name}}" name="name" placeholder="Name">
                                <input type="text" value="{{$vacancy->surname}}" name="surname" placeholder="Surname">
                            </div>
                            <br/>
                            <div>
                                <input type="email" value="{{$vacancy->email}}" name="email" placeholder="E-mail">
                                <input type="text" value="{{$vacancy->phone_number}}" name="phone_number" placeholder="Phone">
                            </div>
                            <br/> 
                        </div>

                        <div class="specialist_form">
                            <h3>2.You're looking employee?</h3>
                            
                            <div>
                                <select name="spec_id" style="width:400px;">
                                    @foreach($specialties as $sp)
                                        @if($sp->id==$vacancy->spec_id)
                                        <option value="{{$sp->id}}" selected> {{$sp->name}} </option>
                                        @else
                                        <option value="{{$sp->id}}"> {{$sp->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br/>
                            <div>
                                <input type="number" value="{{$vacancy->salary}}" name="salary" placeholder="Salary" min=0>
                                <select style="width: 100px;">
                                    <option >KZT</option>
                                    <!-- <option>DLR</option>
                                    <option>RUB</option> -->
                                </select>
                            </div>
                            <br/>
                        </div>

<!-- 
                        <div class="main_skills_form">
                            <h3>Main Skills...</h3>
                            <div id="skills">
                            </div>
                            
                            <br/>
                            <div>
                                <input type="text" name="skill" id="add_skill" placeholder="skill">
                                <button class="btn my-2 my-sm-0" type="button" onclick="addSkill()">Keep</button>
                            </div>
                            
                        </div> -->

                        <div class="about_yourself_form">
                            <h3>3.About other requirements and descriptions...</h3>
                            <div>
                                <textarea name="description" value="{{$vacancy->description}}" style="width: 700px; height: 400px;" >{{$vacancy->description}}</textarea>
                            </div>
                        </div>
                        <br/>
                        <button class="btn btn-outline-warning my-2 my-sm-0" style="color: black; border-color: grey; ">Save</button>
                    </form>
                </div>
            
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



    @include('layouts.footer')

    

</body>
@endsection

