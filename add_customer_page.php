<?php
    if(!$_SERVER["REQUEST_METHOD"] == "POST") {
        echo("<p>POST Error!</p></body></html>");
        die();
    }
    else {
        $cname = isset($_POST["cname"]) ? $_POST["cname"] : "";
        $cphone = isset($_POST["cphone"]) ? $_POST["cphone"] : "";
        $caddress = isset($_POST["caddress"]) ? $_POST["caddress"] : "";
        $cgender = isset($_POST["cgender"]) ? $_POST["cgender"] : "";
    }

    $conn = mysqli_connect( '15.164.229.129', 'test', 'testtest', 'test', '3306');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $query = "INSERT INTO customer VALUES ('".$cname."', '".$cphone."', '".$caddress."', '".$cgender."')";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo("정상 입력 되었습니다!");
    }
    else {
        echo("입력 실패!!!");
    }

    mysqli_close($conn);
?>