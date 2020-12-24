@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="/css/resume.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection

@section('content')

<body>
    @include('layouts.header') 

    

    <div class="row">
        <div class="col-6">
            <canvas id="line-chart" width="500" height="250">
                
            </canvas>
        </div>
        <div class="col-6">
            <canvas id="line-chart" width="500" height="250">
                
            </canvas>
        </div>
    </div>

    <script type="text/javascript">
        let chart = new Chart(document.getElementById("line-chart"), {
            type: 'line',
            maintainAspectRatio:false,
            data: {
                labels: [0,10,20,30,40,50,60,70,80,90],
                datasets: [{ 
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Resumes",
                    borderColor: "#3e95cd",
                    fill: false
                }, { 
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Vacancies",
                    borderColor: "#8e5ea2",
                    fill: false
                }, 
                ]
            },
            options: {
                title: {
                display: true,
                text: 'World population per region (in millions)'
                }
            }
        });

        chart.canvas.parentNode.style.height = '128px';
        chart.canvas.parentNode.style.width = '128px';
    </script>

    @include('layouts.footer')

    

</body>
@endsection

