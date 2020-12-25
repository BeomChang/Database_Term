<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Product Information Print</title>
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
                $pname = isset($_POST["pname"]) ? $_POST["pname"] : "";
                $pid = isset($_POST["pid"]) ? $_POST["pid"] : "";
                $psuppliername = isset($_POST["psuppliername"]) ? $_POST["psuppliername"] : "";
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "SELECT * FROM product WHERE productID = '".$pid."'";

            if($pname != "")
            $query = $query . "AND name = '".$pname."'";
            if($psuppliername != "")
                $query = $query . "AND " . "supplierName = '".$psuppliername."'";

            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            mysqli_close($conn);
        ?>

        <h1>상품번호 <?php echo($pid)?> 검색결과</h1>
        <div>
            <table>
                <tr>
                    <th>상품 이름</th>
                    <th>상품 번호</th>
                    <th>상품 공급 업자</th>
                </tr>

                <?php
                    print("<tr>");
                    print("<td>".$row[0]."</td>");
                    print("<td>".$row[1]."</td>");
                    print("<td>".$row[2]."</td>");
                    print("</tr>");
                ?>
            </table>
        </div>
    </body>
</html>