<?php

    define('INCLUDE_CHECK',true);

    require 'connect.php';
    require 'functions.php';

    if(mysql_escape_string($_POST['username'])) {
        $username = mysql_escape_string($_POST['username']);
        $password = mysql_escape_string($_POST['password']);
        $type = isset($_POST['type']) ? $_POST['type'] : 'user';
        $sql = "INSERT INTO accs (id, username, password, type) VALUES (NULL, '$username', '".md5($password)."','$type')";
        $retval = mysql_query( $sql, $link );

        if(! $retval ) {
           die('Could not add data: ' . mysql_error());
        }

        echo "Added data successfully\n";
    }