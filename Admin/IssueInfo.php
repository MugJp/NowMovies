<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>



    <title>Borrowed movies</title>

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
            width:10%;
        }
        /*.form_width{
            width: 500px;
            margin: 0 auto;
        }*/
    </style>


</head>
<body style="background-color: #cccccc">
<div style="padding-top: 70px" class="add_position">
    <h2>Borrowed movies info</h2><br>
    <?php
    $c=0;
        if(isset($_SESSION['log_user'])){
            $sql="select m.username,f.ID_FILM,f.TITRE,e.TARIF,e.DATEEMPRUNT,e.RETOURPREVU from emprunt e INNER JOIN 
                    films f on f.ID_FILM = e.ID_FILM INNER JOIN membre m on m.ID_MEMBRE=e.ID_MEMBRE 
                    where e.valide = 'yes' order by e.RETOURPREVU ASC";

            $res=mysqli_query($db,$sql);

            echo "<table class='table table-bordered table-hover' style='width: 100%'>";

            echo "<thead style='text-align: center' >";
            echo "<tr>";
//Table header
            echo "<th>";
            echo "Member";
            echo "</th>";
            echo "<th>";
            echo "Movie ID";
            echo "</th>";
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
            echo "Action";
            echo "</th>";
            echo "</tr>";
            echo "</thead>";
            echo "</table>";


            echo "<div class='scroll'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($res)) {
                $d=date("Y-m-d");
                if($d > $row['RETOURPREVU']){
                    $c=$c+1;
                    $var ='<p style="color: #ffff99; background-color: darkred">Expired</p>';

                    mysqli_query($db,"update emprunt set VALIDE = '$var' 
                                where RETOURPREVU='$row[RETOURPREVU]' and VALIDE = 'yes' limit $c;");
//                    echo $d. "</br>";
                }

                echo "<tr>";

                echo "<td>";
                echo $row['username'];
                echo "</td>";
                echo "<td>";
                echo $row['ID_FILM'];
                echo "</td>";
                echo "<td>";
                echo $row['TITRE'];
                echo "</td>";
                echo "<td>";
                echo $row['DATEEMPRUNT'];
                echo "</td>";
                echo "<td>";
                echo $row['RETOURPREVU'];
                echo "</td>";
                echo "<td class='text-center'>
                <a class='btn btn-info btn-xs' href=''>
                    Returned
                </a> </td>";
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