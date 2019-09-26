<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NowMovies</title>
    <link rel="stylesheet" type="text/css" href="styleA.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>


<section>
    <div class="log_img">

        <div class="info" style="float: right">

            <h1 style="text-align: center; font-size: 35px;">Admin</h1>
            <h1 style="text-align: center; font-size: 25px;">Login</h1>
            <br>

            <form name="login" action="" method="post">
                <div class="login">
                    <input class="form-control" type="text" name="username" placeholder="username" required=""
                           style="margin: auto 20px"><br>
                    <input class="form-control" type="password" name="password" placeholder="password" required=""
                           style="margin: auto 20px"><br>
                    <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black;
                    width: 70px; height: 35px; margin: auto 20px">

                </div>
            </form>


        </div>
        <?php
        if (isset($_POST['submit'])) {

            $count = 0;
            $res = mysqli_query($db, "select * from admin where username='$_POST[username]' && password='$_POST[password]';");

            $row= mysqli_fetch_assoc($res);

            $count = mysqli_num_rows($res);

            if ($count == 0) {
                ?>

                <div class="alert alert-danger" style="margin-top: 400px; width: 350px; margin-left: 500px">
                    <strong>Wrong username or password.Try again</strong>
                </div>

            <?php
            }
            else{
                /*...................Match de user et password ...............*/

                $_SESSION['log_user'] = $_POST['username'];

                $_SESSION['pix']=$row['pic']

            ?>
                <script type="text/javascript">
                    window.location="movieA.php"
                </script>
                <?php
            }
        }

        ?>
    </div>



</section>



<footer>
    <br>
    <ul style="color: white ">
        <li style="display: inline-block; float: left">&nbsp Email: NowMovies@gmail.com</li>
        <li style="display: inline-block">Open from 09 AM till 08 PM &nbsp</li>
        <li style="display: inline-block; float: right">Mobile: +322146756 &nbsp</li>
    </ul>
    <br>
</footer>

</body>
</html>