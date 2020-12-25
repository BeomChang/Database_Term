<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Transaction Adding</title>
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
            if(!$_SERVER["REQUEST_METHOD"] == "POST") {
                echo("<p>POST Error!</p></body></html>");
                die();
            }
            else {
                $tnumber = isset($_POST["tnumber"]) ? $_POST["tnumber"] : "";
                $tproductnumber = isset($_POST["tproductnumber"]) ? $_POST["tproductnumber"] : "";
                $tprice = isset($_POST["tprice"]) ? $_POST["tprice"] : "";
                $tdate = isset($_POST["tdate"]) ? $_POST["tdate"] : "";
                $tcustomername = isset($_POST["tcustomername"]) ? $_POST["tcustomername"] : "";
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "INSERT INTO " . "transaction VALUES ('".$tnumber."', '".$tproductnumber."', '".$tprice."', '".$tdate."', '".$tcustomername."')";
            $result = mysqli_query($conn, $query);

            if($result) {
                echo("정상 입력 되었습니다!");
                $query = "SELECT * FROM " . "transaction WHERE " . "transactionNumber = '".$tnumber."'";
                $result = mysqli_query($conn, $query);
            }
            else {
                echo("입력 실패!!!");
                die();
            }

            mysqli_close($conn);
        ?>

        <h1>고객 추가 결과</h1>
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
                            print("<td>$value</td>");
                        }
                        print("</tr>");
                    }
                ?>
            </table>
        </div>
    </body>
</html>