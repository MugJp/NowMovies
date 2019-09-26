<?php
include "connection.php";

session_start();

if (isset($_GET['id'])){

    //echo $_GET['id'];
    if(isset($_SESSION['login_user'])) {

        $member=$_SESSION['login_user'];
    echo $member;
        $id = $_GET['id'];
        echo $id;


        mysqli_query($db, "insert into emprunt(ID_FILM,ID_MEMBRE,TARIF)
             values ((select ID_FILM from films WHERE ID_FILM LIKE'".$id."'),
            (select ID_MEMBRE from membre  where username LIKE '".$member."'),(select prix from films f inner JOIN emprunt e on f.ID_FILM=e.ID_FILM
            WHERE f.ID_FILM LIKE'".$id."'))") or die(mysqli_error($db));
        echo "<meta http-equiv='refresh' content='0;url=request.php'>";
    }else{
        echo "pas de photos!!";
    }
}
?>

<!--insert into emprunt(ID_FILM,ID_MEMBRE) values ('5', (select ID_MEMBRE from membre where username = 'MugJp'))-->
<!--select m.ID_MEMBRE from emprunt e inner join membre m on e.ID_MEMBRE = m.ID_MEMBRE where username = $_SESSION[login_user]-->
<!--select ID_MEMBRE from membre where username= $_
select f.ID_FILM,rayon.APPELATION,f.TITRE,f.DUREE,f.ANNEESORTIE,
f.PRIX,f.QUANTITE from films f INNER JOIN rayon  on f.ID_RAYON = rayon.ID_RAYON

select f.-->

<!--insert into emprunt(ID_FILM,ID_MEMBRE,TARIF) values ((select ID_FILM from films where ID_FILM ='6'), (select ID_MEMBRE from membre where username = 'MugJp'),(select prix from films f inner JOIN emprunt e on f.ID_FILM=e.ID_FILM WHERE f.ID_FILM LIKE'6'))-->

<!--
$servername = "localhost";
$database = "nowmovies";
$username = "root";
$password = "";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
    echo "Connected successfully";
} catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
}

// Set the variables for the movie loan we want to add to the database
$member = $_SESSION['login_user'];
$movie_id = $_GET['id'];

// Here we create a variable that calls the prepare() method of the database object
// The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name
$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO emprunt (ID_MEMBRE,ID_FILM) VALUES (:member, :film)");

// Now we tell the script which variable each placeholder actually refers to using the bindParam() method
// First parameter is the placeholder in the statement above - the second parameter is a variable that it should refer to
$my_Insert_Statement->bindParam(:member, $member);
$my_Insert_Statement->bindParam(:film, $movie_id);

// Execute the query using the data we just defined
// The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
if ($my_Insert_Statement->execute()) {
    echo "New record created successfully";
} else {
    echo "Unable to create record";
}-->

