<?php
define ('server', 'localhost');
define ('username', 'root');
define ('password', '');
define ('database', 'bd2_test');
$conn = mysqli_connect(server, username, password, database);
if (!$conn) {
    die("impossible de se connecter à la base de données:   " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
$name = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "INSERT INTO utilisateurs VALUES ('', '$name', '$email', 'user', '$password')";
$res=mysqli_query($conn, $sql);
if ($res) {
    echo "<div>
    <h3> vous etes inscrit avec succès </h3>
    cliquez ici pour connecter <a href='connexion.html'> se connecter </a>
    </div>";
} else {
    echo "requete echouée: " ;
}
}
if (isset($_POST['sub'])) {
session_start();
$u=$_POST['name'];
$_SESSION['name'] = $u;
$p=$_POST['pass'];
$sql1= "SELECT * FROM utilisateurs WHERE nom_utilisateur='$u' AND pass_utilisateur='$p'";
$res1=mysqli_query($conn, $sql1);

if (mysqli_num_rows($res1) > 0) {
    $t=mysqli_fetch_assoc($res1);
    if ($t['type'] == 'admin') {
        header('location:PageAdmin.html');
    } else {
        header('location:PageUser.html');
    }
}
else {
    echo "nom d'utilisateur ou mot de passe incorrect";
}
}
mysqli_close($conn);

?>