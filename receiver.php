<?php
    require "db_details.php";
    $error = false;
    if( isset($_POST['CODE']) && ($_POST['CODE']) != ""){
        $code = $_POST['CODE'];
        $re = mysqli_query($conn, "SELECT * FROM `urls` WHERE CODE = $code");
        $n = mysqli_num_rows($re);
        if($n == 0){
            $error = true;
        }
        else{
            $url = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `urls` WHERE CODE = $code"))['URL'];
            mysqli_query($conn,"DELETE FROM `urls` WHERE CODE = $code");
            echo "<script>location.href = '$url'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="link.ico">
    <title>URL Receiver</title>
    <style>
        body{
            font-family: sans-serif;
            font-size : 20px;
        }
        .center{
            margin:auto;
            text-align: center;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-70%);
            padding:min(5%,40px);
            border:1px solid black;
            border-radius:4%;
        }
        .getbutton{
            padding:10px;
            margin-top:10%;
            width:100%;
            font-weight: bold;
            font-size: large;
            background-color:lightblue;
            border:1px solid #333;
            transition: all ease-in 0.2s;
            border-radius:4px;
        }
        .getbutton:hover{
            background-color:turquoise;
            cursor: pointer;
        }
        .codeinput{
            height:45px;
            border: 1px solid grey;
            border-radius:4px;
            padding:5px;
            width:94%;
        }
        @media (max-width:600px){
            .center{
                margin:auto;
                text-align: center;
                position:absolute;
                top:50%;
                left:50%;
                width:60%;
                transform:translate(-50%,-70%);
                padding:min(5%,40px);
                border:1px solid black;
                border-radius:4%;
            }
        }
    </style>
</head>
<body>
    <div class = "center" >
        <form action='receiver.php' method='POST'>
            <h2>Enter Your Code</h2>
            <input type='number' name = 'CODE' class='codeinput' autocomplete = "off"><br>
            <input class='getbutton' type='submit' name='get' value='Get'>
            <?php if($error){echo "<p style='color : red'>Invalid Code</p>";} ?>
        </form>
    </div>
</body>
</html>