

<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Fine Calculation</title>

</head>
<body style="background-color: #cccccc">

<!-- __________________________________________SearchBar ___________________________________________________________ -->

<div class="search_item">

    <form class = "navbar-form" method="post" name="form1">


        <input class="form-control" type="text" name="search" placeholder="search member" required="" >

        <button type="submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>

    </form>

</div>

<!-- __________________________________________End SearchBar ___________________________________________________________ -->

<h2>Fine informations</h2>

<?php


if(isset($_POST['submit']))
{
    $q=mysqli_query($db,"select a.ID_AMENDE,m.username,f.TITRE,a.returned,a.day,a.fine,a.statue from amende a 
        inner join membre m on m.ID_MEMBRE = a.ID_MEMBRE 
        INNER JOIN films f on f.ID_FILM = a.ID_FILM where username like '%$_POST[search]%' ORDER BY returned DESC ");

    if(mysqli_num_rows($q)==0){
        echo "Sorry! Member not found.";
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
        echo "<br>&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
//                echo "<br><a class='glyphicon glyphicon-circle-arrow-left' href='movieA.php'></a>";
    }
    else {
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
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
        echo "&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
    }
}


/*______________________________________________IF BUTTON NOT PRESSED _______________________________________________*/
else{

    $res=mysqli_query($db,"select a.ID_AMENDE,m.username,f.TITRE,a.returned,a.day,a.fine,a.statue from amende a 
        inner join membre m on m.ID_MEMBRE = a.ID_MEMBRE 
        INNER JOIN films f on f.ID_FILM = a.ID_FILM ORDER BY returned DESC ");


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
    echo "<th>"; echo "Action"; echo "</th>";


    echo "</tr>";
    echo "</thead>";
    echo "<tbody '>";

    while($row=mysqli_fetch_assoc($res))
    {

        echo "<tr>";

        echo "<td>";echo $row['ID_AMENDE']; echo "</td>";
        echo "<td>";echo $row['username']; echo "</td>";
        echo "<td>";echo $row['TITRE']; echo "</td>";
        echo "<td>";echo $row['returned']; echo "</td>";
        echo "<td>";echo $row['day']; echo "</td>";
        echo "<td>";echo $row['fine']; echo "</td>";
        echo "<td>";echo $row['statue']; echo "</td>";
        echo "<td class='text-center'>
                <a class='btn btn-info btn-xs' href=''>
                    Change Status
                </a> </td>";
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";

}





?>


</body>
</html>

