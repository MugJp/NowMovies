<?php
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Movies</title>

    <style type="text/css">
        div.container{
            position: relative;
            top: -100px;
            width: 980px;
            height: 150px;
            /*background-color: yellow;*/
            float: left;
            padding-top: 0px;
        }
    </style>

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
-->
</head>
<body style="background-color: #cccccc">



<!-- __________________________________________SearchBar ___________________________________________________________ -->


        <div class="search_item">


            <form class="form-inline md-form mr-auto mb-4" method="post">
                <input class="form-control mr-sm-2" type="text" placeholder="movie title" aria-label="Search" name="research">
                <button class="btn btn-outline-primary waves-effect btn-sm my-0" type="submit" name="soumis">
                    <i class="fas fa-search" ></i>
                </button>

                <input class="form-control mr-sm-2" type="text" placeholder="genre" aria-label="Search" name="">
                <button class="btn btn-outline-primary waves-effect btn-sm my-0" type="submit" name="">
                    <i class="fas fa-search" ></i>
                </button>

                <input class="form-control mr-sm-2" type="text" placeholder="actor" aria-label="Search" name="">
                <button class="btn btn-outline-primary waves-effect btn-sm my-0" type="submit" name="">
                    <i class="fas fa-search" ></i>
                </button>

                <input class="form-control mr-sm-2" type="text" placeholder="director" aria-label="Search" name="">
                <button class="btn btn-outline-primary waves-effect btn-sm my-0" type="submit" name="">
                    <i class="fas fa-search" ></i>
                </button>
            </form>
        </div>

<!--____________________________________________________End SEARCH____________________________________________________________-->

<div class="container">
    <div class="row">

<?php

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 4;

$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

//Get number of pages for pagination
$result_count = mysqli_query($db, "SELECT COUNT(*) As total_records FROM `films`");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1

