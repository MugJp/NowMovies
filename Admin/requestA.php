<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>


    <title>Movie Request</title>


</head>
<body style="background-color: #cccccc">
<br><br><br>
<h2>Requested Movies</h2>
<?php
if (isset($_SESSION['log_user'])) {


    $res = mysqli_query($db, "select m.username,f.ID_FILM,f.TITRE,f.STATUE,e.TARIF from emprunt e 
                                    INNER JOIN films f  on f.ID_FILM = e.ID_FILM 
                                    INNER JOIN membre m on m.ID_MEMBRE=e.ID_MEMBRE where e.valide is null order by f.TITRE ASC ;");
        if (mysqli_num_rows($res)==0){
            echo "No pending movies request";
        }
        else {

            echo "<table class='table table-bordered table-hover'>";
            echo "<thead >";
            echo "<tr>";
//Table header
            echo "<th>";
            echo "Membre";
            echo "</th>";
            echo "<th>";
            echo "Movie ID";
            echo "</th>";
            echo "<th>";
            echo "Titre";
            echo "</th>";
            echo "<th>";
            echo "Statue";
            echo "</th>";
            echo "<th>";
            echo "Tarif";
            echo "</th>";
            echo "<th>";
            echo "Action";
            echo "</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($res)) {

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
                echo $row['STATUE'];
                echo "</td>";
                echo "<td>";
                echo $row['TARIF'];
                echo "</td>";
                echo "<td class='text-center'> <a class='btn btn-info btn-xs' href='approve.php?id=".$row['ID_FILM']."&uname=".$row['username']."'>
                                         Approve
                                    </a></td>";

                echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";
        }
}
?>
</body>
</html>
