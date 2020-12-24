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
    @include('layouts.header') 
   
<div class="body_main " >
<div class="container mt-5">
    <div class="row " >
            
          <div class="col-md-9">

                <div class="card mb-4" >
                    <div class="card-body"> 
                        @if(auth()->user()->role==='employer')
                        <input class="star" id="favorite" type="checkbox" title="bookmark page" onchange="saveFavoriteResume()">
                        @endif
                        
                        <span id="favorite_text"></span>
                        <br/><br/>
                        <h5 class="card-title mt-3 mb-3" style="text-align : center" style="font-weight: bold; "> Resume </h5>
                        <p class="card-text" > Fullname:<span style="font-weight: bolder;"> {{$resume->full_name}} {{$resume->student->fullname}} </span></p>

                        <p class="card-text" style="font-weight: bolder;">
                            @foreach($specialties as $sp)
                            @if($sp->id==$resume->spec_id)
                                 Specialty: {{$sp->name}}
                            @endif
                            @endforeach
                        </p>
                        <p class="card-text" > Salary:<span style="font-weight: bolder;"> {{$resume->salary}} KZT  </span></p>
                        <p class="card-text" > Email:<span style="font-weight: bolder;"> {{$resume->email}}  </span></p>

                        <p class="card-text" > Telephone number:<span style="font-weight: bolder;"> <em>7-708-050-52-67 </em> </span></p>
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
                <!-- <form action="/resume/update" method="post">
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
                            
                            <div>
                                <select name="spec_id" style="width:400px;">
                                @foreach($specialties as $sp)
                                    @if($sp->id==$resume->spec_id)
                                       <option value="{{$sp->id}}" selected> {{$sp->name}}</option>
                                    @else
                                    <option value="{{$sp->id}}" > {{$sp->name}}</option>
                                    @endif
                            @endforeach
                                </select>
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
                        <div class="about_yourself_form mt-2">
                            <h5> <em>Tell something about yourself...</em></h5>
                            <div>
                                <textarea type="text"name="description" value="{{$resume->description}}"> {{$resume->description}}</textarea>
                            </div>
                        
                        </div>
                        <br/>
                        <button class="btn btn-outline-warning">Save</button>
                    </form> -->
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
            
  <!-- </div>
    <hr style="color: #343434;">
    <div class="d-flex justify-content-center">
      <a href="#" class="btn btn-outline-warning mb-5" type="button" style="color: black; border-color: grey; ">Recommendations</a>
  </div> -->
  
</div>
</div>


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



    @include('layouts.footer')

    

</body>
@endsection

