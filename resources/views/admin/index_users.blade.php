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
        <button type="button" class="btn btn-outline float-right" data-toggle="modal" data-target="#exampleModal" style=" color:black; border-color:black;">
            Add User
        </button>
    </div>
      <div class="body_main " >
          <div class="container mt-5">
              <div class="row " >
                    <div class="col-md-3">
                        @include('layouts.menu_admin') 
                    </div>
                    <div class="col-md-9"> 
                      @if(count($users)!=0)
                        <table class="table table-bordered table-hover">
                            <thead style="background-color:#263140; color:whitesmoke;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" width="18%"></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        <button  type="button" class="btn btn-sm btn-outline-warning" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#edit'}}{{$user->id}}">
                                            <span class="material-icons" style="font-size:18px;">border_color</span>
                                        </button>
                                        <button  type="button" class="btn btn-sm btn-outline-secondary" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#change'}}{{$user->id}}">
                                            <span class="material-icons" style="font-size:18px;">vpn_key</span>
                                        </button>
                                        <button  type="button" class="btn btn-sm btn-outline-danger" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#delete'}}{{$user->id}}">
                                            <span class="material-icons" style="font-size:18px;">person_remove</span>
                                        </button>
                                    </td>
                                </tr>
                                <form action="/home_a/users/update" method="post">
                                  @csrf 
                                    <div class="modal fade" id="{{'edit'}}{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editing</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Created date</label>
                                                            <input type="text"  class="form-control" value="{{$user->created_at}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label >Last update date</label>
                                                            <input type="text" class="form-control" value="{{$user->updated_at}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label >Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="/home_a/users/change" method="post">
                                  @csrf 
                                    <div class="modal fade" id="{{'change'}}{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Change password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
                                                
                                                <div class="form-group">
                                                    <label >New password</label>
                                                    <input type="password" name="password" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="/home_a/users/{{$user->id}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <div class="modal fade" id="{{'delete'}}{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}">
                                                <input type="hidden" name="role" class="form-control" value="{{$user->role}}">

                                                    Delete user with email <u> {{$user->email}} </u>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            </tbody>
                          </table>
                        @else
                           <p>No users in database</p>
                        @endif
                    </div>
                </div>
           </div>
        </div>
        <form action="/home_a/users" method="post">
            @csrf 
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="text" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Role</label>
                                <select name="role" class="form-control">
                                    <option value="employer">employer</option>
                                    <option value="student">student</option>
                                    <option value="admin">admin</option>
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