<?php
    session_start();
    require "db_details.php";
    if( isset($_POST['URL']) && ($_POST['URL']) != "" && !isset($_SESSION['CODE'])){
        $url = $_POST['URL'];
        $code = rand(0,99999);
        while(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `urls` WHERE CODE = $code")) != 0){
            $code = rand(0,99999);
        }
        $_SESSION['CODE'] = $code;
        mysqli_query($conn,"INSERT INTO `urls`(`CODE`, `URL`) VALUES ($code,'$url')");
    }
    if(isset($_SESSION['CODE'])){
        $code = $_SESSION['CODE'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="link.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Sender</title>
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
        .sendbutton{
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
        .sendbutton:hover{
            background-color:turquoise;
            cursor: pointer;
        }
        .urlinput{
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
        <?php
            if(!(isset($_POST['URL']) && ($_POST['URL']) != "")){
                echo "<form action='sender.php' method='POST'>
                <h2>Enter Your URL</h2>
                <input type='url' name = 'URL' class='urlinput'  autocomplete = 'off' ><br>
                <input class='sendbutton' type='submit' name='send' value='Send'>
            </form>";
            }
            else{
                echo "<h1>Code</h1>
                <h2>$code</h2>
                <p>Enter the above code in the receiving device</p>";
            }

        ?>
        
    </div>
</body>
</html>