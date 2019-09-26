<?php
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NowMovies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>

<section>
    <div class="log_img">

        <div class="info" style="float: left">

            <h1 style="text-align: center; font-size: 35px;">Now Movies</h1>
<!--            <h1 style="text-align: center; font-size: 25px;">Login</h1>-->

            <!-- Default form login -->
            <form class="text-center  p-5" action="#!" method="post">

                <p class="h4 mb-4">Login</p>


                <!-- username -->
                <div class="md-form">
                    <input type="text" id="form1" class="form-control"  name="username" style="color: white" required="">
                    <label for="form1">username</label>
                </div>
                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="form1" name="password" class="form-control" required="">
                    <label for="form1">password</label>
                </div>

                <div class="d-flex justify-content-around">
                    <div>
                        <!-- Remember me -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                            <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                        </div>
                    </div>
                    <div>
                        <!-- Forgot password -->
                        <a href="new_password.php">Forgot password?</a>
                    </div>
                </div>

                <!-- Sign in button -->
                <button class="btn btn-outline-primary waves-effect btn-block btn-sm my-4" type="submit" name="submit">Sign in</button>

                <!-- Register -->
                <p>Not a member?
                    <a href="registration.php">Register</a>
                </p>



            </form>
            <!-- Default form login -->
            <!--<form name="login" action="" method="post">
                <div class="login">
                    <input class="form-control" type="text" name="username" placeholder="username" required=""
                           style="margin: auto 20px"><br>
                    <input class="form-control" type="password" name="password" placeholder="password" required=""
                           style="margin: auto 20px"><br>
                    <button class="btn btn-default" type="submit" name="submit" value="Login">LogIn</button>

                </div>
            </form>
            <br>
            <p style="margin:  auto 20px">

                &nbsp;&nbsp; &nbsp;<a style="color: lightgoldenrodyellow" href="new_password.php">Password forgotten?</a>&nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                New Member? <a style="color: lightgoldenrodyellow" href="registration.php">Sign up</a>

            </p>-->

        </div>
        <?php
        if (isset($_POST['submit'])) {

            $count = 0;
            $res = mysqli_query($db, "select * from membre where username='$_POST[username]' && password='$_POST[password]';");
            $row= mysqli_fetch_assoc($res);
            $count = mysqli_num_rows($res);

            if ($count == 0) {
                ?>
                <!--<script type="text/javascript">
                    alert("wrong username or password.Try again");
                </script>-->
                <div class="alert alert-danger" style="margin-top: 450px; width: 350px; margin-left: 50px">
                    <strong>Wrong username or password.Try again</strong>
                </div>

            <?php
            }
            else{
                $_SESSION['login_user'] = $_POST['username'];
                $_SESSION['pic'] = $row['pic'];


            ?>

                <script type="text/javascript">
                    window.location="movie.php"
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