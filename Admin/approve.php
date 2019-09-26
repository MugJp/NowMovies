<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>


    <title>Approve Request</title>
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
    <h2>Approve Request</h2><br>
    <form class=form_width action="" method="post">
        <input type="text" class="form-control" name="DATEEMPRUNT" placeholder="Date emprunt yyyy-mm-dd"><br>
        <input type="text" class="form-control" name="RETOURPREVU" placeholder="Retour emprunt yyyy-mm-dd"><br>
        <input type="text"class="form-control" name="VALIDE" placeholder="Valide or not">
        <div style="text-align: center"><br><button class="btn btn-default" type="submit" name="submit">Approve</button></div>
    </form>


</div>

<?php
if(isset($_GET['id'],$_GET['uname'])) {


    if (isset($_POST['submit'])) {
        mysqli_query($db, "update `emprunt` set `DATEEMPRUNT` ='$_POST[DATEEMPRUNT]' , `RETOURPREVU` = 
        '$_POST[RETOURPREVU]' ,`VALIDE` = '$_POST[VALIDE]' where `ID_MEMBRE` = (select ID_MEMBRE from membre
         where username = '".$_GET['uname']."') and ID_FILM = '".$_GET['id']."';");



        mysqli_query($db, "update films set QUANTITE = QUANTITE-1 WHERE ID_FILM = '".$_GET['id']."';");

        $res = mysqli_query($db, "select QUANTITE from films where ID_FILM = '".$_GET['id']."'; ");

        while ($row=mysqli_fetch_assoc($res)){
            if($row['QUANTITE'] ==0){
                mysqli_query($db, "update films set STATUE = 'Not-Available' where ID_FILM = '".$_GET['id']."';");
            }
        }
        ?>
            <script type="text/javascript">
                alert("Updated Succesfully");
                window.location="requestA.php";
            </script>
        <?php
    }
}
?>
</body>
</html>