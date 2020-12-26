<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Q4_B</title>
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
                if(isset($_POST["tdate"])) {
                    $tdate = $_POST["tdate"];
                }
                else {
                    $tdate = "";
                }
                if(isset($_POST["tcnt"])) {
                    $tcnt = $_POST["tcnt"];
                }
                else {
                    $tcnt = "";
                }
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "  SELECT pt.productName, SUM(pt.price) sumPrice
                        FROM	(	
                                    SELECT transaction.*, product.name productName
                                    FROM transaction, product
                                    WHERE transaction.date < '".$tdate."' AND transaction.productID = product.productID
                                ) as pt
                        GROUP BY pt.productName
                        ORDER BY sumPrice DESC
                        LIMIT $tcnt";

            $result = mysqli_query($conn, $query);
            mysqli_close($conn);

            print($query);
        ?>

        <h1>주어진 날 이전에 가장 많은 거래(금액기준)가 이루어진 k가지 상품 목록</h1>
        <div>
            <table>
                <tr>
                    <th>상품 이름</th>
                    <th>상품 거래 금액 총계</th>
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