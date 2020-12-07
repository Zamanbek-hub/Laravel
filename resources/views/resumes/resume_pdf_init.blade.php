@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Details</title>
    <link rel="stylesheet" href="/css/resume.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>

   
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
							
							<a href="/resume_pdf?id={{$resume->id}}"><button class="btn btn-primary">Download</button></a>
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
			</div>
		</div>
	</div>
</div>

</body>
@endsection

