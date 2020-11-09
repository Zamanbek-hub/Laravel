@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home_without_reg.css">
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
    <div class="body_main_p1 " >
        <div class="container">
            <div class="title">
                <p class="text-center" > <strong>we are IITU website</strong></p> 
            </div>
            
            <div class="content">
                <p class="text-center">
                    Website is  for students. Third and fourth year students can demonstrate their CVs to representatives of the best Kazakhstani and international companies, pass tests from potential employers and preliminary interviews for further employment. It is an online platform where students can post their resumes and employers can post their vacancies.
                </p>
            </div>
            <div class="p2_end mt-5"><a href="#" ><p class="text-center"> ABOUT US --></p></a> </div>
        </div>
    </div>
    <div class="body_main_p2 " >
        <div class="container">
            <div class="p2_title mb-5">
            <p > <strong>Our sponsors <span style="color: #FFCC4F;">&</span> clients</strong></p> 

            </div>

        <div class="p2_content">
            <div class=" row justify-content-md-center">
                <div class="column">
                        <img class="img-fluid" src="/img/logo_halyk.png"  alt=""  >   

                </div>
                <div class="column">
                        <img class="img-fluid" src="/img/logo_bi_group.png"  alt="" >   

                </div>
                    <div class="column">
                        <img class="img-fluid" src="/img/logo_kaspi.png"  alt="" >   

                </div>
                <div class="column">
                        <img class="img-fluid" src="/img/logo_halyk.png"  alt="" >   

                </div>
                    <div class="column">
                        <img class="img-fluid" src="/img/logo_kaspi.png"  alt="">   

                </div>
                <div class="column">
                        <img class="img-fluid" src="/img/logo_bi_group.png"  alt="">   

                </div>
            </div>
            <div class="p2_end mt-5"><a href="#" > VIEW ALL SPONSORS --></a> </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
 @endsection
