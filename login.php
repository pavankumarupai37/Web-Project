<?php 

//Connects to your Database 
$conect = mysqli_connect("localhost","root","", "e-Ledger") or die(mysql_error()); 


 //if the login form is submitted 
// if (isset($_POST['submit'])) {

	// makes sure they filled it in
 	if(!$_POST['username']){
 		die('You did not fill in a username.');
 	}
 	if(!$_POST['pass']){
 		die('You did not fill in a password.');
 	}

 	 	$check = mysqli_query($conect, "SELECT * FROM admin_login WHERE name = '".$_POST['username']."'")or die(mysql_error());

 //Gives error if user dosen't exist
 $check2 = mysqli_num_rows($check);
 if ($check2 == 0){
	die('That user does not exist in our database.<br /><br />If you think this is wrong <a href="login.php">try again</a>.');
}

while($info = mysqli_fetch_array( $check )){
	$_POST['pass'] = stripslashes($_POST['pass']);
 	$info['password'] = stripslashes($info['password']);
 	//$_POST['pass'] = md5($_POST['pass']);

	//gives error if the password is wrong
 	if ($_POST['pass'] != $info['password']){
 		die('Incorrect password, please <a href="login.php">try again</a>.');
 	}
	
	else{ // if login is ok then we add a cookie 
		$_POST['username'] = stripslashes($_POST['username']); 
		$hour = time() + 3600; 
		setcookie(ID_your_site, $_POST['username'], $hour); 
		setcookie(Key_your_site, $_POST['pass'], $hour);	 
 
		//then redirect them to the members area 
		header("Location: home/index.html"); 
	}
}

  
