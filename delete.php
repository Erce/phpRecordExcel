<?php
    define('INCLUDE_CHECK',true);

    require 'connect.php';
    require 'functions.php';

    if(mysql_escape_string($_POST['username'])) {
        $username = mysql_escape_string($_POST['username']);
        $sql = "DELETE FROM accs WHERE username='$username'";
        $retval = mysql_query( $sql, $link );

        if(! $retval ) {
           die('Could not delete data: ' . mysql_error());
        }

        echo "Deleted data successfully\n";
    }
