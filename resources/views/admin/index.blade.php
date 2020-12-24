@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b8d631eee1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

   
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
                     <!-- <div class="jumbotron">
                          <h4 class="">Hello, Admin!</h4>
                          <p class="lead"></p>
                          <hr class="my-4">
                          <p>Employment of students and graduates.</p>
                          <a class="btn btn-primary btn-lg" href="#" role="button">See statistics</a>
                    </div> -->

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Students/Teachers</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Activity</a>
                                <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <canvas id="pie-chart" width="800" height="450">

                                </canvas>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <canvas id="line-chart" width="500" height="250">
                
                                </canvas>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                
                            </div>
                        </div>
                            
                    </div>
                </div>
        </div>
    </div>

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
                        labels: ['21.12.2020', '22.12.2020', '23.12.2020', '21.12.2020'],
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
                        text: 'Activity of Users'
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
                    label: "Count",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [data.employers_len,data.students_len]
                }]
                },
                options: {
                title: {
                    display: true,
                    text: 'Relationship of Students and Employers'
                }
                }
            });
        }

        drawCircleGraph();
    </script>


  </body>
  <!-- @include('layouts.footer') -->
@endsection