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
    $c_id = $_GET['CourseID'];
    $c_title = $_GET['CourseTitle'];
    $c_dept = $_GET['DeptName'];
    $c_credits = $_GET['Credits'];

    $sql = "INSERT INTO course (course_id, title, dept_name, credits) VALUES ('". $c_id . "', '" . $c_title ."', '" . $c_dept . "', '" . $c_credits ."');";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';
    header('Location: ' . $home_url);
    ?>