<?php

$show = "no";


// 1. Connect to Database 
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('customers.db');
    }
}

// 2. Open Database 
$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
    die();
} else {
    // echo "Opened database successfully<br>";
}


if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['action'])) {
    if (isset($_POST["e_id"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && isset($_POST["phone"])) {
        if ($_POST['action'] == "SAVE") {
            setcookie('e_id', $_POST["e_id"], time() + (86400), '/');
            setcookie('firstname', $_POST["firstname"], time() + (86400), '/');
            setcookie('lastname', $_POST["lastname"], time() + (86400), '/');
            setcookie('address', $_POST["address"], time() + (86400), '/');
            setcookie('email', $_POST["email"], time() + (86400), '/');
            setcookie('phone', $_POST["phone"], time() + (86400), '/');
            $show = "save";
        } else if ($_POST['action'] == "SHOW") {
            if (isset($_COOKIE['e_id']) && isset($_COOKIE['firstname']) && isset($_COOKIE['lastname']) && isset($_COOKIE['address']) && isset($_COOKIE['email']) && isset($_COOKIE['phone'])) {
                $show = "yes";
            } else {
                $show = "error";
            }
        } else if ($_POST['action'] == "CLEAR") {
            unset($_COOKIE['e_id']);
            setcookie('e_id', '', time() - 3600, '/');
            unset($_COOKIE['firstname']);
            setcookie('firstname', '', time() - 3600, '/');
            unset($_COOKIE['lastname']);
            setcookie('lastname', '', time() - 3600, '/');
            unset($_COOKIE['address']);
            setcookie('address', '', time() - 3600, '/');
            unset($_COOKIE['email']);
            setcookie('email', '', time() - 3600, '/');
            unset($_COOKIE['phone']);
            setcookie('phone', '', time() - 3600, '/');
            $show = "clear";
        }
    } else {
        echo "ข้อมูลไม่ครบ";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_COOKIE['e_id']) && isset($_COOKIE['firstname']) && isset($_COOKIE['lastname']) && isset($_COOKIE['address']) && isset($_COOKIE['email']) && isset($_COOKIE['phone'])) {
        $show = "yes";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans' !important;
        }

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
    <div class="container my-4">
        <h1>Employee Information</h1>
        <?php if ($show == 'error') : ?>
            <div class="alert alert-danger">คุณไม่ได้บันทึกข้อมูลไว้ในระบบ</div>
        <?php elseif ($show == 'save') : ?>
            <div class="alert alert-success">บันทึกข้อมูลสำเร็จ</div>
        <?php elseif ($show == 'clear') : ?>
            <div class="alert alert-success">นำข้อมูลของคุณออกสำเร็จ</div>
        <?php endif ?>
        <form method="POST">
            <input type="hidden" id="actionField" name="action">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Employee ID</label>
                <input class="form-control" type="number" value="<?php echo ($show == 'yes') ? $_COOKIE['e_id'] : '' ?>" name="e_id">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                        <input class="form-control" type="text" value="<?php echo ($show == 'yes') ? $_COOKIE['firstname'] : '' ?>" name="firstname">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                        <input class="form-control" type="text" value="<?php echo ($show == 'yes') ? $_COOKIE['lastname'] : '' ?>" name="lastname">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <textarea class="form-control" rows="2" name="address"><?php echo ($show == 'yes') ? $_COOKIE['address'] : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input class="form-control" type="email" value="<?php echo ($show == 'yes') ? $_COOKIE['email'] : '' ?>" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input class="form-control" type="tel" value="<?php echo ($show == 'yes') ? $_COOKIE['phone'] : '' ?>" name="phone">
            </div>
            <div style="display: flex; column-gap: 1em;">
                <button class="btn btn-success" name="save" onclick="Button(this)">Save Data</button>
                <button class="btn btn-primary" name="show" onclick="Button(this)">Show Data</button>
                <button class="btn btn-danger" name="clear" onclick="Button(this)">Clear Data</button>
            </div>
        </form>
        <table class="table mt-3">
            <thead>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php

                $smt = $db->prepare("SELECT * FROM customers");
                $ret = $smt->execute();
                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    echo '<tr id="' . $row["CustomerId"] . '"><td class="clickable" onclick="setForm(\'' . $row["CustomerId"] . '\')">' . $row['CustomerId'] . '</td><td>' . $row['FirstName'] . " " . $row['LastName'] . '</td><td>' . $row['Address'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Email'] . '</td></tr>';
                }
                $db->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function Button(theButton) {
            const form = document.querySelector("form");
            const action = document.getElementById('actionField')
            if (theButton.name === "save") {
                action.value = 'SAVE';
            } else if (theButton.name === "show") {
                action.value = 'SHOW';
            } else if (theButton.name === "clear") {
                action.value = 'CLEAR';
            }
            form.requestSubmit()
        }

        function setForm(id) {
            let numb = document.getElementById(id).childNodes.length;
            let form = document.getElementsByTagName('form')[0];
            form.elements["e_id"].value = document.getElementById(id).children[0].innerHTML
            form.elements["firstname"].value = document.getElementById(id).children[1].innerHTML.split(' ')[0]
            form.elements["lastname"].value = document.getElementById(id).children[1].innerHTML.split(' ')[1]
            form.elements["address"].value = document.getElementById(id).children[2].innerHTML
            form.elements["phone"].value = document.getElementById(id).children[3].innerHTML
            form.elements["email"].value = document.getElementById(id).children[4].innerHTML
        }
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$show) {
            if (isset($_COOKIE['e_id']) && isset($_COOKIE['firstname']) && isset($_COOKIE['lastname']) && isset($_COOKIE['address']) && isset($_COOKIE['email']) && isset($_COOKIE['phone'])) {
            } else {
                echo "setForm('1')";
            }
        }
        ?>
    </script>
</body>

</html>