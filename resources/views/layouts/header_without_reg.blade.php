<header>
        <div class="navbar_out">
            <nav class="navbar navbar-expand-lg container">
                <a class="navbar-brand" href="./home.html">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-navicon" style="color:#fff; font-size:28px;"></i></i></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="#">To employers<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">To job seekers</a>
                    </li>
                </ul>

                    <a href="{{ route('resume_create') }}"><button class="btn my-2 my-sm-0" type="submit">Create Resume</button></a>
                    <a href="./contact_us.html"><button class="btn my-2 my-sm-0" type="submit">Contact Us</button></a>


                    @if (Route::has('login'))

                            @auth
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        <button class="btn my-2 my-sm-0">
                                                         {{ __('Logout') }}
                                                        </button>
                                        
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            @else
                                <a href="{{route('login')}}"><button class="btn my-2 my-sm-0" type="submit">Sign In</button></a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"><button class="btn my-2 my-sm-0" type="submit">Sign Up</button></a>
                                @endif
                            @endif

                    @endif
                <!-- </form> -->
                </div>
            </nav>
        </div>

    @if (Route::has('login'))


        @auth

        @else
            <form class="form-inline my-2 my-lg-0 search_form">
                <div class="search_from_in_div">
                    <h3 class="search_form_text">Find your dream Job</h3>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search Job" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
        @endif
    @endif
</header>
