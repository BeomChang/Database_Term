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

            $server = "3.35.24.226:3306";
            $user = "test";
            $pass = "testtest";
            $dbname = "hw2";
            $conn = new mysqli($server, $user, $pass, $dbname);

            if(!$conn)
                die("< class = 'error'>Connection failed: " . mysqli_connect_error() . "</>");
            if(!($result = mysqli_query($conn, $query))) {
                print("<p class='error'>could not execute query! : " . mysqli_error_list() . "</p>");
                die(mysqli_error($database));
            }
                        
            $query = "
            SELECT * FROM product
            WHERE transactionNumber = '$tnumber' 
            ";

            if($tproductnumber != "")
                $query = $query . "AND productID = '$tproductnumber' ";
            if($tprice != "")
                $query = $query . "AND price = '$tprice'";
            if($tdate != "")
                $query = $query . "AND " . "date = '$tdate'";
            if($tcustomername != "")
                $query = $query . "AND customerName = '$tcustomername'";

            $result = mysqli_query($conn, $query);

            mysqli_close($conn);
        ?>

        <h1>거래번호 <?php echo($tnumber)?> 검색결과</h1>
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
                    for($counter = 0; $row = mysqli_fetch_row($result); ++$counter) {
                        print("<tr>");
                        foreach($row as $key => $value) {
                            print("<td>$value</td>");
                        }
                        print("</tr>");
                    }
                ?>
            </table>
        </div>
    </body>
</html>