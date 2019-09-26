

<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Memebers Info</title>

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


<h2>List Of Members</h2>

<?php


if(isset($_POST['submit']))
{
    $q=mysqli_query($db,"select id_membre,first,last,address,tel,email,username from `membre` where last like '%$_POST[search]%' ");

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
                    echo "<th>"; echo "First Name"; echo "</th>";
                    echo "<th>"; echo "Last Name"; echo "</th>";
                    echo "<th>"; echo "Address"; echo "</th>";
                    echo "<th>"; echo "Contact"; echo "</th>";
                    echo "<th>"; echo "Email"; echo "</th>";
                    echo "<th>"; echo "Username"; echo "</th>";
                    echo "<th>"; echo "Action"; echo "</th>";

        echo "</tr>";
            echo "</thead>";
        echo "<tbody '>";

        while($row=mysqli_fetch_assoc($q))
        {

            echo "<tr>";

            echo "<td>";echo $row['id_membre']; echo "</td>";
            echo "<td>";echo $row['first']; echo "</td>";
            echo "<td>";echo $row['last']; echo "</td>";
            echo "<td>";echo $row['address']; echo "</td>";
            echo "<td>";echo $row['tel']; echo "</td>";
            echo "<td>";echo $row['email']; echo "</td>";
            echo "<td>";echo $row['username']; echo "</td>";
            echo "<td class='text-center'>
                <a class='btn btn-info btn-xs' href=''>
                    Ban
                </a> </td>";
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

    $res=mysqli_query($db,"select id_membre,first,last,address,tel,email,username from `membre`ORDER BY `membre`.`first` ASC ");


    echo "<table class='table table-bordered table-hover '>";
            echo "<thead >";
                    echo "<tr>";
                            //Table header
                            echo "<th>"; echo "ID"; echo "</th>";
                            echo "<th>"; echo "First Name"; echo "</th>";
                            echo "<th>"; echo "Last Name"; echo "</th>";
                            echo "<th>"; echo "Address"; echo "</th>";
                            echo "<th>"; echo "Contact"; echo "</th>";
                            echo "<th>"; echo "Email"; echo "</th>";
                            echo "<th>"; echo "Username"; echo "</th>";
                            echo "<th>"; echo "Action"; echo "</th>";

    echo "</tr>";
            echo "</thead>";
    echo "<tbody '>";
    while($row=mysqli_fetch_assoc($res))
    {

        echo "<tr>";

        echo "<td>";echo $row['id_membre']; echo "</td>";
        echo "<td>";echo $row['first']; echo "</td>";
        echo "<td>";echo $row['last']; echo "</td>";
        echo "<td>";echo $row['address']; echo "</td>";
        echo "<td>";echo $row['tel']; echo "</td>";
        echo "<td>";echo $row['email']; echo "</td>";
        echo "<td>";echo $row['username']; echo "</td>";
        echo "<td class='text-center'>
                <a class='btn btn-info btn-xs' href=''>
                    Ban
                </a> </td>";
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";

}





?>


</body>
</html>

