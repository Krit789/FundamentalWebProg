<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <title>PHP Calendar</title>
</head>

<body>
    <div class="container">
        <div>
            <form method="GET">
                <label style="font-size: 28px;">เลือกเดือน</label> <br />
                <select name="month" onchange="this.form.submit()">
                    <?php
                    $month = date('m');

                    if (isset($_GET['month'])) {
                        if ($_GET['month'] > 0 && $_GET['month'] <= 12) {
                            $month = $_GET['month'];
                        } else {
                            echo "<script>window.location.href = window.location.href.split('?')[0];</script>";
                        }
                    }

                    for ($i = 1; $i <= 12; $i++) {
                        $current_month = date('F', strtotime("2024/" . $i . "/1"));
                        echo '<option ' . (($month == $i) ? 'selected' : '')  . ' value="' . $i . '">' . $current_month . '</option>';
                    }
                    ?>
                </select>
            </form>
        </div>
        <div>
            <table class="table">
                <thead>
                    <?php
                    $day_array = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                    $last_day = date('t', strtotime("2024/" . $month . "/1"));
                    echo '<h1>' . date('F', strtotime("2024/" . $month . "/1")) . ' 2024</h1>';
                    foreach ($day_array as $day) {
                        echo "<th>" . $day . "</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i <= $last_day; $i++) {
                        $day = date('D', strtotime("2024/" . $month . "/" . $i));

                        if ($i == 1) {
                            for ($j = 0; $j < array_search($day, $day_array); $j++) {
                                echo "<td></td>";
                            }
                        }

                        if ($day == "Sun") {
                            echo "<tr>";
                        }

                        echo '<td>' . $i . '</td>';

                        if ($day == "Sat") {
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>