if (isset($_SESSION['login_user'])) {

    if (isset($_POST['soumis'])) {
        $q = mysqli_query($db, "select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE
                                    ,f.QUANTITE, f.STATUE,f.pic, f.DESCRIPTION from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON  where TITRE like '%$_POST[research]%' order by f.TITRE ASC ");

        if (mysqli_num_rows($q) === 0) {
            echo "Sorry! We don't have this movie.";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<br>&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
//                echo "<br><a class='glyphicon glyphicon-circle-arrow-left' href='movieA.php'></a>";
        } else {



            while ($row = mysqli_fetch_assoc($q)) {

                ?>

                <div >

                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/<?php echo $row["pic"]; ?>" alt="" width="203px" height="305px"/>
                                <P><?php echo $row["TITRE"]; ?></P>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view-<?php echo $row["ID_FILM"]; ?>">
                                    View
                                </button>
                            </div>

                            <!-- Modal -->

                            <div class="modal fade" id="view-<?php echo $row["ID_FILM"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <?php
                                $f_actor = mysqli_query($db, "select a.NOM,a.PRENOM,j.ID_FILM from jouer j
                            INNER JOIN films f  on j.ID_FILM = f.ID_FILM
                            INNER JOIN acteur a  on j.ID_ACTEUR = a.ID_ACTEUR  where j.ID_FILM = '$row[ID_FILM]' order by a.PRENOM ASC ;");

                                $f_directors = mysqli_query($db, "select r.NOM,r.PRENOM,m.ID_FILM from mettre_en_scene m
                            INNER JOIN films f  on m.ID_FILM = f.ID_FILM
                            INNER JOIN realisateur r on m.ID_REALISATEUR = r.ID_REALISATEUR where m.ID_FILM = '$row[ID_FILM]' order by r.PRENOM ASC ;");

                                $f_genre = mysqli_query($db, "select g.DENOMINATION,c.ID_FILM from classer c
                            INNER JOIN films f  on c.ID_FILM = f.ID_FILM
                            INNER JOIN  genre g   on c.ID_GENRE = g.ID_GENRE  where c.ID_FILM = '$row[ID_FILM]' order by g.DENOMINATION ASC ;");
                                ?>
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $row["TITRE"]; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $row["DESCRIPTION"]; ?></p>
                                            <p><?php echo "<b>"; echo $row["STATUE"]; echo "</b>"; ?></p>
                                            <p><b>Runtime: </b><?php echo $row["DUREE"]; ?> min</p>
                                            <p><b>Actors: </b><?php while ($r_actor = mysqli_fetch_assoc($f_actor)){
                                                    $s_actor= "$r_actor[PRENOM] $r_actor[NOM],";
                                                    echo rtrim($s_actor,","); } ?> </p>

                                            <p><b>Directors: </b><?php while ($r_director = mysqli_fetch_assoc($f_directors)){
                                                    $s_director= "$r_director[PRENOM] $r_director[NOM],";
                                                    echo rtrim($s_director,","); } ?> </p>

                                            <p><b>Genre: </b><?php $s_genre=''; while ($r_genre = mysqli_fetch_assoc($f_genre)){
                                                    $s_genre.= ".$r_genre[DENOMINATION],";
                                                    if($s_genre=='')
                                                        $s_genre=$r_genre['DENOMINATION'];
                                                    else
                                                        $s_genre.=','.$r_genre['DENOMINATION'];
                                                } echo $s_genre ; ?> </p>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <?php echo "<a  class='btn btn-primary' href='command.php?id=".$row['ID_FILM']."'>Borrow</a>"?>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>


                    </div>
                </div>

                <?php
            }

            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
        }
    } /*______________________________________________IF BUTTON NOT PRESSED _______________________________________________*/
    else {

        $res = mysqli_query($db, "select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE
                                    ,f.QUANTITE, f.STATUE,f.pic, f.DESCRIPTION, f.prix_loc, f.prix_ach from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON  order by f.TITRE ASC LIMIT $offset, $total_records_per_page ;");


       while ($row = mysqli_fetch_assoc($res))

        {

        ?>
            <div class="col-sm-3">

                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/<?php echo $row["pic"]; ?>" alt="" width="203px" height="305px"/>
                            <P><?php echo $row["TITRE"]; ?></P>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view-<?php echo $row["ID_FILM"]; ?>">
                                View
                            </button>
                        </div>

                        <!-- Modal -->

                        <div class="modal fade" id="view-<?php echo $row["ID_FILM"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <?php
                            $f_actor = mysqli_query($db, "select a.NOM,a.PRENOM,j.ID_FILM from jouer j
                            INNER JOIN films f  on j.ID_FILM = f.ID_FILM
                            INNER JOIN acteur a  on j.ID_ACTEUR = a.ID_ACTEUR  where j.ID_FILM = '$row[ID_FILM]' order by a.PRENOM ASC ;");

                            $f_directors = mysqli_query($db, "select r.NOM,r.PRENOM,m.ID_FILM from mettre_en_scene m
                            INNER JOIN films f  on m.ID_FILM = f.ID_FILM
                            INNER JOIN realisateur r on m.ID_REALISATEUR = r.ID_REALISATEUR where m.ID_FILM = '$row[ID_FILM]' order by r.PRENOM ASC ;");

                            $f_genre = mysqli_query($db, "select g.DENOMINATION,c.ID_FILM from classer c
                            INNER JOIN films f  on c.ID_FILM = f.ID_FILM
                            INNER JOIN  genre g   on c.ID_GENRE = g.ID_GENRE  where c.ID_FILM = '$row[ID_FILM]' order by g.DENOMINATION ASC ;");
                            ?>
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row["TITRE"]; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo $row["DESCRIPTION"]; ?></p>
                                        <p><?php echo "<b>"; echo $row["STATUE"]; echo "</b>"; ?></p>
                                        <p><b>Prix Achat: </b><?php echo $row["prix_ach"]; ?> €</p>
                                        <p><b>Prix Location: </b><?php echo $row["prix_loc"]; ?> €</p>
                                        <p><b>Runtime: </b><?php echo $row["DUREE"]; ?> min</p>
                                        <p><b>Actors: </b><?php while ($r_actor = mysqli_fetch_assoc($f_actor)){
                                            echo $r_actor["PRENOM"], " ", $r_actor["NOM"], ","," "; } ?> </p>

                                        <p><b>Directors: </b><?php while ($r_director = mysqli_fetch_assoc($f_directors)){
                                                echo $r_director["PRENOM"], " ", $r_director["NOM"], ","," "; } ?> </p>

                                        <p><b>Genre: </b><?php while ($r_genre = mysqli_fetch_assoc($f_genre)){
                                                echo $r_genre["DENOMINATION"], ",", " "; } ?> </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Buy</button>
                                       <?php echo "<a  class='btn btn-primary' href='command.php?id=".$row['ID_FILM']."'>Borrow</a>"?>
                                    </div>
                                </div>
                            </div>

                        </div>


                        </div>


                    </div>
                </div>

                <?php

        }
        ?>
        <!--<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
            <strong>Page <?php /*echo $page_no." of ".$total_no_of_pages; */?></strong>
        </div>-->
        <ul class="pagination pg-blue">
            <?php if($page_no > 1){
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>First Page</a></li>";
            } ?>

            <li class="page-item" <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                <a class="page-link" <?php if($page_no > 1){
                    echo "href='?page_no=$previous_page'";
                } ?>>Previous</a>
            </li>

            <?php
            if ($total_no_of_pages <= 10){
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                if ($counter == $page_no) {
                    echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                    }else{
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }elseif ($total_no_of_pages > 10){
                if($page_no <= 4) {
                    for ($counter = 1; $counter < 8; $counter++){
                        if ($counter == $page_no) {
                            echo "<li class='active page-item'><a>$counter</a></li>";
                        }else{
                            echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                }
                elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    for (
                        $counter = $page_no - $adjacents;
                        $counter <= $page_no + $adjacents;
                        $counter++
                    ) {
                        if ($counter == $page_no) {
                            echo "<li  class='active page-item'><a class='page-link'>$counter</a></li>";
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                }
                else {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                    for (
                        $counter = $total_no_of_pages - 6;
                        $counter <= $total_no_of_pages;
                        $counter++
                    ) {
                        if ($counter == $page_no) {
                            echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                }


            }
            ?>

            <li class="page-item" <?php if($page_no >= $total_no_of_pages){
                echo "class='disabled'";
            } ?>>
                <a class="page-link" <?php if($page_no < $total_no_of_pages) {
                    echo "href='?page_no=$next_page'";
                } ?>>Next</a>
            </li>

            <?php if($page_no < $total_no_of_pages){
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
            } ?>
        </ul>
<?php

    }
/*_________________________________________________If SESSION NOT STARTED________________________________________________*/

} else {
    if (isset($_POST['soumis'])) {
        $a = mysqli_query($db, "select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE, f.PRIX,f.QUANTITE
                    from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON where TITRE like '%$_POST[research]%' ");

        if (mysqli_num_rows($q) == 0) {
            echo "Sorry! We don't have this movie.";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<br>&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
//                echo "<br><a class='glyphicon glyphicon-circle-arrow-left' href='movieA.php'></a>";
        } else {
            echo "<table class='table table-bordered table-hover table-fixed'>";
            echo "<thead >";
            echo "<tr>";
            //Table header
            echo "<th>";
            echo "Rayon";
            echo "</th>";
            echo "<th>";
            echo "Titre";
            echo "</th>";
            echo "<th>";
            echo "Durée";
            echo "</th>";
            echo "<th>";
            echo "Date Sorti";
            echo "</th>";
            echo "<th>";
            echo "Prix";
            echo "</th>";
            echo "<th>";
            echo "Quantité";
            echo "</th>";


            echo "</tr>";
            echo "</thead>";
            echo "<tbody '>";

            while ($row = mysqli_fetch_assoc($a)) {

                echo "<tr>";


                echo "<td>";
                echo $row['APPELATION'];
                echo "</td>";
                echo "<td>";
                echo $row['TITRE'];
                echo "</td>";
                echo "<td>";
                echo $row['DUREE'];
                echo "</td>";
                echo "<td>";
                echo $row['ANNEESORTIE'];
                echo "</td>";
                echo "<td>";
                echo $row['PRIX'];
                echo "</td>";
                echo "<td>";
                echo $row['QUANTITE'];
                echo "</td>";

                echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "&nbsp;<a class='fa fa-arrow-circle-o-left' style='font-size:36px; color: black; text-decoration: none' href='$url'></a>";
        }
    } /*______________________________________________IF BUTTON NOT PRESSED _______________________________________________*/
    else {

        $b = mysqli_query($db, "select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE,
                                        f.PRIX,f.QUANTITE from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON order by f.TITRE ASC ;");

        echo "<table class='table table-bordered table-hover table-fixed'>";
        echo "<thead >";
        echo "<tr>";
        //Table header
        echo "<th>";
        echo "Rayon";
        echo "</th>";
        echo "<th>";
        echo "Titre";
        echo "</th>";
        echo "<th>";
        echo "Durée";
        echo "</th>";
        echo "<th>";
        echo "Date Sorti";
        echo "</th>";
        echo "<th>";
        echo "Prix";
        echo "</th>";
        echo "<th>";
        echo "Quantité";
        echo "</th>";


        echo "</tr>";
        echo "</thead>";
        echo "<tbody '>";

        while ($row = mysqli_fetch_assoc($b)) {

            echo "<tr>";


            echo "<td>";
            echo $row['APPELATION'];
            echo "</td>";
            echo "<td>";
            echo $row['TITRE'];
            echo "</td>";
            echo "<td>";
            echo $row['DUREE'];
            echo "</td>";
            echo "<td>";
            echo $row['ANNEESORTIE'];
            echo "</td>";
            echo "<td>";
            echo $row['PRIX'];
            echo "</td>";
            echo "<td>";
            echo $row['QUANTITE'];
            echo "</td>";

            echo "</tr>";

        }
        echo "</tbody>";
        echo "</table>";

    }

}


?>
    </div>
</div>


</body>
</html>

