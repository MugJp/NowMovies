<?php
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html>
<head>


    <title>Approve Request</title>
    <title>Expired List</title>

    <style type="text/css">
        .add_position{
            width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        .scroll{
            width: 100%;
            height: 300px;
            overflow: auto;

        }
        th{
            text-align: center;
        }
        th,td {
            width:12%;
        }
        /*.form_width{
            width: 500px;
            margin: 0 auto;
        }*/
    </style>


</head>
<body style="background-color: #cccccc">
<div style="padding-top: 100px" class="add_position">



    <h2>Expired return movies  List</h2><br>
    <!--
    <form action="" method="post">
        <button class="btn btn-default" style="background-color: darkgreen;color: #ffff99;" name="submit1">Returned</button>
        <button class="btn btn-default" style="color: #ffff99; background-color: darkred;" name="submit2">Expired</button><br>
    </form>-->
    <div style="float: right;padding-top: 20px;">
        <?php
        $var=0;

            $result = mysqli_query($db, " select * from amende where ID_MEMBRE = (select ID_MEMBRE from membre
                    where username = '".$_SESSION['login_user']."') and statue = 'not paid';");

        while ($r= mysqli_fetch_assoc($result)){

                $var = $var+$r['fine'];
            }
            $var2= $var+$_SESSION['fine'];
        ?>
        <h4>Your fine is:
        <?php

                echo "€ ".$var2;
        ?>
        </h4>
    </div>
    <?php
    echo "<br>";
    if(isset($_SESSION['login_user'])){
        $ret ='<p style="color: #ffff99; background-color: darkgreen">Returned</p>';
        $exp ='<p style="color: #ffff99; background-color: darkred">Expired</p>';


        if(isset($_POST['submit1'])){

            $sql="select m.username,f.ID_FILM,f.TITRE,e.DATEEMPRUNT,e.RETOURPREVU,e.VALIDE from emprunt e INNER JOIN 
                    films f on f.ID_FILM = e.ID_FILM INNER JOIN membre m on m.ID_MEMBRE=e.ID_MEMBRE 
                    where e.valide = '$ret' and e.ID_MEMBRE = (select ID_MEMBRE from membre
                    where username = '".$_SESSION['login_user']."')  order by e.RETOURPREVU DESC";
            $res=mysqli_query($db,$sql);
        }
        elseif (isset($_POST['submit2'])) {
            $sql="select m.username,f.ID_FILM,f.TITRE,e.DATEEMPRUNT,e.RETOURPREVU,e.VALIDE from emprunt e INNER JOIN 
                    films f on f.ID_FILM = e.ID_FILM INNER JOIN membre m on m.ID_MEMBRE=e.ID_MEMBRE 
                    where e.valide = '$exp' and e.ID_MEMBRE = (select ID_MEMBRE from membre
                    where username = '".$_SESSION['login_user']."') order by e.RETOURPREVU DESC";
            $res=mysqli_query($db,$sql);
        }
        else {
            $sql="select m.username,f.ID_FILM,f.TITRE,e.DATEEMPRUNT,e.RETOURPREVU,e.VALIDE from emprunt e INNER JOIN 
                    films f on f.ID_FILM = e.ID_FILM INNER JOIN membre m on m.ID_MEMBRE=e.ID_MEMBRE 
                    where e.valide != '' and e.valide != 'yes' and e.ID_MEMBRE = (select ID_MEMBRE from membre
                    where username = '".$_SESSION['login_user']."') order by e.RETOURPREVU DESC";
            $res=mysqli_query($db,$sql);
        }


        echo "<table class='table table-bordered table-hover' style='width: 100%'>";

        echo "<thead style='text-align: center' >";
        echo "<tr>";
//Table header
        /*echo "<th>";
        echo "Member";
        echo "</th>";
        echo "<th>";
        echo "Movie ID";
        echo "</th>";*/
        echo "<th>";
        echo "Title";
        echo "</th>";

        echo "<th>";
        echo "Issue Date";
        echo "</th>";
        echo "<th>";
        echo "Return Date";
        echo "</th>";
        echo "<th>";
        echo "Approve";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "</table>";


        echo "<div class='scroll'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($res)) {


            echo "<tr>";

            /*echo "<td>";
            echo $row['username'];
            echo "</td>";
            echo "<td>";
            echo $row['ID_FILM'];
            echo "</td>";*/
            echo "<td>";
            echo $row['TITRE'];
            echo "</td>";
            echo "<td>";
            echo $row['DATEEMPRUNT'];
            echo "</td>";
            echo "<td>";
            echo $row['RETOURPREVU'];
            echo "</td>";
            echo "<td>";
            echo $row['VALIDE'];
            echo "</td>";


            echo "</tr>";

        }
        echo "</tbody>";

        echo "</table>";
        echo "</div>";
    }
    ?>

</div>
</body>
</html>