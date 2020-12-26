<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Q4_A</title>
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
            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $query = "  SELECT cpt.pname FROM (
                                                SELECT product.name pname, customer.name cname, customer.gender
                                                FROM customer, product, transaction
                                                WHERE customer.name = transaction.customerName AND product.productID = transaction.productID
                                            ) as cpt
                        GROUP BY cpt.pname
                        HAVING COUNT(CASE WHEN cpt.gender = 'Male' THEN 1 END) < COUNT(CASE WHEN cpt.gender = 'Female' THEN 1 END)";

            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
        ?>

        <h1>남자보다 여자가 많이 산 상품의 이름</h1>
        <div>
            <table>
                <tr>
                    <th>상품 이름</th>
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