<?php
include "connectionA.php";
include  "headerA.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Profile</title>
    <style type="text/css">
        .wrapp {
            width: 500px;
            margin: 0 auto;
        }
        table tr td {
            border: 1px solid #cccccc;
        }



    </style>

</head>
<body style="background-color: #cccccc">
<div class="container">
    <form action="" method="post">
        <div style="padding-top: 70px">
            <button class="btn btn-default" style="float: right; width: 70px" name="sub">
                Edit
            </button>
        </div>

    </form>
    <div class="wrapp">
        <?php
        if(isset($_POST['sub'])){
            ?>
            <script type="text/javascript">
                window.location="editA.php"
            </script>
            <?php
        }
        $q=mysqli_query($db, "select * from admin where username = '$_SESSION[log_user]';");
        ?>
        <h2 style="text-align: center">My Profile</h2>
        <?php
        $row=mysqli_fetch_assoc($q);
        echo "<div style='text-align: center'>
                        <img class='img-circle profile-img' height= 120px width= 120px' src='images/".$_SESSION['pix']."'>
                    </div>";
        ?>
        <div style="text-align: center"><b>Welcome</b>
            <h4>
                <?php
                echo $_SESSION['log_user'];
                ?>
            </h4>
        </div>
        <?php
        echo "<table class='table'>";

        echo "<tr>";
        echo "<td>";
        echo "<b>First Name</b>";
        echo "</td>";

        echo "<td class='text-right'>";
        echo $row['first'];
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<b>Last Name</b>";
        echo "</td>";

        echo "<td class='text-right'>";
        echo $row['last'];
        echo "</td>";
        echo "</tr>";



        echo "<tr>";
        echo "<td>";
        echo "<b>Tel</b>";
        echo "</td>";

        echo "<td class='text-right'>";
        echo $row['tel'];

        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<b>Email</b>";
        echo "</td>";

        echo "<td class='text-right'>";
        echo $row['email'];
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<b>Password</b>";
        echo "</td>";

        echo "<td class='text-right'>";
        echo $row['password'];

        echo "</td>";
        echo "</tr>";

        echo "</table>";
        ?>
    </div>

</body>

</html>