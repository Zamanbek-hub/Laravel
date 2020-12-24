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
                      @if(count($vacancies)!=0)
                        <table class="table table-bordered table-hover">
                            <thead style="background-color:#263140; color:whitesmoke;">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Company</th>
                                <th scope="col">Specialties</th>
                                <th scope="col">Created date</th>
                                <th scope="col" width="13%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($vacancies as $vacancy)
                                <tr>
                                  <th scope="row">{{$vacancy->id}}</th>
                                  <td>{{$vacancy->surname }} {{$vacancy->name}}</td>
                                  <td>{{$vacancy->email}}</td>
                                  <td>{{$vacancy->employer->company_name}}</td>
                                  <td> 
                                  @if(count($vacancy->specialties)!=0)
                                        @foreach($vacancy->specialties as $spec)
                                            <p>{{$spec->name}}</p>
                                        @endforeach
                                    @else
                                        no specialty
                                    @endif
                                  
                                  </td>
                                  <td>{{$vacancy->created_at}}</td>
                                  <td>
                                    <a href="/home_a/vacancies/{{$vacancy->id}}" class="btn btn-outline-secondary btn-sm  " type="button" style="color: black; border-color: grey; ">
                                        <span class="material-icons pt-1" style="font-size:18px;">read_more</span>
                                    </a>
                                    <button  type="button" class="btn btn-sm btn-outline-danger" style="color:black; border-color:grey;" data-toggle="modal" data-target="{{'#delete'}}{{$vacancy->id}}">
                                            <span class="material-icons pt-1" style="font-size:18px;">delete</span>
                                        </button>
                                  </td>
                                </tr>
                                <form action="/home_a/vacancies/{{$vacancy->id}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <div class="modal fade" id="{{'delete'}}{{$vacancy->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                      <input type="hidden" name="vacancy_id" class="form-control" value="{{$vacancy->id}}">
                                                      <p class="card-text"> Are you sure?</p>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                                                  <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            </tbody>
                          </table>
                        @else
                           <p>No vacancies in database</p>
                        @endif
                    </div>
                </div>
           </div>
    </div>
  </body>
  <!-- @include('layouts.footer') -->
@endsection