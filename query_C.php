<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Q4_C</title>
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
                if(isset($_POST["pcnt"])) {
                    $pcnt = $_POST["pcnt"];
                }
                else {
                    $pcnt = "";
                }
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "  SELECT *
                        FROM	(
                                    SELECT pt.customerName, pt.supplierName, COUNT(pt.supplierName) purchaseTimes
                                    FROM	(
                                                SELECT transaction.*, product.supplierName
                                                FROM transaction, product
                                                WHERE transaction.productID = product.productID
                                            ) AS pt
                                    GROUP BY pt.customerName, pt.supplierName
                                ) AS times
                        WHERE times.purchaseTimes >= $pcnt;";

            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
        ?>

        <h1>하나의 supplier에서 m번 이상의 제품을 산 고객의 이름</h1>
        <div>
            <table>
                <tr>
                    <th>고객 이름</th>
                    <th>상품 공급 업자</th>
                    <th>구매 횟수</th>
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