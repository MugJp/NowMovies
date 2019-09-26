<?php
include "connection.php";
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">




</head>
<body>


<section>
    <div class="log_img">

        <div class="info2" style="float: left">

            <h1 style="text-align: center; font-size: 35px;">Now Movies</h1>
            <h1 style="text-align: center; font-size: 25px;">Member Registration</h1>
            <br>
            <form name="registration" action="" method="post">
                <div class="row">

                    <div class="col-xs-5">
                        <input class="form-control" type="text" name="first" placeholder="First Name" required="">
                    </div>

                    <div class="col-xs-7">
                        <input class="form-control" type="text" name="last" placeholder="Last Name" required="">
                    </div>

                </div>
                <br>

                <input class="form-control" type="text" name="address" placeholder="Address" required=""><br>
                <input class="form-control" type="text" name="tel" placeholder="telephone" required=""><br>
                <input class="form-control" type="text" name="email" placeholder="E-mail" required=""><br>


                <div class="row">
                    <div class="col-xs-6">
                        <input class="form-control" type="text" name="username" placeholder="username" required="">
                    </div>

                    <div class="col-xs-6">
                        <input class="form-control" type="password" name="password" placeholder="password" required="">
                    </div>

                </div>
                <br>
                <button class="btn btn-default" type="submit" name="submit" >Submit</button><br>

                Already have an account? <a style="color: white" href="index.php">Login</a>


            </form>

        </div>
    </div>
</section>

<?php
    if (isset($_POST['submit'])) {

        $count=0;
        $sql="select username from membre";
        $result=mysqli_query($db,$sql);

        while ($row=mysqli_fetch_assoc($result)){
            if ($row['username'] == $_POST['username'])
            {
                $count+=1;
            }
        }

        if($count==0) {
            mysqli_query($db, "insert into membre(first, last, address, tel, email, username, password,pic) values  
            ('$_POST[first]', '$_POST[last]', '$_POST[address]', '$_POST[tel]', '$_POST[email]', '$_POST[username]', '$_POST[password]', 'user.png');");
            ?>
            <script type="text/javascript">
                alert("Registration successful ");
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                alert("Your username is already taken. Please try another one. ");
            </script>
            <?php
        }
    }
?>


</body>
</html>