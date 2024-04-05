<?php

$url = "http://10.0.15.21/lab/lab12/restapis/products.php?list=10";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
$result = json_decode($response);
$dataPoints = array();

foreach ($result as $res) {
    array_push($dataPoints, array("label" => $res->ProductCode, "y" => $res->UnitPrice));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Price of Product"
                },
                axisY: {
                    title: "Unit Price (in THB)",
                    includeZero: true,
                    prefix: "",
                    suffix: " THB"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0 ฿ ",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints); ?>
                }]
            });
            chart.render();
        }
    </script>
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center; margin-top:24px;">Price of Product</h1>
    <div class="container card shadow-sm mt-3 pb-5">
        <div class="card-body" id="chartContainer" style="height: 450px; width: 95%;"></div>
    </div>
</body>
<script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</html>