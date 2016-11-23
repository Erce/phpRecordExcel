<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

    define('INCLUDE_CHECK',true);

    require 'connect.php';
    require 'functions.php';
    // Those two files can be included only if INCLUDE_CHECK is defined

    session_name('tzLogin');
    session_set_cookie_params(2*7*24*60*60);
    session_start();
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
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <!-- <link href="bootstrap.min.css" rel="stylesheet"> -->
        <link href="style.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->       
        <script src="script.js"></script>
        <script>

            /*$(document).ready(function() {
                // Get the form.
                var form = $('#form');

                $(form).bind('submit',function(e) {
                    // Stop the browser from submitting the form.
                    e.preventDefault();
                    e.stopPropagation();
                    // Serialize the form data.
                    var formData = $(form).serialize();
                                    
                    // Submit the form using AJAX.
                    $.ajax({
                        type: 'POST',
                        url: 'excel.php',
                        data: formData,
                        success: function (response) {// if it is success in ajax side
                            
                            $('#firstname').val(''); //clears fields
                            $('#lastname').val(''); //clears fields
                            $('#address').val(''); //clears fields
                            $('#phone').val(''); //clears fields
                            $('#price').val(''); //clears fields
                            location.reload();
                        },
                        error: function(){// if it is error in ajax side

                        }           
                    });     
                });
            });*/
            
        </script>
    </head>
    <?php 
    
        if($_SESSION['type'] === 'user') :
            
    ?>
    <body class="about-body">       
        <div class="container fill">
            <div class="row" id="form-messages">
                <div class="col-md-2"></div>
                <div class="col-md-8"><div id="message-div" class="message-div"></div></div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xs-2 left-container"><p class="text-muted"></p></div>
                <div class="col-md-6 col-xs-8 middle-container">
                    <!-- <div class="container" id="cont"> -->
                    <!-- Bootstrap row defined for responsive grid design -->
                    <!-- An empty div row and div columns to add classes, designs and use with Ajax to show messages on top -->
                    <!-- Bootstrap row defined for responsive grid design -->
                    <div class="col-xs-1"></div>
                    <div class="col-md-12 col-xs-12 middle-container">
                        <div class="row">
                            <!-- Defined form container starts -->
                            <div class="form-container">
                                <!-- Horizontal form bootstrap class defined -->
                                <form class="form-horizontal" id="form" action="excel.php" method="post">
                                    <div class="form-group form form-title">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <h2 class="add-form-title" for="">Hos geldiniz <?php echo $_SESSION['username']; ?>,</h2>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="sr-only" for="firstname"></label>
                                            <input class="input-class form-control" type="text" name="firstname" id="firstname" placeholder="Ad">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="sr-only" for="lastname"></label>
                                            <input class="input-class form-control" type="text" name="lastname" id="lastname" placeholder="Soyad">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="sr-only" for="address"></label>
                                            <input class="input-class form-control" type="text" name="address" id="address" placeholder="Adres">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="sr-only" for="phone"></label>
                                            <input class="input-class form-control" type="text" name="phone" id="phone" placeholder="Telefon">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <label class="sr-only" for="price"></label>
                                            <input class="input-class form-control" type="text" name="price" id="price" placeholder="Fiyat">
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <div class="form-group form">
                                        <div class="col-md-4 col-xs-4"></div>
                                        <div class="col-md-4 col-xs-4">
                                            <button type="submit" value="CHECK" class="btn btn-default" name="submit" id="submit">Olustur ve Gonder</button>
                                        </div>
                                        <div class="col-md-4 col-xs-4"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1"></div>
                </div>
                <div class="col-md-3 col-xs-2 right-container">
                    <form action="" method="GET">
                        <div class="form-group form">
                            <div class="col-md-3 col-xs-2"></div>
                            <div class="col-md-6 col-xs-12">
                                <button type="submit" value="logoff" class="btn btn-default" name="logoff" id="logoff">Cikis</button>
                            </div>
                            <div class="col-md-3 col-xs-2"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">   
                    <div class="row" id="records-title">
                        <div class="col-md-5 col-xs-5"></div>
                        <div class="col-md-2 col-xs-2"><h2></h2></div>
                        <div class="col-md-5 col-xs-5"></div>
                    </div>

                    <div id="records" class="message-div">
                        
                        <?php 
                            echo "<div class='row row-records-titles'>"
                                    ."<div class='col-md-1 col-xs-1'><h4><b>Ad</b></h4></div>"
                                    ."<div class='col-md-2 col-xs-2'><h4><b>Soyad</b></h4></div>"
                                    ."<div class='col-md-3 col-xs-3'><h4><b>Adres</b></h4></div>"
                                    ."<div class='col-md-2 col-xs-2'><h4><b>Telefon</b></h4></div>"
                                    ."<div class='col-md-1 col-xs-1'><h4><b>Fiyat</b></h4></div>"
                                    ."<div class='col-md-2 col-xs-2'><h4><b>Kullanici Adi</b></h4></div>"
                                    ."<div class='col-md-1 col-xs-1'></div>"
                                ."</div>";
                        
                            $sql = "SELECT * FROM records WHERE username='".$_SESSION['username']."'";
                            $retval = mysql_query( $sql, $link );

                            /*if(! $retval ) {
                               die('Could not delete data: ' . mysql_error());
                            }*/
                            $count = 0;
                            while($row = mysql_fetch_array($retval)) {
                                if($count % 2 == 0) {
                                    echo "<div class='row row-records light-line' id='row".$row['id']."'>"
                                            ."<div class='col-md-1 col-xs-1' id='firstname".$row['id']."'>".$row['firstname']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='lastname".$row['id']."'>".$row['lastname']."</div>"
                                            ."<div class='col-md-3 col-xs-3' id='address".$row['id']."'>".$row['address']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='phone".$row['id']."'>".$row['phone']."</div>"
                                            ."<div class='col-md-1 col-xs-1' id='price".$row['id']."'>".$row['price']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='username".$row['id']."'>".$row['username']."</div>"
                                            ."<div class='col-md-1 col-xs-1 row-buttons' id='buttons".$row['id']."'><img class='editButton' id='editButton".$row['id']."' src='edit.png'/>"
                                                                            ."<img class='deleteButton' id='deleteButton".$row['id']."' src='delete.png'/></div>"
                                        ."</div>";
                                }
                                else {
                                    echo "<div class='row row-records dark-line' id='row".$row['id']."'>"
                                            ."<div class='col-md-1 col-xs-1' id='firstname".$row['id']."'>".$row['firstname']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='lastname".$row['id']."'>".$row['lastname']."</div>"
                                            ."<div class='col-md-3 col-xs-3' id='address".$row['id']."'>".$row['address']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='phone".$row['id']."'>".$row['phone']."</div>"
                                            ."<div class='col-md-1 col-xs-1' id='price".$row['id']."'>".$row['price']."</div>"
                                            ."<div class='col-md-2 col-xs-2' id='username".$row['id']."'>".$row['username']."</div>"
                                            ."<div class='col-md-1 col-xs-1 row-buttons' id='buttons".$row['id']."'><img class='editButton' id='editButton".$row['id']."' src='edit.png'/>"
                                                                            ."<img class='deleteButton' id='deleteButton".$row['id']."' src='delete.png'/></div>"
                                        ."</div>";
                                }
                                $count++;
                            }
                        ?>
                        <!--<table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th width="18%">Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                        </table>-->
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>          
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>');</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript" src="../bootstrap.min.js"></script>
    </body>
    <?php
        else: 
                        /*if(!isset($_SESSION['id']))
             {
                 header("Location: login.php", true, 302);
             }*/
             if(isset($_SESSION['type']) == 'admin') {
                 header("Location: admin.php", true, 302);
             }
           //die();
        endif;
    ?>
</html>