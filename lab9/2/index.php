<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>
    <style>
        .clickable {
            cursor: pointer;
            text-decoration: underline;
            color: #316cf4;
        }
        .clickable:active {
            color: #112555;
        }
    </style>
</head>

<body>
    <?php
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] == 'UPDATE' && isset($_POST['c_id']) && isset($_POST['c_title']) && isset($_POST['c_dept']) && isset($_POST['c_credit'])) {
            $stmt = $conn->prepare("UPDATE course SET course_id=?, title=?, dept_name=?, credits=? WHERE course_id=?;");
            $stmt->bind_param('sssis', $_POST['new_c_id'], $_POST['c_title'], $_POST['c_dept'], $_POST['c_credit'], $_POST['c_id']);
            try {
                $update_result = $stmt->execute();
                if (!$update_result) {
                    $update_failed = true;
                }
            } catch (mysqli_sql_exception $e) {
                echo $e;
                $update_failed = true;
            }
        } else if ($_POST['action'] == 'DELETE' && isset($_POST['c_id'])) {
            $stmt = $conn->prepare("DELETE FROM course WHERE course_id=?;");
            $stmt->bind_param('s', $_POST['c_id']);
            $update_result = $stmt->execute();
            if (!$update_result) {
                $delete_failed = true;
            }
        }
    }

    $stmt = $conn->prepare("SELECT * FROM course");
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt = $conn->prepare("SELECT dept_name FROM department");
    $stmt->execute();
    $dept_result = $stmt->get_result();

    $result_success = true;
    $update_failed = false;
    $delete_failed = false;

    if (!$result) {
        $result_success = false;
    }
    ?>
    <div class="container mt-3">
        <div class="card shadow-sm p-3 mb-3">
            <div class="card-body">
                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
                    <?php if ($update_failed) : ?>
                        <div class="alert alert-danger" role="alert">
                            Unable to update <code><?php echo $_POST['c_id']; ?></code>
                        </div>
                    <?php elseif ($delete_failed) : ?>
                        <div class="alert alert-danger" role="alert">
                            Unable to delete <code><?php echo $_POST['c_id']; ?></code>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-success" role="alert">
                            Operation completed successfully!
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <form method="POST" hx-boost="true" id="myForm">
                    <h2 class="mb-2">Course Details</h2>
                    <input type="hidden" name="action" required id="actionField" value="">
                    <input type="hidden" name="c_id" required value="">
                    <label>Course ID</label>
                    <input class="mb-4 form-control" required type="text" name="new_c_id" />
                    <label>Title</label>
                    <input class="mb-4 form-control" required type="text" name="c_title" />
                    <label>Department Name</label>
                    <select name="c_dept" class="mb-4 form-select">
                        <option selected disabled>Select Department</option>
                        <?php 
                        while ($row = $dept_result->fetch_assoc()) {
                            echo '<option value="'. $row['dept_name'] .'">' . $row['dept_name'] . '</option>';
                        }
                        ?>
                    </select>
                    <label>Credits</label>
                    <input class="mb-4 form-control" required type="number" name="c_credit" />
                    <input type="button" class="btn btn-primary" name="updateBtn" onclick="Button(this);" value="Update">
                    <input type="button" class="btn btn-danger" name="deleteBtn" onclick="Button(this);" value="Delete">
                </form>
            </div>
        </div>
        <div class="card shadow-sm p-3 mb-5">
            <div class="card-body">
                <h2 class="mb-2">Course List</h2>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table"><thead><tr><th>Course ID</th><th>Title</th><th>Dept. Name</th><th>Credits</th></tr></thead><tbody>';
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr id="'. $row["course_id"] .'"><td class="clickable" onclick="setForm(\''. $row["course_id"] .'\')">' . $row["course_id"] . "</td><td>" . $row["title"] .
                            "</td><td>" . $row["dept_name"] . "</td><td>" . $row["credits"] . "</td>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "0 results found";
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function Button(theButton) {
            const form = document.querySelector("form");
            const action = document.getElementById('actionField')
            if (theButton.name === "updateBtn") {
                action.value = 'UPDATE';
            } else if (theButton.name === "deleteBtn") {
                action.value = 'DELETE';
            }
            console.log(form)
            form.requestSubmit()
        }

        function setForm(id){
            let numb = document.getElementById(id).childNodes.length;
            document.getElementById("myForm").elements["c_id"].value = document.getElementById(id).children[0].innerHTML
            document.getElementById("myForm").elements["new_c_id"].value = document.getElementById(id).children[0].innerHTML
            document.getElementById("myForm").elements["c_title"].value = document.getElementById(id).children[1].innerHTML
            document.getElementById("myForm").elements["c_dept"].value = document.getElementById(id).children[2].innerHTML
            document.getElementById("myForm").elements["c_credit"].value = document.getElementById(id).children[3].innerHTML
        }
    </script>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>