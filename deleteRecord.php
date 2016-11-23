<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    define('INCLUDE_CHECK',true);

    require 'connect.php';
    require 'functions.php';

    if(mysql_escape_string($_POST['id'])) {
        $id = mysql_escape_string($_POST['id']);
        $sql = "DELETE FROM records WHERE id='$id'";
        $retval = mysql_query( $sql, $link );

        if(! $retval ) {
           die('Could not delete data: ' . mysql_error());
        }

        echo "Deleted data successfully\n";
    }