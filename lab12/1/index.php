<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flexbox {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-top: 10px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">

        <h1>Courtries Catalog</h1>
        <?php
        $client = curl_init("http://10.0.15.21/lab/lab12/restapis/10countries.json");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);

        foreach ($result as $r) { ?>
            <div class="card shadow-sm mb-5">
                <div class="card-body d-flex flex-row  flex-wrap-reverse gap-4 justify-content-between align-items-center">
                    <div class="p-3">
                        <h5>Name</h5><?php echo $r->name ?><br>
                        <h5 class="mt-1">Capital</h5><?php echo $r->capital ?><br>
                        <h5 class="mt-1">Population</h5><?php echo number_format($r->population)  ?><br>
                        <h5 class="mt-1">Region</h5><?php echo $r->region  ?><br>
                        <h5 class="mt-1">Location</h5><?php echo join(" " ,$r->latlng) ?><br>
                        <h5 class="mt-1">Borders</h5><?php  echo (count($r->borders) > 0) ? join(" " ,$r->borders) : 'None'  ?>
                    </div>
                    <div class="px-3">
                        <img class="border" style="width: 100%; max-width: 384px" src="<?php echo $r->flag ?>">
                    </div>
                </div>
            </div>
<?php } ?>
</div>
<script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>