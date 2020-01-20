@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Thesis and Defense Management</h1>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-3">
            <a href="/lecturer/studentSearch">
                <div class="text-center">
                    <img src="/assets/image/admin_studentsearch.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Student Search</h4>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="/lecturer/defenseScheduleSearch">
                <div class="text-center mx-3">
                    <img src="/assets/image/admin_searchschedule.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Upcoming Defense Schedule Search</h4>
                </div>
            </a>
        </div>
        <div class="col-6">
            <canvas id="sessionChart"></canvas>
        </div>
    </div>
</div>

<script src="/assets/js/chartjs.min.js"></script>
<script>
    var ctx = document.getElementById('sessionChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Client 1', 'Client 2', 'Client 3'],
            datasets: [{
                label: 'isApproved',
                data: [12, 19, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.2)'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection