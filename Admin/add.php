<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>

    <title>Movies</title>

    <style type="text/css">
        .add_position{
            width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        .form_width{
            width: 500px;
            margin: 0 auto;
        }
    </style>



</head>
<body style="background-color: #cccccc">
    <div style="padding-top: 70px" class="add_position">
        <h2>Add New Movie</h2> <br>
        <form class=form_width action="" method="post">



            <input type="text" name="ID_RAYON" class="form-control" placeholder="ID RAYON" > <br>

            <input type="text" name="TITRE" class="form-control" placeholder="movie title" > <br>
            <input type="text" name="DUREE" class="form-control" placeholder="movie duration" ><br>
            <input type="text" datatype="DATE" name="ANNEESORTIE" class="form-control" placeholder=" release date" ><br>
            <input type="text" name="PRIX" class="form-control" placeholder="movie price" ><br>
            <input type="text" name="QUANTITE" class="form-control" placeholder="quantity" ><br>
            <input type="text" name="STATUE" class="form-control" placeholder="statue" ><br>

            <input class="btn btn-default" type="submit" name="submit" value="Add" style="color: black;
                    width: 70px; height: 35px">


        </form>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
            /*$rawtime= htmlentities($_POST['DUREE']);
                $time = date('H:i', mktime(0,$rawtime));*/
            /*$rawdate = htmlentities($_POST['ANNEESORTIE']);
            $date = date('Y-m-d', strtotime($rawdate));*/


            if(isset($_SESSION['log_user'])){
                mysqli_query($db,"insert into films(ID_RAYON,TITRE,DUREE,ANNEESORTIE,PRIX,QUANTITE) values ($_POST[ID_RAYON],'$_POST[TITRE]','$_POST[DUREE]'
                ,'$_POST[ANNEESORTIE]','$_POST[PRIX]' ,'$_POST[QUANTITE]','$_POST[STATUE]')");
            ?>
                <script type="text/javascript">
                   alert("Movie Added");
                </script>


            <?php
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("You need to Log in first");
                </script>
            <?php
            }
        }
    ?>
</body>
</html>
