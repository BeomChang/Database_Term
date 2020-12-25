<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Customer Information Print</title>
        <style>
            table  { background-color: lightblue; 
                     border: 1px solid gray; 
                     border-collapse: collapse; }
            th, td { padding: 5px; border: 1px solid gray; }
            tr:nth-child(even) { background-color: white; }
            tr:first-child { background-color: lightgreen; }
            .error  { color: red }
        </style>
    </head>

    <body>
        <?php
            $opt_cnt = 0;

            if(!$_SERVER["REQUEST_METHOD"] == "POST") {
                echo("<p>POST Error!</p></body></html>");
                die();
            }
            else {
                if(isset($_POST["cname"])) {
                    $cname = $_POST["cname"];
                }
                else {
                    $cname = "";
                }

                if(isset($_POST["cphone"])) {
                    $cphone = $_POST["cphone"];
                }
                else {
                    $cphone = "";
                }

                if(isset($_POST["caddress"])) {
                    $caddress = $_POST["caddress"];
                }
                else {
                    $caddress = "";
                }

                if(isset($_POST["cgender"])) {
                    $cgender = $_POST["cgender"];
                }
                else {
                    $cgender = "";
                }
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "SELECT * FROM customer ";

            $parameter = array (
                'name' => $cname,
                'phone' => $cphone,
                'address' => $caddress,
                'gender' => $cgender
            );

            foreach ($parameter as $key => $value) {
                if($value != "")
                    $opt_cnt = $opt_cnt + 1;
            }

            if($opt_cnt > 0)
                $query = $query . "WHERE ";

            foreach($parameter as $key => $value) {
                if($value != "") {
                    $query = $query . "$key = '".$value."'";
                    $opt_cnt--;

                    if($opt_cnt > 0)
                        $query = $query . " AND ";
                }
            }

            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            mysqli_close($conn);
        ?>

        <h1>고객 검색 결과</h1>
        <div>
            <table>
                <tr>
                    <th>고객 이름</th>
                    <th>고객 전화번호</th>
                    <th>고객 주소</th>
                    <th>고객 성별</th>
                </tr>

                <?php
                    print("<tr>");
                    print("<td>".$row[0]."</td>");
                    print("<td>".$row[1]."</td>");
                    print("<td>".$row[2]."</td>");
                    print("<td>".$row[3]."</td>");
                    print("</tr>");
                ?>
            </table>
        </div>
    </body>
</html>