<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    $validation = array();
    $validationFailure = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['Name'])) {
            if (strlen($_POST['Name']) < 5) {
                array_push($validation, 'ชื่อต้องมีความยาวอย่างน้อย 5 ตัวอักษร');
                $validationFailure = true;
            } else {
                array_push($validation, NULL);
            }
        } else {
            array_push($validation, 'กรุณาใส่ชื่อ');
            $validationFailure = true;
        }

        if (isset($_POST['Address'])) {
            if (strlen($_POST['Address']) < 5) {
                array_push($validation, 'ที่อยู๋ต้องมีความยาวอย่างน้อย 5 ตัวอักษร');
                $validationFailure = true;
            } else {
                array_push($validation, NULL);
            }
        } else {
            array_push($validation, 'กรุณาใส่ที่อยู่');
            $validationFailure = true;
        }
        if (isset($_POST['Age'])) {
            if (is_numeric($_POST['Age'])) {
                array_push($validation, NULL);
            } else {
                array_push($validation, 'กรุณาใส่อายุ');
                $validationFailure = true;
            }
        } else {
            array_push($validation, 'กรุณาใส่อายุ');
            $validationFailure = true;
        }

        if (isset($_POST['Profession'])) {
            if (strlen($_POST['Profession']) < 5) {
                array_push($validation, 'อาชีพต้องมีความยาวอย่างน้อย 5 ตัวอักษร');
                $validationFailure = true;
            } else {
                array_push($validation, NULL);
            }
        } else {
            array_push($validation, 'กรุณาใส่อาชีพ');
            $validationFailure = true;
        }

        if (isset($_POST['ResidentialStatus'])) {
            array_push($validation, NULL);
        } else {
            array_push($validation, 'กรุณาสถานะการอยู่อาศัย');
            $validationFailure = true;
        }
    } else {
        $validation = array(NULL, NULL, NULL, NULL, NULL);
    }
    ?>
    <h1 class="text-center mt-3">Member Registration</h1>
    <div class="container-content mb-5">
        <form action="" method="POST">
            <div>
                <label>
                    Name
                </label>
                <input class="form-control" value="<?php echo (isset($_POST['Name'])) ? $_POST['Name'] : ''; ?>" type="text" name="Name" />
                <p class="text-danger fw-bold"><?php echo (!is_null($validation[0])) ? $validation[0] : '' ?></p>
                <label>
                    Address
                </label>
                <textarea class="form-control" name="Address"><?php echo (isset($_POST['Address'])) ? $_POST['Address'] : ''; ?></textarea>
                <p class="text-danger fw-bold"><?php echo (!is_null($validation[1])) ? $validation[1] : ''; ?></p>
                <label>
                    Age
                </label>
                <input class="form-control" value="<?php echo (isset($_POST['Age'])) ? $_POST['Age'] : ''; ?>" type="number" name="Age" />
                <p class="text-danger fw-bold"><?php echo (!is_null($validation[2])) ? $validation[2] : ''; ?></p>
                <label>
                    Profession
                </label>
                <input class="form-control" value="<?php echo (isset($_POST['Profession'])) ? $_POST['Profession'] : ''; ?>" type="text" name="Profession" />
                <p class="text-danger fw-bold"><?php echo (!is_null($validation[3])) ? $validation[3] : ''; ?></p>
                <label>Residential Status</label>
                <div>
                    <input type="radio" value="true" class="form-check-input" name="ResidentialStatus" <?php echo (isset($_POST['ResidentialStatus']) && $_POST['ResidentialStatus'] == 'true') ? 'checked' : ''; ?>>
                    <label>Resident</label>
                    <input type="radio" value="false" class="form-check-input" name="ResidentialStatus" <?php echo (isset($_POST['ResidentialStatus']) && $_POST['ResidentialStatus'] == 'false') ? 'checked' : ''; ?>>
                    <label>Non-Resident</label>
                </div>
                <p class="text-danger fw-bold"><?php echo (!is_null($validation[4])) ? $validation[4] : ''; ?></p>

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$validationFailure) {
        echo '    <div class="card shadow-sm p-3">
                <div class="card-body">';
        echo '<h1>Your Data</h1>';
        echo '<label class="fw-bold">Name</label><p>' . $_POST['Name'] . '</p>';
        echo '<label class="fw-bold">Address</label><p>' . $_POST['Address'] . '</p>';
        echo '<label class="fw-bold">Age</label><p>' . $_POST['Age'] . ' Year Old</p>';
        echo '<label class="fw-bold">Profession</label><p>' . $_POST['Profession'] . '</p>';
        echo '<label class="fw-bold">Residential Status</label><p>' . (($_POST['ResidentialStatus'] == 'true') ? 'Resident' : 'Non-Resident') . '</p></div>
                </div>';
    }
    ?>

    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>