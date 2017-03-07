<script type="text/javascript">
    $(function () {
    $("#example1").dataTable();
            $('#example2').dataTable({
    "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
    });
    });</script>


<script type="text/javascript">

            // Get context with jQuery - using jQuery's .get() method.
            var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas);
            var salesChartData = {
            labels:
                    [
<?php
for ($i = 1; $i <= 12; $i++) {
    $month_name = date('F-y', mktime(0, 0, 0, $i, 1, $select_year));
    ?>          "<?php echo $month_name; ?>",
    <?php
}
?>
                    ],
                    datasets:
                    [
<?php
$rCodeColor = 0;
$gCodeColor = 0;
$bCodeColor = 0;

$sqlHotelList = mysqli_query($con, "SELECT `hotelName` FROM `hotellist` ORDER BY `hotelID` ASC ");
while ($ListHotel = mysqli_fetch_array($sqlHotelList)) {
    $Hotelname = $ListHotel['hotelName'];
    if ($Hotelname == 'The Journey Patong') {
        $rCodeColor = 0;
        $gCodeColor = 255;
        $bCodeColor = 255;
    } elseif ($Hotelname == 'Patong Max Value') {
        $rCodeColor = 0;
        $gCodeColor = 255;
        $bCodeColor = 0;
    } elseif ($Hotelname == 'Lifestyle Residence') {
        $rCodeColor = 255;
        $gCodeColor = 0;
        $bCodeColor = 0;
    } elseif ($Hotelname == 'Blue Sky Patong') {
        $rCodeColor = 0;
        $gCodeColor = 0;
        $bCodeColor = 255;
    } elseif ($Hotelname == 'Lamai Guesthouse') {
        $rCodeColor = 255;
        $gCodeColor = 128;
        $bCodeColor = 0;
    } elseif ($Hotelname == 'SM - Resort') {
        $rCodeColor = 153;
        $gCodeColor = 76;
        $bCodeColor = 0;
    } elseif ($Hotelname == 'Orchid Resortel') {
        $rCodeColor = 153;
        $gCodeColor = 51;
        $bCodeColor = 255;
    } elseif ($Hotelname == 'Jao Sua Residence') {
        $rCodeColor = 255;
        $gCodeColor = 255;
        $bCodeColor = 153;
    } else {
        $rCodeColor = 0;
        $gCodeColor = 0;
        $bCodeColor = 0;
    }
    ?>
                        {
                        label: "<?php echo $ListHotel['hotelName']; ?>",
                                fillColor: "rgb(<?php echo ($rCodeColor + 200) ?>, <?php echo ($gCodeColor + 200) ?>, <?php echo ($bCodeColor + 200) ?>)",
                                strokeColor: "rgb(<?php echo ($rCodeColor - 10) ?>, <?php echo ($gCodeColor - 10) ?>, <?php echo ($bCodeColor - 10) ?>)",
                                pointColor: "rgb(<?php echo ($rCodeColor + 10) ?>, <?php echo ($gCodeColor + 10) ?>, <?php echo ($bCodeColor + 10) ?>)",
                                pointStrokeColor: "#c1c7d1",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgb(220,220,220)",
                                data:
                                [
    <?php
    $maxRoom = 0;
    $occupaied = 0;
    $perOcc = 0;
    $maxRoomPerMonth = 0;



    for ($i = 1; $i <= 12; $i++) {
        $month_name = date('m-Y', mktime(0, 0, 0, $i, 1, $select_year));

        $sqlfindMaxRoom = mysqli_query($con, "SELECT SUM(`maxRoom`) as total FROM `hotelroomtype` WHERE `hotelName` like '" . $Hotelname . "' ");
        while ($resultMaxRoom = mysqli_fetch_array($sqlfindMaxRoom)) {
            $maxRoom = $resultMaxRoom['total'];
        }

        $chkBook = mysqli_query($con, "SELECT SUM(`Room_night`) as total FROM `all_data` WHERE `Hotel` = '".$ListHotel['hotelName']."'  AND DATE_FORMAT(`Arrival`,'%m-%Y') IN ('". $month_name."')   ");
        while ($row_chkBook = mysqli_fetch_array($chkBook)) {

            $occupaied = $row_chkBook['total'];

            if ($occupaied == NULL) {
                $occupaied = 0;
            }

            $maxRoomPerMonth = ($maxRoom * 30);
            $perOcc = (($occupaied / $maxRoomPerMonth) * 100);
            $perValid = number_format($perOcc,2);
            echo $perValid . ",";
            //echo $occupaied . ",";
        }
    }
    ?>
                                ]

                        },
<?php } ?>
                    ]
            };
            var salesChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: true,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 3,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: false,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
            };
            //Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
            //---------------------------
            //- END MONTHLY SALES CHART -
            //---------------------------
</script>
