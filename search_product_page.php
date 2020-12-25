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
            $opt_cnt = 0;
            if(!$_SERVER["REQUEST_METHOD"] == "POST") {
                echo("<p>POST Error!</p></body></html>");
                die();
            }
            else {
                if(isset($_POST["pname"])) {
                    $opt_cnt++;
                    $pname = $_POST["pname"];
                }
                else {
                    $pname = "";
                }

                if(isset($_POST["pid"])) {
                    $opt_cnt++;
                    $pid = $_POST["pid"];
                }
                else {
                    $pid = "";
                }

                if(isset($_POST["psuppliername"])) {
                    $opt_cnt++;
                    $psuppliername = $_POST["psuppliername"];
                }
                else {
                    $psuppliername = "";
                }
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            // $query = "SELECT * FROM product WHERE productID = '".$pid."'";
            $query = "SELECT * FROM product ";
            if($opt_cnt > 0)
                $query = $query . "WHERE ";

            $parameter = array (
                'name' => $pname,
                'productID' => $pid,
                'supplierName' => $psuppliername
            );

            foreach($parameter as $key => $value) {
                if($value != "") {
                    $query = $query . "$key = '".$value."'";
                    $opt_cnt--;
                }
                
                if($opt_cnt != 0)
                    $query = $query . "AND ";
            }


            // if($pid != "")
            //     $query = $query . "pid = '".$pname."'";
            // if($pname != "")
            //     $query = $query . "AND name = '".$pname."'";
            // if($psuppliername != "")
            //     $query = $query . "AND " . "supplierName = '".$psuppliername."'";

            print($query);

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