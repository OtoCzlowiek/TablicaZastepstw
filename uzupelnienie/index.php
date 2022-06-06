<style>
	body {display: flex;
            flex-direction: column;
			align-items: center;}
    form {display: flex;
            flex-direction: column;
			align-items: center;
            border: 2px dashed rgb(74, 86, 142);
            padding: 10px;
            margin: 10px;}
    input[type=submit] {margin-top: 10px;} 
            
	label {margin: 10px 10px 10px 10px;}
</style>

<?php
/*	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/zastepstwa-dodawanie.php');
	exit; */
?>

<!--  -->




<?php
$pass = ""; //prevent the "no index" error from $_POST


if (isset($_POST['pass'])) { // so that they don't return errors
    $pass = $_POST['pass'];
}    

$pwoptions   = ['cost' => 8,]; // all up to you
$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);  // hash entered pw
$hashedpass  = file_get_contents("pass.txt"); // and our stored password


if (password_verify($pass,$hashedpass)) {

    // the password verify is how we actually login here
    // the $userhash and $passhash are the hashed user-entered credentials
    // password verify now compares our stored user and pw with entered user and pw

    include "zastepstwa-dodawanie.php";

} else { 
    // if it was invalid it'll just display the form, if there was never a $_POST
    // then it'll also display the form. that's why I set $user to "" instead of a $_POST
    // this is the right place for comments, not inside html
    ?>  
    <img src="logo-banner.png">
    <form method="POST" action="index.php">
    <p>Zaloguj się, aby dodać zastepstwa</p>
    <div>Hasło: <input type="password" name="pass"></div>
    <input type="submit" name="submit" value="Zaloguj się"></input>
    </form>
    <?php
}
// https://stackoverflow.com/questions/4115719/easy-way-to-password-protect-php-page <-wielkie dzięki za pomoc