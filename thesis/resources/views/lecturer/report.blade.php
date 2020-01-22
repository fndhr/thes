@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Import User Student</h1>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-6 text-center">
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
</script>
@endsection