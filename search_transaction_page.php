<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Transaction Information Print</title>
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
                if(isset($_POST["tnumber"])) {
                    $tnumber = $_POST["tnumber"];
                }
                else {
                    $tnumber = "";
                }

                if(isset($_POST["tproductnumber"])) {
                    $tproductnumber = $_POST["tproductnumber"];
                }
                else {
                    $tproductnumber = "";
                }

                if(isset($_POST["tprice"])) {
                    $tprice = $_POST["tprice"];
                }
                else {
                    $tprice = "";
                }

                if(isset($_POST["tdate"])) {
                    $tdate = $_POST["tdate"];
                }
                else {
                    $tdate = "";
                }

                if(isset($_POST["tcustomername"])) {
                    $tcustomername = $_POST["tcustomername"];
                }
                else {
                    $tcustomername = "";
                }
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "SELECT * FROM " . "transaction ";

            $parameter = array (
                'transactionNumber' => $tnumber,
                'productID' => $tproductnumber,
                'price' => $tprice,
                'date' => $tdate,
                'customerName' => $tcustomername
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
            mysqli_close($conn);
        ?>

        <h1>거래 검색 결과</h1>
        <div>
            <table>
                <tr>
                    <th>거래 번호</th>
                    <th>거래 상품 번호</th>
                    <th>거래 가격</th>
                    <th>거래 일자</th>
                    <th>거래 고객 이름</th>
                </tr>

                <?php
                    for($counter = 0; $row = mysqli_fetch_row($result); $counter++) {
                        print("<tr>");
                        foreach ($row as $key => $value) {
                            if($key == "price")
                                print("<td>$".$value."</td>");
                            else
                                print("<td>$value</td>");
                        }
                        print("</tr>");
                    }
                ?>
            </table>
        </div>
    </body>
</html>