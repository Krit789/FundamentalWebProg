<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
    <?php
    $servername = "[Database IP]";
    $port = 3357;
    $username = "[DB and Username]"; //ตามที่กำหนดให้
    $password = "[Password]"; //ตามที่กำหนดให้
    $dbname = "[DB and Username]";    //ตามที่กำหนดให้

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM course JOIN section ON course.course_id = section.course_id;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-striped"><thead><tr><th>Course ID</th><th>Course Title</th><th>Dept. Name</th><th>Year</th><th>Semester</th><th>Building</th></tr></thead><tbody>';
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["course_id"] . "</td><td>" . $row["title"] .
                "</td><td>" . $row["dept_name"] . "</td><td>" . $row["year"] . "</td><td>" . $row["semester"] . "</td><td>" . $row["building"] . "</td>"  ;
        }
        echo "</tbody></table>";

    } else {
        echo "0 results";
    }


    // close connection
    mysqli_close($conn);
    ?>
    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>