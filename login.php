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
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

?>
<html>
    <head>
        <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
            /*$(function () {
                
                $('#submit').bind('submit', function () {
                    alert();
                    $.ajax({
                      type: 'post',
                      url: 'delete.php',
                      data: $('.delete').serialize(),
                      success: function () {
                        $('#username').val('');
                      }
                    });
                    return false;
                });

                var form = $('#form');
                $(form).submit(function(e) {
                    alert();
                });  
                    
                
                $('body').on('click','#submit', function (event) {
                    alert();
                    $username = $("#username").val();
                    $password = ("#password").val();
                    if($username != "" && $password != "") {
                        $data = "username=" + $username + "&password=" + $password);
                        var formData = $(form).serialize();
                        //alert($data);
                        $.ajax({
                            type: 'post',
                            url: 'loginBackground.php',
                            data: formData,
                            success: function () {
                                
                            }
                        });
                    }
                    else {
                        alert("else");
                        $('#username'+$id).addClass('failure-input-class');
                        $('#password'+$id).addClass('failure-input-class');
                    }
            });
        });*/
            /*$(function() {
                // Get the form.
                var form = $('#form');
                // Get the messages div.
                var formMessages = $('#form-messages');
                $(form).submit(function(e) {
                    // Stop the browser from submitting the form.
                    e.preventDefault();
                    e.stopPropagation();
                    // Serialize the form data.
                    var formData = $(form).serialize();

                    // Submit the form using AJAX.
                    $.ajax({
                        type: 'POST',
                        url: $(form).attr('action'),
                        data: formData,
                        success: function (response) {// if it is success in ajax side
                            if (response=='true') {//if it is success in backend
                                $(formMessages).text('');//clears the message
                                $(formMessages).removeClass('failure');//removes the failure class
                                $(formMessages).addClass('success');//adds the success class
                                $(formMessages).text("E-mail was sent. Thank you for contacting us.");//adds the text
                                $('#firstName').val(''); //clears fields
                                $('#lastName').val(''); //clears fields
                                $('#email').val(''); //clears fields
                                $('#company').val(''); //clears fields
                                $('#phoneNumber').val(''); //clears fields
                            }
                            else {
                                $(formMessages).text('');//clears the message
                                $(formMessages).removeClass('success');//removes the success class
                                $(formMessages).addClass('failure');//adds the failure class
                                $(formMessages).text("E-mail sending has failed. Please check the fields and try again.");//adds the text
                            }

                        },
                        error: function(){// if it is error in ajax side
                            $(formMessages).removeClass('success');//removes the success class
                            $(formMessages).addClass('failure');//adds the failure class
                            $(formMessages).text("E-mail sending has failed. Please check the fields and try again.");//adds the text
                        }           
                    });     
                });
            });*/
        </script>
    </head>
    <body>       
        <div class="container fill-login">
            <?php

                if(!isset($_SESSION['id'])):

            ?>
            <div class="row" id="form-messages">
                <div class="col-md-2"></div>
                <div class="col-md-8"><div id="message-div" class="message-div"></div></div>
                <div class="col-md-2"></div>
            </div>
            <div class="col-md-4 col-xs-3 left-container"><p class="text-muted"></p></div>
            <div class="col-md-4 col-xs-6 middle-container">
                <!-- <div class="container" id="cont"> -->
                <!-- Bootstrap row defined for responsive grid design -->
                <!-- An empty div row and div columns to add classes, designs and use with Ajax to show messages on top -->
                <!-- Bootstrap row defined for responsive grid design -->
                <div class="row">
                    <!-- Defined form container starts -->
                    <div class="form-container">
                        <!-- Horizontal form bootstrap class defined -->
                        <form class="form-horizontal" id="form" action="loginBackground.php" method="post" accept-charset='UTF-8'>
                            <?php

                                /*if(isset($_SESSION['msg']['login-err']))
                                {
                                    echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
                                    unset($_SESSION['msg']['login-err']);
                                    //session_abort();
                                }*/
                            ?>
                            <div class="form-group form">
                                <div class="col-md-12">
                                    <label class="sr-only" for="username"></label>
                                    <input class="input-class form-control" type="text" name="username" id="username" placeholder="Kullanici Adi">
                                </div>
                            </div>
                            <div class="form-group form">
                                <div class="col-md-12">
                                    <label class="sr-only" for="password"></label>
                                    <input class="input-class form-control" type="password" name="password" id="password" placeholder="Sifre">
                                </div>
                            </div>
                            <div class="form-group form">
                                <div class="col-md-4 col-xs-4"></div>
                                <div class="col-md-5 col-xs-5">
                                    <label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Beni Hatirla</label>
                                </div>
                                <div class="col-md-3 col-xs-3"></div>
                            </div>
                            <div class="form-group form">
                                <div class="col-md-3 col-xs-3"></div>
                                <div class="col-md-6 col-xs-6" id="button-add">
                                    <button type="submit" value="CHECK" class="btn btn-default login" name="submit" id="submit">Giris</button>
                                </div>
                                <div class="col-md-3 col-xs-3"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-3 right-container"><p class="text-muted"></p></div>
        </div>          
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>');</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript" src="../bootstrap.min.js"></script>
        <?php

            else:
                
                if(isset($_SESSION['type']) == 'user') {
                    redirect('user.php');
                }
                else if(isset($_SESSION['type']) == 'admin') {
                    redirect('admin.php');
                }
                
            endif;
        ?>
    </body>
</html>