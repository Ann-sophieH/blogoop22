<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Users',     <?php echo count($aantalUsers)  ?>],
            ['Comments',      <?php echo count($aantalComments)  ?>],
            ['Photos',  <?php echo count($aantalPhotos)  ?>],
            ['Categories ', <?php echo count($aantalCategories)  ?>],
            ['Sleep',    0.5]
        ]);

        var options = {
            title: 'Statistics for your site'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<!-- Content Row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div id="piechart" style="width: 500px; height: 500px;" class="mx-auto"></div>

        </div>
    </div>
</div>
<div>
    <?php
    echo $session->visitor_count();
    ?>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
