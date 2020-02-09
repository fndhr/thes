@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Report User Student</h1>
        </div>
    </div>
    <div class="row py-2 justify-content-center">
        <div class="col-6">
            <canvas id="sessionChart"></canvas>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Report Progress Student</h1>
        </div>
    </div>
    <div class="row py-2 justify-content-center">
        <div class="col-6">
            <canvas id="progressChart"></canvas>
        </div>
    </div>
    <ul>
        <li><a>Thesis Proposal = 1</a></li>
        <li><a>Thesis Interim = 2</a></li>
        <li><a>Thesis Final Draft = 3</a></li>
        <li><a>Thesis Revised Document = 4</a></li>
        <li><a>Thesis Final Document = 5</a></li>
    </ul>
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Report Major Student</h1>
        </div>
    </div>
    <div class="row py-2 justify-content-center">
        <div class="col-6">
            <canvas id="majorChart"></canvas>
        </div>
    </div>
</div>

<script src="/assets/js/chartjs.min.js"></script>
<script>
    var ctxSession = document.getElementById('sessionChart').getContext('2d');
    var sessionChart = new Chart(ctxSession, {
        type: 'bar',
        data: {
            labels: ['Title', 'Proposal', 'Interim', 'Final Draft','Revised Document','Finalized Document'],
            datasets: [{
                label: 'is Approved: ',
                data: [<?php echo $title; ?>,
                       <?php echo $proposal; ?>,
                       <?php echo $interim; ?>,
                       <?php echo $finalDraft; ?>,
                       <?php echo $revisedDoc; ?>,
                       <?php echo $finalDoc; ?>],
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
   
    Data = <?php echo $students; ?>;
    var LabelResult = [];
    for(var i = 0;i<Data.length;i++){
        LabelResult.push(Object.values(Data[i]));
    }

    // console.log(<?php echo $students; ?>);

    asd = <?php echo $progress; ?>;
    // console.log(asd["0"].std_id);
    var stdId = [];
    var progress = [];

    for(var i = 0;i<Data.length;i++){
        if(asd[i] != undefined){
            stdId.push(asd[i].std_id);
            progress.push(asd[i].progress);
        }
    }

    // console.log(stdId);
    // console.log(progress);

    var ctx = document.getElementById('progressChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: stdId,
            datasets: [{
                label: 'Progress: ',
                data: progress,
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

    var ctxMajor = document.getElementById('majorChart').getContext('2d');
    var majorChart = new Chart(ctxMajor, {
        type: 'bar',
        data: {
            labels: ['Information System', 'Information Technology', 'Visual Communication and Design'],
            datasets: [{
                label: 'Total: ',
                data: [<?php echo $is; ?>,
                       <?php echo $it; ?>,
                       <?php echo $vcd; ?>],
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