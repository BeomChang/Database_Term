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
            if(!$_SERVER["REQUEST_METHOD"] == "POST") {     // POST로 search_customer_page.php 에 넘어온 것이 아니라면
                echo("<p>POST Error!</p></body></html>");   // Error Message 출력
                die();                                      // Script Execution 종료
            }
            else {                                          // POST로 search_customer_page.php 에 넘어온 것이라면
                $cname = isset($_POST["cname"]) ? $_POST["cname"] : "";
                $cphone = isset($_POST["cphone"]) ? $_POST["cphone"] : "";
                $caddress = isset($_POST["caddress"]) ? $_POST["caddress"] : "";
                $cgender = isset($_POST["cgender"]) ? $_POST["cgender"] : "";
            }

            $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            // $query = "SELECT * FROM customer WHERE name = '".$cname."'";
            $query = "SELECT * FROM customer WHERE " . "name = '".$cname."'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            echo $row[0];
            echo "\n";
            echo $row[1];
            echo "\n";
            echo $row[2];
            echo "\n";
            echo $row[3];
            echo "\n";
        ?>
    </body>
</html>


<!-- 




//             $query = "
//             SELECT * FROM customer
//             WHERE name = '$cname'
//             ";

//             if(!$conn)
//                 die("<p class='error'>Connection failed: " . mysqli_connect_error() . "</p>");
            
//             if(!($result = mysqli_query($conn, $query))) {
//                 print("<p class='error'>could not execute query! : " . mysqli_error_list() . "</p>");
//                 die(mysqli_error($database));
//             }

//             if($cphone != "")
//                 $query = $query . "AND phone = '$cphone' ";
//             if($caddress != "")
//                 $query = $query . "AND ". "address = '$caddress' ";
//             if($cgender != "")
//                 $query = $query . "AND gender = '$cgender'";


//             print($query);
//             $result = mysqli_query($conn, $query);

//             mysqli_close($conn);
//         ?>

//         <h1>고객명 <?php echo($cname)?> 검색결과</h1>
//         <div>
//         <table>
//                     <tr>
//                         <th>고객 이름</th>
//                         <th>고객 전화번호</th>
//                         <th>고객 주소</th>
//                         <th>고객 성별</th>
//                     </tr>

//                     <?php
//                         for($counter = 0; $row = mysqli_fetch_row($result); ++$counter) {
//                             print("<tr>");
//                             foreach($row as $key => $value) {
//                                 print("<td>$value</td>");
//                             }
//                             print("</tr>");
//                         }
//                     ?>
//         </div>
//     </body>
// </html>
dsafsadf
sadfasdf-->