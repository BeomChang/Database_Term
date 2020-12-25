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

            $server = "3.35.24.226:3306";
            $user = "test";
            $pass = "testtest";
            $dbname = "hw2";
            $conn = new mysqli($server, $user, $pass, $dbname);

            if(!$conn)
                die("<p class = 'error'>Connection failed: " . mysqli_connect_error() . "</p>");
            if(!($result = mysqli_query($conn, $query))) {
                print("<p class='error'>could not execute query!</p>");
                die(mysqli_error($database));
            }
            
            $query = "
            SELECT * FROM product
            WHERE productID = $pid 
            ";

            if($pname != "")
                $query = $query . "AND " . "name = '$pname' ";
            if($psuppliername != "")
                $query = $query . "AND supplierName = '$psuppliername'";
            
            // $result = mysqli_query($conn, $query);
            $result = mysqli_query($conn, $query);


            print($query);
            print($result[0]);
        ?>

        <h1>상품번호 <?php echo($pid)?> 검색결과</h1>
        <div>
            <table>
                    <tr>
                        <th>상품 번호</th>
                        <th>상품 이름</th>
                        <th>상품 공급 업자</th>
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