<?php if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] == 'UPDATE_TABLE') {
            $smt = $db->prepare("SELECT COUNT(*) as count FROM customers");
            $ret = $smt->execute();
            $row = $ret->fetchArray();
            $data = "";
            $data_arr = array();
            if ($row['count'] == 0) {
                $smt = $db->prepare("INSERT INTO customers ('CustomerId', 'FirstName', 'LastName', 'Company', 'Address', 'City', 'State', 'Country', 'PostalCode', 'Phone', 'Fax', 'Email', 'SupportRepId') VALUES ('1', 'Luís', 'Gonçalves', 'Embraer - Empresa Brasileira de Aeronáutica S.A.', 'Av. Brigadeiro Faria Lima, 2170', 'São José dos Campos', 'SP', 'Brazil', '12227-000', '+55 (12) 3923-5555', '+55 (12) 3923-5566', 'luisg@embraer.com.br', '3'),  ('2', 'Leonie', 'Köhler', '', 'Theodor-Heuss-Straße 34', 'Stuttgart', '', 'Germany', '70174', '+49 0711 2842222', '', 'leonekohler@surfeu.de', '5'),  ('3', 'François', 'Tremblay', '', '1498 rue Bélanger', 'Montréal', 'QC', 'Canada', 'H2G 1A7', '+1 (514) 721-4711', '', 'ftremblay@gmail.com', '3'),  ('4', 'Bjørn', 'Hansen', '', 'Ullevålsveien 14', 'Oslo', '', 'Norway', '0171', '+47 22 44 22 22', '', 'bjorn.hansen@yahoo.no', '4'),  ('5', 'František', 'Wichterlová', 'JetBrains s.r.o.', 'Klanova 9/506', 'Prague', '', 'Czech Republic', '14700', '+420 2 4172 5555', '+420 2 4172 5555', 'frantisekw@jetbrains.com', '4'),  ('6', 'Helena', 'Holý', '', 'Rilská 3174/6', 'Prague', '', 'Czech Republic', '14300', '+420 2 4177 0449', '', 'hholy@gmail.com', '5'),  ('7', 'Astrid', 'Gruber', '', 'Rotenturmstraße 4, 1010 Innere Stadt', 'Vienne', '', 'Austria', '1010', '+43 01 5134505', '', 'astrid.gruber@apple.at', '5'),  ('8', 'Daan', 'Peeters', '', 'Grétrystraat 63', 'Brussels', '', 'Belgium', '1000', '+32 02 219 03 03', '', 'daan_peeters@apple.be', '4'),  ('9', 'Kara', 'Nielsen', '', 'Sønder Boulevard 51', 'Copenhagen', '', 'Denmark', '1720', '+453 3331 9991', '', 'kara.nielsen@jubii.dk', '4'),  ('10', 'Eduardo', 'Martins', 'Woodstock Discos', 'Rua Dr. Falcão Filho, 155', 'São Paulo', 'SP', 'Brazil', '01007-010', '+55 (11) 3033-5446', '+55 (11) 3033-4564', 'eduardo@woodstock.com.br', '4'),  ('11', 'Alexandre', 'Rocha', 'Banco do Brasil S.A.', 'Av. Paulista, 2022', 'São Paulo', 'SP', 'Brazil', '01310-200', '+55 (11) 3055-3278', '+55 (11) 3055-8131', 'alero@uol.com.br', '5'),  ('12', 'Roberto', 'Almeida', 'Riotur', 'Praça Pio X, 119', 'Rio de Janeiro', 'RJ', 'Brazil', '20040-020', '+55 (21) 2271-7000', '+55 (21) 2271-7070', 'roberto.almeida@riotur.gov.br', '3'),  ('13', 'Fernanda', 'Ramos', '', 'Qe 7 Bloco G', 'Brasília', 'DF', 'Brazil', '71020-677', '+55 (61) 3363-5547', '+55 (61) 3363-7855', 'fernadaramos4@uol.com.br', '4'),  ('14', 'Mark', 'Philips', 'Telus', '8210 111 ST NW', 'Edmonton', 'AB', 'Canada', 'T6G 2C7', '+1 (780) 434-4554', '+1 (780) 434-5565', 'mphilips12@shaw.ca', '5'),  ('15', 'Jennifer', 'Peterson', 'Rogers Canada', '700 W Pender Street', 'Vancouver', 'BC', 'Canada', 'V6C 1G8', '+1 (604) 688-2255', '+1 (604) 688-8756', 'jenniferp@rogers.ca', '3'),  ('16', 'Frank', 'Harris', 'Google Inc.', '1600 Amphitheatre Parkway', 'Mountain View', 'CA', 'USA', '94043-1351', '+1 (650) 253-0000', '+1 (650) 253-0000', 'fharris@google.com', '4'),  ('17', 'Jack', 'Smith', 'Microsoft Corporation', '1 Microsoft Way', 'Redmond', 'WA', 'USA', '98052-8300', '+1 (425) 882-8080', '+1 (425) 882-8081', 'jacksmith@microsoft.com', '5'),  ('18', 'Michelle', 'Brooks', '', '627 Broadway', 'New York', 'NY', 'USA', '10012-2612', '+1 (212) 221-3546', '+1 (212) 221-4679', 'michelleb@aol.com', '3'),  ('19', 'Tim', 'Goyer', 'Apple Inc.', '1 Infinite Loop', 'Cupertino', 'CA', 'USA', '95014', '+1 (408) 996-1010', '+1 (408) 996-1011', 'tgoyer@apple.com', '3'),  ('20', 'Dan', 'Miller', '', '541 Del Medio Avenue', 'Mountain View', 'CA', 'USA', '94040-111', '+1 (650) 644-3358', '', 'dmiller@comcast.com', '4');");
                $ret = $smt->execute();
                $data_arr["status"] = 0;
                $data_arr["special_message"] = '<div class="alert alert-warning">หยุดลบเล่นได้หรือยัง</div>';
            }
            $smt = $db->prepare("SELECT * FROM customers");
            $ret = $smt->execute();
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $data = $data . '<tr><td>' . $row['CustomerId'] . '</td><td>' . $row['FirstName'] . " " . $row['LastName'] . '</td><td>' . $row['Address'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Email'] . '</td></tr>';
            }
            if (!array_key_exists("status" ,$data_arr)) {
                $data_arr["status"] = 1;
            }
            $data_arr["data"] = $data;
            echo json_encode(array_merge($data_arr));
            $db->close();
            die();
        }
        if ($_POST['action'] == 'DELETE') {
            $smt = $db->prepare("DELETE FROM customers WHERE CustomerId=(SELECT MAX(CustomerId) FROM customers)");
            $ret = $smt->execute();
            if ($ret) {
                echo json_encode(array("result" => "success"));
            } else {
                echo json_encode(array("result" => "fail"));
            }
            $db->close();
            die();
        }
    } else {
        $smt = $db->prepare("SELECT * FROM customers");
        $ret = $smt->execute();
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
        </style>
    </head>

    <body>
        <div class="container my-3">
            <h1>Customers.db</h1>
            <div id="message"></div>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                        $ret = $smt->execute();
                        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                            echo '<tr><td>' . $row['CustomerId'] . '</td><td>' . $row['FirstName'] . " " . $row['LastName'] . '</td><td>' . $row['Address'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Email'] . '</td></tr>';
                        }
                        $db->close();
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <button class="btn btn-danger" onclick="deleteLastRow()">Delete Last Row</button>
            </div>
        </div>

        <script>
            async function deleteLastRow() {
                let formBody = [];
                var encodedKey = encodeURIComponent('action');
                var encodedValue = encodeURIComponent('DELETE');
                formBody.push(encodedKey + "=" + encodedValue);
                formBody = formBody.join("&");
                const response = await fetch(window.location, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: formBody
                })
                const res = await response.json()
                console.log(res)
                updateTable()
            }

            async function updateTable() {
                let formBody = [];
                var encodedKey = encodeURIComponent('action');
                var encodedValue = encodeURIComponent('UPDATE_TABLE');
                formBody.push(encodedKey + "=" + encodedValue);
                formBody = formBody.join("&");
                const response = await fetch(window.location, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: formBody
                });
                const table = await response.json()
                if (table.status === 0) {
                    document.getElementById('message').innerHTML = table.special_message
                } else {
                    document.getElementById('message').innerHTML = ""
                }
                document.getElementsByTagName('tbody')[0].innerHTML = table.data

            }
        </script>
        <script src="http://10.0.15.21/lab/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>