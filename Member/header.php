<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">



    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">


</head>
<body class="hidden-sn mdb-skin">

<header>
    <?php
    if (isset($_SESSION['login_user'])){
    ?>

<!--_________________________________________SideNav___________________________________________________________________________________                -->
<!--                <div id="slide-out" class="side-nav sn-bg-4">-->
<!--                    <ul class="custom-scrollbar">-->
<!--                      Profile img -->
<!--                        <li>-->
<!--                            <div class="logo-wrapper waves-light">-->
<!---->
<!--                                --><?php
///*                                if(isset($_SESSION['login_user'])) {
//
//                                    echo "<img class='rounded-circle ' class='img-fluid flex-center' alt = 120x120 src='images/" . $_SESSION['pic'] . "'  data-holder-rendered='true'>";
//                                    echo "<br>";
//                                    echo "Welcome " . $_SESSION['login_user'];
//                                }
//                                */?>
<!---->
<!--                            </div>-->
<!--                        </li>-->
<!---->
<!--                        <li><a href="profil.php">Profile</a></li>-->
<!--                        <li><a href="request.php">Movie Request</a></li>-->
<!---->
<!--                    </ul>-->
<!--                </div>-->
<!---->
<!---->
<!---->
<!---->
<!---->


<!--______________________________________________________________Fin SideNAv________________________________________________________________-->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">
                        <div style="color: white; font-weight: bold">
                            <?php
                            echo "<img class='rounded-circle' height=30 width=30 src='images/".$_SESSION['pic']."'>";
                            echo " ".$_SESSION['login_user'];
                            ?>
                        </div>
                        <span class="clearfix d-none d-sm-inline-block"></span>
                    </a>
                </li>
                <li class="nav-item"><a href="" class="nav-link"><i class="far fa-comments"></i> <span class="clearfix d-none d-sm-inline-block"><b>FeedBack</b></span></a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope" ></i> <span class="clearfix d-none d-sm-inline-block"><b>Contact</b></span></a></li>
            </ul>
        </div>
        <!-- Breadcrumb-->
       <div class="breadcrumb-dn mr-auto"></div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

            <li class="nav-item"><a class="nav-link" href="movie.php"><i class="fa fa-film" ></i> <span class="clearfix d-none d-sm-inline-block"><b>Movies</b></span></a></li>
            <li class="nav-item"><a class="nav-link" href="Expired.php"><i class="far fa-money-bill-alt"></i><span class="clearfix d-none d-sm-inline-block"><b>Fine</b></span></a></li>
            <li class="nav-item"><a class="nav-link" href="borrowed.php"><i class="far fa-calendar-alt"></i><span class="clearfix d-none d-sm-inline-block"><b>Borrowed</b></span></a></li>

            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="clearfix d-none d-sm-inline-block"><b>Log Out</b></span></a></li>
        </ul>
    </nav>
        <?php
        }
        /*________________________________________USER NOT LOGGED____________________________________________________________*/
else {
?>
    <div class="container-fluid">

    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">

                <div class="navbar-header">
                    <a class="navbar-brand active" href="index.php">
                        <img alt="" src="images/Logo.png" width="35" height="35">
                    </a>
                </div>

            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><b>Home</b></span></a></li>
                <li class="nav-item"><a class="nav-link" href="registration.php"><i class="fa fa-user-plus" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><b>SignUp</b></span></a></li>
                <li class="nav-item"><a class="nav-link" href="movie.php"><i class="fa fa-film" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><b>Movies</b></span></a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope" aria-hidden="true"></i> <span class="clearfix d-none d-sm-inline-block"><b>Contact</b></span></a></li>

            </ul>
            <?php
                }
            ?>
    </nav>
        </div>

</header>

<?php
include "connection.php";

if (isset($_SESSION['login_user'])){
    $exp ='<p style="color: #ffff99; background-color: darkred">Expired</p>';
    $day=0;
    $res = mysqli_query($db,"select RETOURPREVU from emprunt where ID_MEMBRE = (select ID_MEMBRE from membre
         where username = '".$_SESSION['login_user']."') and VALIDE = '$exp' ;");
while ($row = mysqli_fetch_assoc($res)) {
    $d= strtotime($row['RETOURPREVU']);
    $c= strtotime(date("Y-m-d"));
// Si la date du jour est plus grande que la da retour prevu, alors la date a expiré?
   $diff= $c-$d;

    if($diff>=0) {
        $day= $day+floor($diff / (60 * 60 * 24)); // jours


    }
}
    $_SESSION['fine'] = $day*1;

}
?>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!--<script type="text/javascript">

    // SideNav Button Initialization
    $(".button-collapse").sideNav();
    // SideNav Scrollbar Initialization
    var sideNavScrollbar = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(sideNavScrollbar);
    }

</script>-->


</body>
</html>
