<?php if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
// 1. Connect to Database 
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('questions.db');
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
$smt = $db->prepare("SELECT * FROM questions");
$ret = $smt->execute();
$finished = false;
session_start();

if (!isset($_SESSION["current_question"])) {
    $_SESSION["current_question"] = 1;
}
if (!isset($_SESSION["score"])) {
    $_SESSION["score"] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'answer' && isset($_POST['answer'])) {
        $smt = $db->prepare("SELECT COUNT(*) as count FROM questions");
        $ret = $smt->execute();
        $row = $ret->fetchArray();
        if ($_SESSION["current_question"] + 1 > $row['count']) {
            $finished = true;
        } else {
            $smt = $db->prepare("SELECT * FROM questions WHERE QID = :qid");
            $smt->bindValue(':qid', $_SESSION["current_question"], SQLITE);
            $ret = $smt->execute();
            $row = $ret->fetchArray(SQLITE3_ASSOC);
            if ($row['Correct'] == $_POST['answer']) {
                $_SESSION["score"]++;
            }
            $_SESSION["current_question"]++;
        }

        
    } elseif ($_POST['action'] == 'reset') {
        $finished = false;
        $_SESSION["current_question"] = 1;
        $_SESSION["score"] = 0;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://10.0.15.21/lab/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans' !important;
        }
    </style>
    <title>Document</title>

</head>

<body>
    <div class="container my-3">
        <h1>Quiz</h1>
        <form method="POST">
            <?php 
            if ($finished) {
                echo "<h3>Here's your result</h3><h4>You answered ". $_SESSION["score"] ."/10 question correctly!</h4>";
            } else {
                $smt = $db->prepare("SELECT * FROM questions WHERE QID = :qid");
                $smt->bindValue(':qid', $_SESSION["current_question"], SQLITE3_TEXT);
                $ret = $smt->execute();
                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    echo '<div><h3>' . $row['QID'] . '.) ' . $row['Stem'] . '</h3>
                <input type="hidden" name="action" value="answer">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="alt_a" name="answer" value="A" required>
                    <label class="form-check-label" for="alt_a">' . $row['Alt_A'] . '</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="alt_b" name="answer" value="B">
                    <label class="form-check-label" for="alt_b">' . $row['Alt_B'] . '</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="alt_c" name="answer" value="C">
                    <label class="form-check-label" for="alt_c">' . $row['Alt_C'] . '</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="alt_d" name="answer" value="D">
                    <label class="form-check-label" for="alt_d">' . $row['Alt_D'] . '</label>
                </div>
                <button type="submit" class="mx-2 mt-3 btn btn-primary">Submit</button>
            ';
                }
            }
            $db->close();
            ?>
        </form>
        <form method="POST" class="mt-2">
            <input type="hidden" name="action" value="reset">
            <button type="submit" class="btn btn-link">Reset Quiz</button>
        </form>
    </div>
    <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>