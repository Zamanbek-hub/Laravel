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
            Add Region
        </button>
    </div>
      <div class="body_main " >
          <div class="container mt-5">
              <div class="row " >
                    <div class="col-md-3">
                        @include('layouts.menu_admin') 
                    </div>
                    <div class="col-md-9"> 
                      @if(count($regions)!=0)
                        <table class="table table-bordered table-hover">
                            <thead style="background-color:#263140; color:whitesmoke;">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="14%">Details</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($regions as $reg)
                                <tr>
                                  <th scope="row">{{$reg->id}}</th>
                                  <td>{{$reg->name}}</td>
                                  <td>
                                    <button  type="button" class="btn btn-sm btn-outline-warning" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#edit'}}{{$reg->id}}">
                                        <span class="material-icons pt-1" style="font-size:18px;">border_color</span>
                                    </button>
                                      <button  type="button" class="btn btn-sm btn-outline-danger" style="color:black; border-color:black;" data-toggle="modal" data-target="{{'#delete'}}{{$reg->id}}">
                                        <span class="material-icons pt-1" style="font-size:18px;">delete</span>
                                      </button>
                                  </td>
                                </tr>
                                <form action="/home_a/regions/update" method="post">
                                  @csrf 
                                  <div class="modal fade" id="{{'edit'}}{{$reg->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Editing</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="region_id" class="form-control" value="{{$reg->id}}">

                                                <div class="form-group">
                                                    <label >Region name</label>
                                                    <input type="name" name="name" class="form-control" value="{{$reg->name}}" required>
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
                                <form action="/home_a/regions/{{$reg->id}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <div class="modal fade" id="{{'delete'}}{{$reg->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Are you sure?</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                      <input type="hidden" name="region_id" class="form-control" value="{{$reg->id}}">
                                                      Delete region <u> {{$reg->name}} </u>  
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
                           <p>No regions in database</p>
                        @endif
                    
                    </div>
                </div>
          </div>
      </div>
      <form action="/home_a/regions" method="post">
        @csrf 
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Region</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                      <label>Name:  </label>
                      <input class="form-control" type="text" name="region" placeholder="" >
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