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
            <canvas id="pie-chart" width="800" height="450">

            </canvas>
        </div>
    </div>

    <button type="button" onclick="VacancyStatistics()">Push</button>

    <script type="text/javascript">
        const getResponse = (url) => {
                    return fetch(url).then((resp) => {
                        return resp.json();
                    });
                };
    </script>

    <script type="text/javascript">
      const VacancyStatistics = () => {
            return new Promise((resolve, reject) => {
               
                getResponse('/admin/stat/vacancy').then((data) =>{
                    let vacancies =  data['count_by_days_vacancies'];
                    let resumes =  data['count_by_days_resumes'];
                    let vacancy_counts = []
                    let days_set= new Set();
                    let resume_counts = []
                    for(let i in vacancies){
                        vacancy_counts.push(vacancies[i]['day_count'])
                        days_set.add(vacancies[i]['created_at'])
                        
                    }
                    

                    let days = []
                    for (let item of days_set.values()) days.push(item);



                    for(let i in resumes){
                        resume_counts.push(resumes[i]['day_count'])
                    }

                    // console.log("counts =", counts);
                    // console.log("created_at =", days);
                    resolve( {vacancy_counts:vacancy_counts, resume_counts:resume_counts, days:days});
                })
            }).then(function(value){
                console.log("value =", value)
                return value
            })
        }

        

        async function drawLineGraph() {
                // let result =
                console.log("first");
                let data = await VacancyStatistics() 
                
                console.log("data =", data)
                let chart = new Chart(document.getElementById("line-chart"), {
                    type: 'line',
                    maintainAspectRatio:false,
                    data: {
                        labels: data.days,
                        datasets: [{ 
                            data: [3,2,1,3],
                            label: "Resumes",
                            borderColor: "#3e95cd",
                            fill: false
                        }, { 
                            data: [1, 2, 2, 4],
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
            })
        } 

        drawLineGraph()

       

    </script>

    <script type="text/javascript">

            const CircleGraphDates = () => {
                return new Promise((resolve, reject) => {
                    getResponse('/admin/stat/count_date').then((data) =>{
                        resolve( {employers_len:data['employers_len'], students_len:data['students_len']});
                    })
                }).then(function(value){
                    console.log("value =", value)
                    return value
                })
            }
        
        async function drawCircleGraph() {
            let data = await CircleGraphDates();
            console.log("employers_len =", data.employers_len)
            console.log("students_len =", data.students_len)
            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                labels: ["Employers", "Students"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [data.employers_len,data.students_len]
                }]
                },
                options: {
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
                }
            });
        }

        drawCircleGraph();
    </script>

    @include('layouts.footer')

    

</body>
@endsection

