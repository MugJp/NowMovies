

<?php
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Fine Calculation</title>

</head>
<body style="background-color: #cccccc">

<div style="padding-top: 70px">
<h2>Fine informations</h2>

<?php


    $q=mysqli_query($db,"select a.ID_AMENDE,m.username,f.TITRE,a.returned,a.day,a.fine,a.statue from amende a 
        inner join membre m on m.ID_MEMBRE = a.ID_MEMBRE 
        INNER JOIN films f on f.ID_FILM = a.ID_FILM where username = '".$_SESSION['login_user']."' ORDER BY returned DESC ");


        echo "<table class='table table-bordered table-hover '>";
        echo "<thead >";
        echo "<tr>";
        //Table header
        echo "<th>"; echo "ID"; echo "</th>";
        echo "<th>"; echo "Member"; echo "</th>";
        echo "<th>"; echo "Movie Title"; echo "</th>";
        echo "<th>"; echo "Returned date"; echo "</th>";
        echo "<th>"; echo "Past days"; echo "</th>";
        echo "<th>"; echo "Fine"; echo "</th>";
        echo "<th>"; echo "Status"; echo "</th>";

        echo "</tr>";
        echo "</thead>";
        echo "<tbody '>";

        while($row=mysqli_fetch_assoc($q))
        {

            echo "<tr>";

            echo "<td>";echo $row['ID_AMENDE']; echo "</td>";
            echo "<td>";echo $row['username']; echo "</td>";
            echo "<td>";echo $row['TITRE']; echo "</td>";
            echo "<td>";echo $row['returned']; echo "</td>";
            echo "<td>";echo $row['day']; echo "</td>";
            echo "<td>";echo $row['fine']; echo "</td>";
            echo "<td>";echo $row['statue']; echo "</td>";

            echo "</tr>";

        }
        echo "</tbody>";
        echo "</table>";



?>

</div>
</body>
</html>

