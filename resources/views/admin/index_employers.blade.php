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

      <div class=container>
          <form class="form-inline my-2 my-lg-0 search_form container">
              <div class="search_from_in_div">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search Job" aria-label="Search">
                  <button class="btn my-2 my-sm-0" type="submit">Search</button>
              </div>
          </form>
          @if(count($foundUsers)!=0)
          <button type="button" class="btn btn-outline float-right" data-toggle="modal" data-target="#exampleModal" style=" color:black; border-color:black;">
              Add Employer
          </button>
          @endif
      </div>

      <div class="body_main " >
          <div class="container mt-5">
              <div class="row " >
                    <div class="col-md-3">
                       @include('layouts.menu_admin') 
                    </div>
                    <div class="col-md-9"> 
                      @if(count($employers)!=0)
                        <table class="table table-bordered table-hover">
                            <thead style="background-color:#263140; color:whitesmoke;">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Name</th>
                                <th scope="col">Company</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Region</th>
                                <th scope="col" width="14%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($employers as $employer)
                                <tr>
                                  <th scope="row">{{$employer->id}}</th>
                                  <td>{{$employer->surname}}</td>
                                  <td>{{$employer->name}}</td>
                                  <td>{{$employer->company_name}}</td>
                                  <td>{{$employer->phone_number}}</td>
                                  <td>
                                        @if(count($users)!=0)
                                            @foreach($users as $user)
                                                @if($user->id==$employer->user_id)
                                                    <p> {{$user->email}}</p>
                                                @endif
                                            @endforeach
                                        @endif
                                  </td>
                                  <td>
                                        @if(count($regions)!=0)
                                            @foreach($regions as $reg)
                                            @if($reg->id==$employer->region_id)
                                                    <p> {{$reg->name}}</p>
                                                @endif
                                            @endforeach
                                        @endif
                                  </td>
                                  <td>
                                    <button  type="button" class="btn btn-sm btn-outline-warning" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#edit'}}{{$employer->id}}">
                                        <span class="material-icons pt-1" style="font-size:18px;">border_color</span>
                                    </button>
                                    <button  type="button" class="btn btn-sm btn-outline-danger" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#delete'}}{{$employer->id}}">
                                        <span class="material-icons pt-1" style="font-size:18px;">person_remove</span>
                                    </button>
                                  </td>
                                </tr>
                                <form action="/home_a/employers/update" method="post">
                                    @csrf 
                                    <div class="modal fade" id="{{'edit'}}{{$employer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Editing</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="employer_id" class="form-control" value="{{$employer->id}}">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Created date</label>
                                                            <input type="text"  class="form-control" value="{{$employer->created_at}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Last update date</label>
                                                            <input type="text" class="form-control" value="{{$employer->updated_at}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Name </label>
                                                            <input type="text"  name="name" class="form-control" value="{{$employer->name}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Surname</label>
                                                            <input type="text" name="surname" class="form-control" value="{{$employer->surname}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <div class="form-group">
                                                        <label >Phone number</label>
                                                        <input type="text" name="phone_number" class="form-control" value="{{$employer->phone_number}}"  required>
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Company name</label>
                                                            <input type="text" name="company_name" class="form-control" value="{{$employer->company_name}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label >Region</label>
                                                    <select name="region" class="form-control">
                                                        @if(count($regions)!=0)
                                                            @foreach($regions as $reg)
                                                                @if($reg->id==$employer->region_id)
                                                                    <option value="{{$reg->id}}" selected> {{$reg->name}}</option>
                                                                @else
                                                                    <option value="{{$reg->id}}" > {{$reg->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                </form>
                                <form action="/home_a/employers/{{$employer->id}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <div class="modal fade" id="{{'delete'}}{{$employer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Deleting</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                    <input type="hidden" name="employer_id" class="form-control" value="{{$employer->id}}">
                                                    Are you sure?
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
                           <p>No employers in database</p>
                        @endif
                    </div>
                </div>
           </div>
      </div>
      <form action="/home_a/employers" method="post">
            @csrf 
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Employer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Surname</label>
                                <input type="text" name="surname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Phone number</label>
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label >Company name</label>
                                <input type="text" name="company_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Region</label>
                                <select name="region" class="form-control">
                                   @if(count($regions)!=0)
                                      @foreach($regions as $reg)
                                          <option value="{{$reg->id}}">{{$reg->name}}</option>
                                      @endforeach
                                   @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label >User</label>
                                <select name="user" class="form-control">
                                   @if(count($foundUsers)!=0)
                                      @foreach($foundUsers as $us)
                                          <option value="{{$us->id}}">{{$us->email}}</option>
                                      @endforeach
                                   @endif
                                </select>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
  </body>
  <!-- @include('layouts.footer') -->
@endsection