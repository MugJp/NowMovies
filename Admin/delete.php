<?php
include "connectionA.php";
?>

<?php

if (isset($_GET['del'])){

    $id =$_GET['del'];
    mysqli_query($db,"DELETE FROM films WHERE ID_FILM = '$id'")or die(mysqli_error());
    echo "<meta http-equiv='refresh' content='0;url=movieA.php'>";
}
?>
