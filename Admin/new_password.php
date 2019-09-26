<?php

include "connectionA.php";
include "headerA.php";

?>


<!DOCTYPE html>
<html>
<head>

    <title>Update Password</title>


</head>
<body>
<section>
<div class="log_img">
    <div class="info2" style="float: right">
        <h1 style="text-align: center; font-size: 35px;">Now Movies</h1>

        <h1 style="text-align: center; font-size: 20px;">Change Your Password</h1><br>

        <form action="" method="post">
            <input type="text" name="username" class="form-control" placeholder="username" required=""><br>
            <input type="text" name="email" class="form-control" placeholder="email" required=""><br>
            <input type="text" name="password" class="form-control" placeholder="new password" required=""><br>
            <button class="btn btn-default" type="submit" name="submit">Change</button>
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
        if( mysqli_query($db, "update admin set password = '$_POST[password]' 
            where username = '$_POST[username]' and email = '$_POST[email]' ;")){
            ?>
            <script type="text/javascript">
                alert("Update succescful")
            </script>
            <?php
        }
    }
    ?>


</div>

</section>

</body>
</html>