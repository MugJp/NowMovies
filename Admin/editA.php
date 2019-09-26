<?php
include "connectionA.php";
include "headerA.php";
?>

<!DOCTYPE html>
<html>
<head>


    <title>Edit Profile</title>
    <style type="text/css">
        .wrapp {
            width: 500px;
            margin: 0 auto;

        }
        .form-element label {
            display: inline-block;
            width: 150px;
        }

    </style>

</head>
<body style="background-color: #cccccc">
<div class="container" style="padding-top: 70px">
    <h2 style="text-align: center">Edit your Informations</h2><br>
    <?php
    $sql = " select * from admin where username= '$_SESSION[log_user]'";
    $result = mysqli_query($db,$sql) or die (mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)){
        $firs = $row['first'];
        $las = $row['last'];
        $tell = $row['tel'];
        $emai= $row['email'];
        $usernam = $row['username'];
        $passwor = $row['password'];
        $picture = $row['pic'];
    }
    ?>
    <div class="wrapp" style="text-align: center" >
        <form action="" method="post"  enctype="multipart/form-data">
            <div class="form-group">
                <label  class="col-lg-3">Picture</label>
                <div class="col-lg-8">
                    <input type="file" class="form-control" name="pic"  value="<?php echo $picture; ?>"><br>

                </div>
            </div><br>

            <div class="form-group">
                <label  class="col-lg-3">First name</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="first" value="<?php echo $firs; ?>"><br>
                </div>
            </div><br>
            <div class="form-group">
                <label class="col-lg-3">Last name</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="last" value="<?php echo $las; ?>"><br>
                </div>
            </div><br>

            <div class="form-group">
                <label class="col-lg-3">Mobile</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="tel" value="<?php echo $tell; ?>"><br>
                </div>
            </div><br>
            <div class="form-group">
                <label  class="col-lg-3">Email</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="email" value="<?php echo $emai; ?>"><br>
                </div>
            </div><br>
            <div class="form-group">
                <label  class="col-lg-3">Username</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="username" value="<?php echo $usernam; ?>"><br>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-lg-3">Password</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="password" value="<?php echo $passwor; ?>"><br>
                </div>
            </div>

            <div style="padding-left: 90px;"><button style="width: 305px; padding-top: 2px" class="btn btn-info" type="submit" name="submit">Save</button></div>

        </form>

    </div>
    <?php

    if(isset($_POST['submit'])){

        move_uploaded_file($_FILES['pic']['tmp_name'],"images/".$_FILES['pic']['name']);

        $first = $_POST['first'];
        $last = $_POST['last'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pic = $_FILES['pic']['name'];



        if(mysqli_query($db,"update `admin` set first = '$first', last = '$last' ,tel = '$tel', email= '$email',
            username = '$username', password = '$password', pic = '$pic' where username = '".$_SESSION['log_user']."';")){
            ?>
            <script type="text/javascript">
                alert("updated");
                window.location="profilA.php";
            </script>
            <?php
        }else {
            echo "ERROR NOT DOIING";
        }
    }
    ?>

</div>
</body>
</html>
