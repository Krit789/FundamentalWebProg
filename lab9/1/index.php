<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['record_num']) && $_POST['record_num'] > 0) {
        $servername = "[Database IP]";
        $port = 3357;
        $username = "[DB and Username]"; //ตามที่กำหนดให้
        $password = "[Password]"; //ตามที่กำหนดให้
        $dbname = "[DB and Username]";    //ตามที่กำหนดให้

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        // Check connection
        if ($conn->connect_errno) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM section LIMIT ?,1;");
        $stmt->bind_param("i", $_POST['record_num']);
        $stmt->execute();
        // $sql = "SELECT * FROM section LIMIT " . $_POST['record_num'] . ",1 ;";
        $result = $stmt->get_result();
        $result_success = true;

        if (!$result) {
            $result_success = false;
        }
    } else {
        $result_success = false;
    }
    ?>
    <div class="container mt-3">
        <div class="card shadow-sm p-3">
            <div class="card-body">
                <form method="POST">
                    <h2 class="mb-2">Enter a Record Number</h2>
                    <input class="mb-4 form-control" type="number" name="record_num" required <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') echo 'value="' . $_POST['record_num'] . '"'; ?> />
                    <button type="submit" class="btn btn-primary">Display</button>
                </form>
            </div>
        </div>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $result_success && mysqli_num_rows($result) > 0) : ?>
            <?php $row = $result->fetch_assoc(); ?>
            <div class="card shadow-sm p-3 mt-5 mb-5">
                <div class="card-body">
                    <h1>Your Section Record</h1>
                    <label class="fw-bold">Course ID</label>
                    <p><?php echo $row['course_id']; ?></p>
                    <label class="fw-bold">Sec ID</label>
                    <p><?php echo $row['sec_id']; ?></p>
                    <label class="fw-bold">Semester</label>
                    <p><?php echo $row['semester']; ?></p>
                    <label class="fw-bold">Year</label>
                    <p><?php echo $row['year']; ?></p>
                    <label class="fw-bold">Building</label>
                    <p><?php echo $row['year']; ?></p>
                    <label class="fw-bold">Room Number</label>
                    <p><?php echo $row['year']; ?></p>
                    <label class="fw-bold">Time Slot ID</label>
                    <p><?php echo $row['time_slot_id']; ?></p>
                </div>
            </div>
        <?php elseif ($result_success && $result->num_rows == 0) : ?>
            <div class="card shadow-sm p-3 mt-5">
                <div class="card-body">
                    <h1>No Result</h1>
                </div>
            </div>
        <?php else : ?>
        <div class="card shadow-sm p-3 mt-5">
                <div class="card-body">
                    <h1>Error</h1>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>