@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./css/home_without_reg.css">
     <link rel="stylesheet" href="./css/contact_us.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></src=>
    <src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></src=>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<body>
    @include('layouts.header') 

    <div class="wrapper3">
            <div class="contact_me_page">
                <div class="container">
                    <div class="contact_me_body">
                        <p class="contact_me_page_gr"> <strong>You can find us at this address</strong></p>
                         <div class="contact_me_map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2906.776453341534!2d76.90755611494096!3d43.23514637913781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3883692f027581ad%3A0x2426740f56437e63!2z0JzQtdC20LTRg9C90LDRgNC-0LTQvdGL0Lkg0YPQvdC40LLQtdGA0YHQuNGC0LXRgiDQuNC90YTQvtGA0LzQsNGG0LjQvtC90L3Ri9GFINGC0LXRhdC90L7Qu9C-0LPQuNC5!5e0!3m2!1sru!2skz!4v1603145475785!5m2!1sru!2skz"  frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <p class="contact_me_page_gr"><strong> We'll be glad to answer your questions!</strong></p>
                        <div class="contact_me_inputs">
                          <input type="text" name="name" id="name" placeholder="Name">
                          <input type="email" name="email" value="" required id="email" placeholder="Email">
                          <textarea type="text" rows="9" name="message" id="message" placeholder="Your message"></textarea>
                          <button  class="btn btn-outline-warning mb-5" type="submit" style="color:#fff; border-color: #fff;">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    @include('layouts.footer')
</body>
@endsection

