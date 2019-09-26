<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php header('Content-Type: text/html; charset=UTF-8'); ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styleA.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
       /* body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }*/

        .sidenav{
            height: 100%;
            margin-top: 59px ;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            text-align: center;
        }

        .sidenav a {
            padding: 8px 8px 8px 8px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            text-decoration: none;
            color: white;
            background-color: darkkhaki;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>-->


</head>
<body>

<nav class="navbar navbar-Inverse navbar-fixed-top" style="background-color: rgba(0, 0, 0, 0.5); position: fixed">

        <?php
        if (isset($_SESSION['log_user'])){
        ?>
            <ul class="nav navbar-nav">
            <li>
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div style="color: white; font-weight: bold; margin-left: 8px ">

                        <?php
                        if(isset($_SESSION['log_user'])) {

                            echo "<img class='img-circle profile_img' height=120 width=120 src='images/" . $_SESSION['pix'] . "'>";
                            echo "<br>";
                            echo "Welcome " . $_SESSION['log_user'];
                        }
                        ?>

                    </div>

                    <a href="add.php">Add movie</a>
                    <a href="requestA.php">Movie Request</a>
                    <a href="IssueInfo.php">Borrowed Movies</a>
                    <a href="Expired.php">Expired List</a>

                </div>

                <div id="main">
                    <span style="font-size:15px;cursor:pointer;color: white; font-weight: bold" onclick="openNav()">&#9776; Open</span>


                    <script>
                        function openNav() {
                            document.getElementById("mySidenav").style.width = "250px";
                            document.getElementById("main").style.marginLeft = "250px";
                            // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
                        }

                        function closeNav() {
                            document.getElementById("mySidenav").style.width = "0";
                            document.getElementById("main").style.marginLeft= "0";
                            // document.body.style.backgroundColor = "white";
                        }
                    </script>
                </div>
            </li>

            </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="margin-top: -2px">
                <a href="profilA.php">
                    <div style="color: white; font-weight: bold">
                        <?php
                        echo "<img class='img-circle profile_img' height=30 width=30 src='images/".$_SESSION['pix']."'>";
                        echo " ".$_SESSION['log_user'];
                        ?>
                    </div>
                </a>
            </li>

                <li><a style="" href="movieA.php"><b>Movies</b></a></li>
                <li><a href="memberA.php"><b>Members Information</b></a></li>
            <li><a href="memberFine.php"><b>Members Fine</b></a></li>



            <li><a href="logoutA.php"><span class="glyphicon glyphicon-log-out" ><b> Log Out &nbsp;</b></span></a></li>
        </ul>
        <?php
        }
        else {
        ?>

    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand active" href="indexA.php">
                <img src="images/Logo.png" width="35" height="35">
            </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="indexA.php"><b>Home</b></a></li>
            <li><a  class="glyphicon glyphicon-edit" href="registrationA.php"><b> Sign Up</b></a></li>
            <li><a href="movieA.php"><b>Movies</b></a></li>
            <li><a href="contact.php"><b>Contact</b></a></li>

        </ul>
        <?php
        }
        ?>



    </div>
</nav>


</body>
</html>
