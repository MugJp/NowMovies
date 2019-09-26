<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Movies</title>



</head>
<body style="background-color: #cccccc">


<!-- __________________________________________SearchBar ___________________________________________________________ -->

<div class="search_item">

    <form class = "navbar-form" method="post" name="form1">


            <input class="form-control" type="text" name="search" placeholder="search movies" required="" >

             <button type="submit" name="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
             </button>

    </form>

</div>


<h2>List Of Movies</h2>

<?php


        if(isset($_POST['submit']))
        {
            $q=mysqli_query($db,"select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE,f.QUANTITE
                    from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON where TITRE like '%$_POST[search]%' ");

            if(mysqli_num_rows($q)==0){
                echo "Sorry! We don't have this movie.";
                $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                echo "<br>&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
//                echo "<br><a class='glyphicon glyphicon-circle-arrow-left' href='movieA.php'></a>";
            }
            else {
                echo "<table class='table table-bordered table-hover '>";
                    echo "<thead >";
                     echo "<tr>";
                        echo "<th>"; echo "ID"; echo "</th>";
                        echo "<th>"; echo "Rayon"; echo "</th>";
                        echo "<th>"; echo "Titre"; echo "</th>";
                        echo "<th>"; echo "Durée"; echo "</th>";
                        echo "<th>"; echo "Date Sorti"; echo "</th>";
                        echo "<th>"; echo "Quantité"; echo "</th>";
                        echo "<th>"; echo "Actions"; echo "</th>";

                echo "</tr>";
                    echo "</thead>";
                echo "<tbody>";

                while($row=mysqli_fetch_assoc($q))
                {

                    echo "<tr>";

                            echo "<td>";echo $row['ID_FILM']; echo "</td>";

                            echo "<td>";echo $row['APPELATION']; echo "</td>";
                            echo "<td>";echo $row['TITRE']; echo "</td>";
                            echo "<td>";echo $row['DUREE']; echo "</td>";
                            echo "<td>";echo $row['ANNEESORTIE']; echo "</td>";
                            echo "<td>";echo $row['QUANTITE']; echo "</td>";
                            echo "<td class='text-center'>
                                    <a class='btn btn-info btn-xs' href=''>
                                        <span class='glyphicon glyphicon-edit'></span> Edit
                                    </a>
                                    <a class='btn btn-info btn-xs' href=''>
                                        <span class='glyphicon glyphicon-eye-open'></span> View
                                    </a>
                                    <a class='btn btn-danger btn-xs' href='delete.php?del=".$row['ID_FILM']."'>
                                        <span class='glyphicon glyphicon-remove'></span> Del
                                    </a>
        
                        
                            </td>";

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

            $res = mysqli_query($db, "select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE
                                        ,f.QUANTITE, f.prix_ach, f.prix_loc from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON order by f.TITRE ASC ;");

            echo "<table class='table table-bordered table-hover '>";
            echo "<thead >";
            echo "<tr>";
            //Table header
            echo "<th>"; echo "ID"; echo "</th>";

            echo "<th>"; echo "Rayon"; echo "</th>";
            echo "<th>"; echo "Titre"; echo "</th>";
            echo "<th>"; echo "Durée"; echo "</th>";
            echo "<th>"; echo "Date Sorti"; echo "</th>";
            echo "<th>"; echo "Prix d'achat"; echo "</th>";
            echo "<th>"; echo "Prix de location"; echo "</th>";
            echo "<th>"; echo "Quantité"; echo "</th>";
            echo "<th>"; echo "Actions"; echo "</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row=mysqli_fetch_assoc($res))
            {

                echo "<tr>";

                echo "<td>";echo $row['ID_FILM']; echo "</td>";
                echo "<td>";echo $row['APPELATION']; echo "</td>";
                echo "<td>";echo $row['TITRE']; echo "</td>";
                echo "<td>";echo $row['DUREE']; echo "</td>";
                echo "<td>";echo $row['ANNEESORTIE']; echo "</td>";
                echo "<td>";echo $row['prix_ach']; echo "</td>";
                echo "<td>";echo $row['prix_loc']; echo "</td>";
                echo "<td>";echo $row['QUANTITE']; echo "</td>";
                echo "<td class='text-center'>
                <a class='btn btn-info btn-xs' href=''>
                    <span class='glyphicon glyphicon-edit'></span> Edit
                </a>
                <a class='btn btn-info btn-xs' href=''>
                    <span class='glyphicon glyphicon-eye-open'></span> View
                </a>
                <a class='btn btn-danger btn-xs' href='delete.php?del=".$row['ID_FILM']."'>
                    <span class='glyphicon glyphicon-remove'></span> Del
                </a>

                
                </td>";

                echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";

        }





?>

</div>
</body>
</html>

