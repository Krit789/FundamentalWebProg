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
    <div class="container card mt-4 shadow-sm">
        <div class="card-body">
            <h1>Product Catalog</h1>
            <form method="POST">
                <?php
                $client = curl_init("http://10.0.15.21/lab/lab12/restapis/products.php");
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $index = 0;
                $data_count = count(json_decode($response));
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['previous']) && isset($_POST['prev_v'])) $index = intval($_POST['prev_v']);
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['next']) && isset($_POST['next_v'])) $index = intval($_POST['next_v']);
                $result = json_decode($response)[$index];
                echo '<input type="hidden" name="prev_v" value="' . ($index != 0 ? ($index - 1) : '') . '">';
                echo '<input type="hidden" name="next_v" value="' . (($data_count - 1 != $index) ? ($index + 1) : '') . '">';

                echo "<h5>Product ID</h5>" . $result->ProductID . " <br><br>";
                echo "<h5>ProductCode</h5>" . $result->ProductCode . " <br><br>";
                echo "<h5>ProductName</h5>" . $result->ProductName . " <br><br>";
                echo "<h5>Description</h5>" . $result->Description . " <br><br>";
                echo "<h5>Unit Price</h5> $" . $result->UnitPrice . " <br><br><hr>";

                echo '<div class="flexbox"><button class="btn ' . ($index == 0 ? 'btn-disabled' : 'btn-primary') . '" type="submit" name="previous" ' . ($index == 0 ? 'disabled' : '') . '>Previous</button>';
                echo '<button class="btn ' . (($data_count - 1 == $index) ? 'btn-disabled' : 'btn-primary') . '" type="submit" name="next" ' . (($data_count - 1 == $index) ? 'disabled' : '') . '>Next</button></div>';
                ?>
            </form>
        </div>
    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>