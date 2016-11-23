<?php

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined


session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if(!isset($_SESSION['username'])){
    //echo "dfasdfasd";
    header("location:login.php");
}
else {
    if($_SESSION['type'] == 'admin') {
        //echo 'true';
        header("Location: admin.php", true, 302);
        die();
    }
    else if($_SESSION['type'] == 'user')
    {
        //echo 'true';
        header("Location: user.php", true, 302);
        die();

    }
}

if(isset($_SESSION['id']) && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:
	$_SESSION = array();
	session_destroy();
	// Destroy the session
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	header("Location: login.php", true, 302);
	exit;
}

if(isset($_POST['submit'])=='CHECK')
{
        //echo "['submit'])=='CHECK'";
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!isset($_POST['username']) || !isset($_POST['password'])) {
		$err[] = 'All the fields must be filled in!';
                header("Location: login.php", true, 302);
        }
        
	
	if(!count($err))
	{
                $username = stripcslashes($_POST['username']);
                $password = stripcslashes($_POST['password']);
                $username = mysql_real_escape_string($username);
                $password = mysql_real_escape_string($password);
		//$_POST['username'] = mysql_real_escape_string($_POST['username']);
		//$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)isset($_POST['rememberMe']);
		
		// Escaping all input data
                $sql = "SELECT id,username,type,password FROM accs WHERE username='".$username."' AND password='".md5($password)."'";
                $retval = mysql_query($sql, $link);
		$row = mysql_fetch_assoc($retval);
                
                echo $password;
		if($row['password'] == md5($password))
		{
                    //echo "true";
			// If everything is OK login
			//echo "in row username";
			$_SESSION['username']=$row['username'];
			$_SESSION['id'] = $row['id'];
                        $_SESSION['type'] = $row['type'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			// Store some data in the session
			
                        setcookie('tzRemember',$_POST['rememberMe']);
                        //echo 'true';
                        if($row['type'] === 'admin') {
                            echo 'true';
                            header("Location: admin.php", true, 302);
                            //die();
                        }
                        else if($row['type'] === 'user')
                        {
                            echo 'true';
                            header("Location: user.php", true, 302);
                            //die();
                        }
		}
                else {
                    $err[]='Wrong username and/or password!';
                    ///echo 'false';
                    header("Location: login.php", true, 302);
                }
	}
	
	if($err) {
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
        // Save the error messages in the session
        //echo "false";
                                
        ob_end_flush();
        exit;
        
        }
}


