<?php
include "connection.php";
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MembersLogin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<div class="search_item">

    <form class = "navbar-form" method="post" name="form1">

        <input class="form-control" type="text" name="search" placeholder="search movies" required="" >

        <button type="submit">

        </button>

        <button type = "submit" name="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>

    </form>

</div>
</body>
</html>
