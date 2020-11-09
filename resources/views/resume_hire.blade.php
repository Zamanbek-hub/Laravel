@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="./css/resume_hire.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>
    @include('layouts.header') 

    <main class="w-100">
        <div class="row container-fluid main_resume_paper">
            <div class="col-2"></div>
            <div class="col-10 colored_page resume_part">
                <div class="resume">
                    <form>
                        <h5 class="title">Your requirements</h5>
                        <div class="profile_form">
                            <h3>1. Tell us what company?</h3>
                            
                            <div>
                                <input type="text" value="" name="company_name" placeholder="Company name">
                            </div>
                            <br/>
                            <div>
                                <input type="text" value="" name="email" placeholder="E-mail">
                                <input type="text" value="" name="phone" placeholder="Phone">
                            </div>
                            <br/>
                            <div>

                                <input type="text" value="" name="url" placeholder="URL to placeholder">
                            </div>
                            <!-- <div>
                                <br/>
                                <input type="file" value="" name="attached_resume" placeholder="Attach resume">
                            </div> -->
                        </div>

                        <div class="specialist_form">
                            <h3>You're looking employee?</h3>
                            
                            <div>
                                <input type="text" value="" name="career" placeholder="Career objective">
                            </div>
                            <br/>

                            <div>
                                <input type="number" value="" name="salary" placeholder="Salary">
                                <select>
                                    <option>KZT</option>
                                    <option>DLR</option>
                                    <option>RUB</option>
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
                            <h3>Tell something about career...</h3>
                            <div>
                                <textarea></textarea>
                            </div>
                        
                        </div>
                        <br/>
                        <button class="btn my-2 my-sm-0">Submit</button>
                        <button class="btn my-2 my-sm-0">Cancel</button>
                    </form>
                </div>
                <br/>
                <br/>
                <br/>
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
                    <span>${addSkillInput.value}</span>
                    <span class = "particular_skill_remove" onclick="removeSkill('particular_skill_${addSkillInput.value}')">
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

</body>
@endsection

