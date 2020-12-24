@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="/css/resume_hire.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>
    @include('layouts.header_without_reg') 

    <main class="w-100">
        <div class="row container-fluid main_resume_paper">
            <div class="col-2"></div>
            <div class="col-10 colored_page resume_part">
                <div class="resume">
                    <form action="/home_e" method="post">
                    @csrf 
                        <h5 class="title">Your requirements</h5>
                        <div class="profile_form">
                            <h3>1. Tell us what company? </h3>
                            <div>
                                <input type="text" value="{{$emp[0]->company_name}}" name="company_name" placeholder="Company name" disabled>
                            </div>
                            <div>
                                <input type="text" value="{{$emp[0]->name}}" name="name" placeholder="Name">
                                <input type="text" value="{{$emp[0]->surname}}" name="surname" placeholder="Surname">
                            </div>
                            <br/>
                            <div>
                                <input type="email" value="{{$user->email}}" name="email" placeholder="E-mail">
                                <input type="text" value="{{$emp[0]->phone_number}}" name="phone_number" placeholder="Phone">
                            </div>
                            <br/> 
                        </div>

                        <div class="specialist_form">
                            <h3>2.You're looking employee?</h3>
                            <div id="specialties" >
                           
                            </div>
                            
                            <div>
                                <select name="spec"  id="add_spec" style="width:400px;">
                                    @if(count($specs)!=0)
                                        @foreach($specs as $sp)
                                        <option  id="add_spec"value="{{$sp->name}}"> {{$sp->name}} </option>
                                        @endforeach
                                    @endif
                                </select>
                                <button class="btn my-2 my-sm-0" type="button" onclick="addSpec()">Keep</button>
                            </div>
                            
                           
                            <br/>
                            <div>
                                <input type="number" value="" name="salary" placeholder="Salary" min=0>
                                <select style="width: 100px;">
                                    <option >KZT</option>
                                    <!-- <option>DLR</option>
                                    <option>RUB</option> -->
                                </select>
                            </div>
                            <br/>
                        </div>


                        <div class="main_skills_form">
                            <h3>Main Skills...</h3>
                            <div id="skills">
                            </div>
                            
                            <br/>
                            <div>
                                <input type="text" name="skill" id="add_skill" placeholder="skill">
                                <button class="btn my-2 my-sm-0" type="button" onclick="addSkill()">Keep</button>
                            </div>
                            
                        </div>

                        <div class="about_yourself_form">
                            <h3>3.About other requirements and descriptions...</h3>
                            <div>
                                <textarea name="description" style="width: 700px; height: 400px;"></textarea>
                            </div>
                        </div>
                        <br/>
                        <button class="btn my-2 my-sm-0">Submit</button>
                        <button class="btn my-2 my-sm-0">Cancel</button>
                    </form>
                </div>
                <br/><br/> <br/>
            </div>
        </div>
    </main>

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
</body>
@endsection

