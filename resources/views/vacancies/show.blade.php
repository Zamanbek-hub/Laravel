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
    @include('layouts.header_without_reg') 
   
<div class="body_main " >
<div class="container mt-5">
    <div class="row " >
          <div class="col-md-9">
                <div class="card mb-4" >
                    <div class="card-body">
                        @if(auth()->user()->role==='student')
                          <input class="star" id="favorite" type="checkbox" title="bookmark page" onchange="saveFavoriteVacancy()">
                        <span id="favorite_text"></span>
                        @endif
                        <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}" id="vacancy_id">
                        <h5 class="card-title mt-3 mb-3" align="center" style="font-weight: bold; "> Vacancy  </h5>
                        @if(count($vacancy->specialties)!=0)
                            <p class="card-text pr-2" > Specialty :  
                                  @foreach($vacancy->specialties as $sp)
                                    <span style="font-weight: bolder;">  {{ $sp->name }} , </span> 
                                  @endforeach
                                  </p>
                            @else
                            <p class="card-text mt-3" > Specialty: <em>no specialty</em> </p>
                          @endif
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
                        <div class="">
                              @if(count($vacancy->skills)!=0)
                              <p class="card-text" > Skills: </p>
                              <div class="container">
                                <div class="row">
                                @foreach($vacancy->skills as $skill)
                                <div class="col-sm m-auto" style="">
                                   <p style="background-color:#E0E0E0;">{{ strtolower($skill->name) }}</p>
                                </div>
                                    @endforeach
                                </div>
                              </div>
                              @else
                              <p class="card-text mb-2" > Skills: <em>no skills</em> </p>
                            @endif
                          </div>
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
                    <form action="/home_e/{{$vacancy->id}}" method="post">
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
                    <form action="/home_e/update" method="post">
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

                            <div id="specialties" >
                            <div class="mb-4" id="">
                                  @if(count($vacancy->specialties)!=0)
                                    @foreach($vacancy->specialties as $assignedSpecss)
                                  
                                      <input type="text" value="{{$assignedSpecss->name}}" name="sss"  style="width:200px;" disabled>
                                      <input class="mr-2" type="checkbox" value="{{$assignedSpecss->name}}" name="assignedSpecs[]" checked>
                                  
                                    @endforeach
                                  @endif
                                
                              </div>
                             </div>
                            <div>
                                <select name="spec"  id="add_spec" style="width:400px;">
                                    @if(count($specialties)!=0)
                                      @foreach($specialties as $sp)
                                          <option  id="add_spec" value="{{$sp->name}}" > {{$sp->name}} </option>
                                      @endforeach
                                    @endif
                                </select>
                                <button class="btn my-2 my-sm-0" type="button" onclick="addSpec()">Keep</button>
                            </div>
                            <br/>
                            <div>
                                <input type="number" value="{{$vacancy->salary}}" name="salary" placeholder="Salary" min=0>
                                <select style="width: 100px;">
                                    <option >KZT</option>
                                </select>
                            </div>
                            <br/>
                        </div>
                        <div class="main_skills_form">
                            <h3>Main Skills...</h3>
                            <div id="skills">
                                <div class="mb-3" id="">
                                  @if(count($vacancy->skills)!=0)
                                    @foreach($vacancy->skills as $assignedSkills)
                                      <input type="text" value="{{$assignedSkills->name}}" name="sss"  style="width:100px;" disabled>
                                      <input class="mr-2" type="checkbox" value="{{$assignedSkills->name}}" name="assignedSkills[]" checked>
                                    @endforeach
                                  @endif
                                
                              </div>
                            </div>
                            <br/>
                            <div>
                                <input type="text" name="skill" id="add_skill" placeholder="skill">
                                <button class="btn my-2 my-sm-0" type="button" onclick="addSkill()">Keep</button>
                            </div>
                        </div>
                        <div class="about_yourself_form mt-2">
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
                @if(count($resumesTop)!=0)
                  @foreach($resumesTop as $tops)
                    <div class="tile wide quote">
                        <div class="header">
                            <div class="left">
                            <div class="count">{{$tops->full_name}}</div>
                            <div class="title"><a href="/home_s/{{$tops->id}}" >Open R</a></div>
                        </div>
                        </div>
                        <div class="body">
                            <div class="title">
                                @if(count($tops->skills)!=0)
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
    </div>
     <hr style="color: #343434;">
  </div>
</div>
    @include('layouts.footer')
</body>
<script type="text/javascript">
        const addSkillInput = document.getElementById("add_skill");
        const addSkill = () => {

            if(addSkillInput.value != ''){
                document.getElementById("skills").innerHTML += 
                `<div class="particular_skill" id="particular_skill_${addSkillInput.value}">
                    <input type="text" value="${addSkillInput.value}" name="ggg"  style="width:100px;" disabled>
                    <input type="checkbox" value="${addSkillInput.value}" name="skills[]" checked>
                    <span class="particular_skill_remove" onclick="removeSkill('particular_skill_${addSkillInput.value}')">
                        <i class="far fa-trash-alt"></i>
                        </span>
                </div>`
            }

            addSkillInput.value = "";
        }

        const removeSkill = (id) => {
            // alert(id);
            document.getElementById(id).style.display = "none"; 
        }
    </script>
      <script type="text/javascript">
        const addSpecInput = document.getElementById("add_spec");
        const addSpec = () => {

            if(addSpecInput.value != ''){
                document.getElementById("specialties").innerHTML += 
                `<div class="particular_spec" id="particular_spec_${addSpecInput.value}">
                    <input type="text" value="${addSpecInput.value}" name="ggg" disabled>
                    <input type="checkbox" value="${addSpecInput.value}" name="specialties[]" checked>
                    <span class="particular_spec_remove" onclick="removeSpec('particular_spec_${addSpecInput.value}')">
                        <i class="far fa-trash-alt"></i>
                        </span>
                </div>`
                
            }
        }

        const removeSpec = (id) => {
            // alert(id);
            document.getElementById(id).style.display = "none"; 
        }
    </script>
    
    <script type="text/javascript">
        const url = '/save_favorite_vacancy';
        
        async function saveFavoriteVacancy (){
            try {
                
                const data = { 
                  _token: document.getElementsByName("_token")[0].value,
                  vacancy_id: document.getElementById('vacancy_id').value
                  };
                
                console.log(data._token);
                console.log(data.vacancy_id);
                const response = await fetch(url, {
                    method: 'POST', // или 'PUT'
                    body: JSON.stringify(data), // данные могут быть 'строкой' или {объектом}!
                    headers: {
                    'Content-Type': 'application/json'
                    }
                });

                
                const json = await response.json();
                console.log('Успех:', JSON.stringify(json));
                document.getElementById('favorite_text').innerHTML = JSON.stringify(json['success']);
                } catch (error) {
                console.error('Ошибка:', error);
            }
        }
    </script>
</body>
@endsection

