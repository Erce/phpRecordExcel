/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*$(function() {
    var form_delete = $('#delete');


    $(form_delete).submit(function (e) {
        e.preventDefault();
        e.stopPropagation();
          $.ajax({
            type: 'post',
            url: 'delete.php',
            data: $('form').serialize(),
            success: function () {
              alert('form was submitted');
            }
          });
          return false;
    });
});*/

    var id = "";

    $(function () {
        $('.add').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'add.php',
            data: $('.add').serialize(),
            success: function () {
              $('#username').val('');
              $('#password').val('');
              $('#passwordRpt').val('');
            }
          });
          return false;
        });
    });  
    
    $(function () {
        $('.delete').bind('submit', function () {
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
      });
      
      
    $(function () {
        $('.deleteButton').click(function (event) {
          $id = event.target.id.toString();
          $id = $id.substring(12, $id.length);
          $row = "#row" + $id;
          $id = "id=" + $id;
          $($row).remove();
          $.ajax({
            type: 'post',
            url: 'deleteRecord.php',
            data: $id,
            success: function () {
              
            }
          });
          return false;
        });
    });
      
      
 
    
    $(function () {
        $('body').on('click','.editButton', function (event) {
            $id = event.target.id.toString();
            $id = $id.substring(10, $id.length);
            $row = "#row" + $id;
            
            $firstname = "#firstname" + $id;
            $lastname = "#lastname" + $id;
            $address = "#address" + $id;
            $phone = "#phone" + $id;
            $price = "#price" + $id;
            $username = "#username" + $id;
            $editButton = "#editButton" + $id;
            $deleteButton = "#deleteButton" + $id;
            $buttons = "#buttons" + $id;
            
            $($firstname).hide();
            $($lastname).hide();
            $($address).hide();
            $($phone).hide();
            $($price).hide();
            $($username).hide();
            $($editButton).hide();
            $($deleteButton).hide();
            $($buttons).hide();

            $($row).append("<div class='col-md-1 col-xs-1' id='appendedfirstname" + $id + "'><input class='edit-class' type='text' id='inputfirstname"+$id+"' value='" + $($firstname).text() + "'/></div>"
                            +"<div class='col-md-2 col-xs-2' id='appendedlastname" + $id + "'><input class='edit-class' type='text' id='inputlastname"+$id+"' value='" + $($lastname).text() + "'/></div>"
                            +"<div class='col-md-3 col-xs-3' id='appendedaddress" + $id + "'><textarea class='edit-class textarea' type='text' id='inputaddress"+$id+"'>" + $($address).text() + "</textarea></div>"
                            +"<div class='col-md-2 col-xs-2' id='appendedphone" + $id + "'><input class='edit-class' type='text' id='inputphone"+$id+"' value='" + $($phone).text() + "'/></div>"
                            +"<div class='col-md-1 col-xs-1' id='appendedprice" + $id + "'><input class='edit-class' type='text' id='inputprice"+$id+"' value='" + $($price).text() + "'/></div>"
                            +"<div class='col-md-2 col-xs-2' id='appendedusername" + $id + "'><input class='edit-class' type='text' id='inputusername"+$id+"' value='" + $($username).text() + "'/></div>"
                            +"<div class='col-md-1 col-xs-1 row-buttons' id='appendedbuttons"+ $id +"'><img class='cancelButton' id='appendedcancelButton"+$id+"' src='cancel.png'/>"
                            +"<img class='confirmButton' id='appendedconfirmButton"+$id+"' src='confirm.png'/></div>");
        });
    });
    
    $(function () {
        $('body').on('click','.confirmButton', function (event) {
            $confirmeventid = event.target.id.toString();
            $confirmeventid = $confirmeventid.substring(21, $confirmeventid.length);
            $row = "#row" + $confirmeventid;
            $id = $confirmeventid;
            //alert("id=" + $id + "  confirmeventid=" + $confirmeventid);
            if($id === $confirmeventid && $('#inputusername'+$id).val() !== "") {
                //alert("inside if");
                $firstname = "#firstname" + $id;
                $lastname = "#lastname" + $id;
                $address = "#address" + $id;
                $phone = "#phone" + $id;
                $price = "#price" + $id;
                $username = "#username" + $id;
                $editButton = "#editButton" + $id;
                $deleteButton = "#deleteButton" + $id;
                $buttons = "#buttons" + $id;
                $($firstname).remove();
                $($lastname).remove();
                $($address).remove();
                $($phone).remove();
                $($price).remove();
                $($username).remove();
                $($editButton).remove();
                $($deleteButton).remove();
                $($buttons).remove();
                $firstname = $('#inputfirstname' + $id).val();
                $lastname = $('#inputlastname' + $id).val();
                $address = $('#inputaddress' + $id).val();
                $phone = $('#inputphone' + $id).val();
                $price = $('#inputprice' + $id).val();
                $username = $('#inputusername' + $id).val();
                $data = "id=" + $id + "&firstname=" + $firstname + "&lastname=" + $lastname + "&address=" + $address + "&phone=" + $phone + "&price=" + $price + "&username=" + $username;
                //alert($data);
                $.ajax({
                    type: 'post',
                    url: 'updateRecord.php',
                    data: $data,
                    success: function () {
                        $('#appendedfirstname' + $id).remove();
                        $('#appendedlastname' + $id).remove();
                        $('#appendedaddress' + $id).remove();
                        $('#appendedphone' + $id).remove();
                        $('#appendedprice' + $id).remove();
                        $('#appendedusername' + $id).remove();
                        $('#appendedcancelButton' + $id).remove();
                        $('#appendedconfirmButton' + $id).remove();
                        $('#appendedbuttons' + $id).remove();
                        $($row).append("<div class='col-md-1 col-xs-1' id='firstname" + $id + "'>" + $firstname + "</div>"
                            +"<div class='col-md-2 col-xs-2' id='lastname" + $id + "'>" + $lastname + "</div>"
                            +"<div class='col-md-3 col-xs-3' id='address" + $id + "'>" + $address + "</div>"
                            +"<div class='col-md-2 col-xs-2' id='phone" + $id + "'>" + $phone + "</div>"
                            +"<div class='col-md-1 col-xs-1' id='price" + $id + "'>" + $price + "</div>"
                            +"<div class='col-md-2 col-xs-2' id='username" + $id + "'>" + $username+ "</div>"
                            +"<div class='col-md-1 col-xs-1 row-buttons' id='buttons"+ $id +"'><img class='editButton' id='editButton"+$id+"' src='edit.png'/>"
                            +"<img class='deleteButton' id='deleteButton"+$id+"' src='delete.png'/></div>");
                    }
                });
            }
            else {
                alert("else");
                $('#inputusername'+$id).removeClass('edit-class');
                $('#inputusername'+$id).addClass('failure-edit-class');
            }
        });
    });
        
    $(function () {
        $('body').on('click','.cancelButton', function (event) {
            $id = event.target.id.toString();
            $id = $id.substring(20, $id.length);
            $('#appendedfirstname' + $id).remove();
            $('#appendedlastname' + $id).remove();
            $('#appendedaddress' + $id).remove();
            $('#appendedphone' + $id).remove();
            $('#appendedprice' + $id).remove();
            $('#appendedusername' + $id).remove();
            $('#appendedcancelButton' + $id).remove();
            $('#appendedconfirmButton' + $id).remove();
            $('#appendedbuttons' + $id).remove();
            $firstname = "#firstname" + $id;
            $lastname = "#lastname" + $id;
            $address = "#address" + $id;
            $phone = "#phone" + $id;
            $price = "#price" + $id;
            $username = "#username" + $id;
            $editButton = "#editButton" + $id;
            $deleteButton = "#deleteButton" + $id;
            $buttons = "#buttons" + $id;
            $($firstname).show();
            $($lastname).show();
            $($address).show();
            $($phone).show();
            $($price).show();
            $($username).show();
            $($editButton).show();
            $($deleteButton).show();
            $($buttons).show();
        });
    });


    $(function () {
        $('body').on('click','.login', function (event) {
            var formData = $('#form').serialize();
            formData = formData + "&submit=" + $('#submit').val();
            //alert(formData);
            $.ajax({
                type: 'post',
                url: 'loginBackground.php',
                data: formData,
                success: function (response) {
                    //alert(response);
                    if(response == 'true') {
                    }
                    else {
                        //$('#username').removeClass('input-class');
                        //$('#username').addClass('failure-input-class');
                        //$('#password').removeClass('input-class');
                        //$('#password').addClass('failure-input-class');
                    }
                },
                error: function(){// if it is error in ajax side
                    /*alert("false");
                    alert("in error");
                    $('#username').removeClass('input-class');
                    $('#username').addClass('failure-input-class');
                    $('#password').removeClass('input-class');
                    $('#password').addClass('failure-input-class');*/
                }    
            });
        });
    });  