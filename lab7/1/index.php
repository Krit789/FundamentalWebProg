<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP สูตรคูณ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div>
            <h1>คูณเลข</h1>
            <form action="" method="POST">
                <label>กรอกสูตรคูณ:</label>
                <input type="number" name="operator"><button>แสดงตาราง</button>
            </form>
        </div>
        <div>
        <?php
        if (isset($_POST['operator'])) {
            $number = $_POST['operator'];
            echo "<p>ตารางสูตรคูณแม่ " . $number . '</p><table class="table"><tbody>';
            for ($i = 1; $i <= 12; $i++) {
                echo "<tr><td>" . $number . "</td><td> × </td><td>" . $i . "</td><td>=</td><td>". $i * $number ."</td></tr>";
            }
            echo "</tbody></table>";
        }
        ?>
        </div>
    </div>
</body>

</html>