@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Details</title>
    <link rel="stylesheet" href="/css/resume.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <input class="star" id="favorite" type="checkbox" title="bookmark page" onchange="saveFavoriteResume()">
                        @if(auth()->user()->role==='employer')
                        <input class="star" id="favorite" type="checkbox" title="bookmark page" onchange="saveFavoriteResume()">
                        @endif
                        
                        <span id="favorite_text"></span>
                        <br/><br/>
                        <h5 class="card-title mt-3 mb-3" align="center" style="font-weight: bold; "> Resume </h5>
                        <p class="card-text" > Fullname:<span style="font-weight: bolder;"> {{$resume->full_name}}  </span></p>
                            @if(count($resume->specialties)!=0)
                            <p class="card-text pr-2" > Specialty :  
                                  @foreach($resume->specialties as $sp)
                                    <span style="font-weight: bolder;">  {{ $sp->name }} , </span> 
                                  @endforeach
                                  </p>
                            @else
                            <p class="card-text" > Specialty: <em>no specialty</em> </p>
                          @endif
                        <p class="card-text" > Salary:<span style="font-weight: bolder;"> {{$resume->salary}} KZT  </span></p>
                        <p class="card-text" > Email:<span style="font-weight: bolder;"> {{$resume->email}}  </span></p>

                        <p class="card-text" > Telephone number:<span style="font-weight: bolder;"> <em>{{$resume->phone_number}} </em> </span></p>
                        <p class="card-text" > Portfolio URL:<span style="font-weight: bolder;"> {{$resume->url_portfolio}}  </span></p>
                        <div>
                              @if(count($resume->skills)!=0)
                              <p class="card-text" > Skills: </p>
                                  <ul class="d-flex">
                                    @foreach($resume->skills as $skill)
                                      <li class="d-flex" style="margin-left:30px; font-weight: bolder; border: 1px solid lightgrey; background-color: lightgrey;">{{ $skill->name }}</li>
                                    @endforeach
                                  </ul>
                              @else
                              <p class="card-text" > Skills: <em>no skills</em> </p>
                            @endif
                          </div>
                        <p class="card-text mb-4" > About myself:<span style="font-weight: bolder;"> {{$resume->description}}  </span></p>
                      
                        <form action="/resume/{{$resume->id}}" method="post" class="mb-2">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger mt-2 " type="button" style="color: black; border-color: grey; "> Delete</buttom>
                        </form>
                        
                        <a href="/resume_pdf_init?id={{$resume->id}}"><button class="btn btn-primary">Download</button></a>
                        <form action="/resume_select" method="post">
                        @csrf
                        @method('POST')
                            <input type="hidden" name="resume_id" value="{{$resume->id}}" id="resume_id">
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="card-subtitle mb-2 text-muted" >Last changes in {{$resume->updated_at}}</p>
                    </div>
                </div>
                <form action="/home_s/update" method="post">
                    @csrf 
                        <h3 class="title mb-3">Editing</h3>
                        <div class="profile_form">
                            <h5> <em>Tell us who you are? </em></h5>
                            <input type="hidden" value="{{$resume->id}}" name="id">
                            <div>
                                <input type="text" value="{{$resume->full_name}}" name="full_name" placeholder="Full name" required>
                            </div>
                            <br/>
                            <div>
                                <input type="text" value="{{$resume->email}}" name="email" placeholder="E-mail" required>
                                <input type="text" value="{{$resume->phone_number}}" name="phone_number" placeholder="Phone" required>
                            </div>
                            <br/>
                            <div>
                                <input type="text" value="{{$resume->url_portfolio}}" name="url_portfolio" placeholder="URL to portfolio" required>
                            </div>
                        </div>
                        <div class="specialist_form mt-5">
                            <h5> <em>You're skilled as a...</em></h5>
                            <div id="specialties" >
                            <div class="mb-4" id="">
                                  @if(count($resume->specialties)!=0)
                                    @foreach($resume->specialties as $assignedSpecss)
                                  
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
                                <input type="number" value="{{$resume->salary}}" name="salary" placeholder="Salary" required>
                                <select style="width:150px;">
                                    <option>KZT</option>
                                </select>
                            </div>
                            <br/>

                        </div>
                        <div class="main_skills_form">
                            <h5>Main Skills...</h5>
                            <div id="skills">
                                <div class="mb-3" id="">
                                  @if(count($resume->skills)!=0)
                                    @foreach($resume->skills as $assignedSkills)
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
                            <h5> <em>Tell something about yourself...</em></h5>
                            <div>
                                <textarea type="text"name="description" value="{{$resume->description}}"> {{$resume->description}}</textarea>
                            </div>
                        
                        </div>
                        <br/>
                        <button class="btn btn-outline-warning">Save</button>
                    </form>
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
            
  <!-- </div>
    <hr style="color: #343434;">
    <div class="d-flex justify-content-center">
      <a href="#" class="btn btn-outline-warning mb-5" type="button" style="color: black; border-color: grey; ">Recommendations</a>
  </div> -->
  
</div>
</div>



    @include('layouts.footer')
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
        const url = '/save_favorite_resume';
        
        async function saveFavoriteResume (){
            try {
                
                const data = { 
                  _token: document.getElementsByName("_token")[0].value,
                  resume_id: document.getElementById('resume_id').value
                  };
                
                console.log(data._token);
                console.log(data.resume_id);
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

