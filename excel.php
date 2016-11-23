<?php
    include_once('../Classes/PHPExcel/IOFactory.php');
    
    define('INCLUDE_CHECK',true);

    require 'connect.php';
    require 'functions.php';


    session_name('tzLogin');
    // Starting the session

    session_set_cookie_params(2*7*24*60*60);
    // Making the cookie live for 2 weeks
    session_start();
    //echo "true1";
    if(mysql_escape_string($_POST['firstname']) && mysql_escape_string($_POST['lastname']) && mysql_escape_string($_POST['address'])
                    && mysql_escape_string($_POST['phone']) && mysql_escape_string($_POST['price']) && mysql_escape_string($_SESSION['username'])) {
        //echo 'true in if';
        $firstname = mysql_escape_string($_POST['firstname']);
        $lastname = mysql_escape_string($_POST['lastname']);
        $address = mysql_escape_string($_POST['address']);
        $phone = mysql_escape_string($_POST['phone']);
        $price = mysql_escape_string($_POST['price']);
        $username = mysql_escape_string($_SESSION['username']);

        $sql = "INSERT INTO records (id, firstname, lastname, address, phone, price, username, date) VALUES".
                "(NULL, '$firstname', '$lastname','$address', '$phone', '$price', '$username', NOW())";
        $retval = mysql_query( $sql, $link );

        if(! $retval ) {
           die('Could not add data: ' . mysql_error());
        }

        //echo "Added data successfully\n";
    }
    else {
        //echo 'false';
    }
    
    
    echo "1";
    $sql = "SELECT * FROM records";
    $retval = mysql_query( $sql, $link );

    if(! $retval ) {
       die('Could not add data: ' . mysql_error());
    }

    //echo "Added data successfully\n";

    echo "1";
    $filename = "MyExcel-".date("Y-m-d");
    //include_once('PHPExcel/IOFactory.php');
    /*include_once('../PHPExcel/IOFactory.php');
    include_once('./PHPExcel/IOFactory.php');
    include_once('PHPExcel/Classes/IOFactory.php');*/
    //include_once('./PHPExcel/Classes/IOFactory.php');
    //include_once('../PHPExcel/Classes/IOFactory.php');
    //set the desired name of the excel file
    //$fileName = 'create-an-excel-file-in-php';

    ///************************************/////////////////
    //prepare the records to be added on the excel file in an array
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
    // Add column headers
    $objPHPExcel->getActiveSheet()
                            ->setCellValue('A1', 'Ad')
                            ->setCellValue('B1', 'Soyad')
                            ->setCellValue('C1', 'Adres')
                            ->setCellValue('D1', 'Telefon')
                            ->setCellValue('E1', 'Fiyat')
                            ->setCellValue('F1', 'Kullanici Adi')
                            ->setCellValue('G1', 'Tarih')
                            ;
    $count = 2;
    while($row = mysql_fetch_array($retval)) {
        //Put each record in a new cell
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$count, $row['firstname']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$count, $row['lastname']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$count, $row['address']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$count, $row['phone']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$count, $row['price']);    
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$count, $row['username']); 
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$count++, $row['date']); 
    }
    // Set worksheet title
    $objPHPExcel->getActiveSheet()->setTitle($filename);
    
    $objPHPExcel->getDefaultStyle()
    ->getBorders()
    ->getTop()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getDefaultStyle()
        ->getBorders()
        ->getBottom()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getDefaultStyle()
        ->getBorders()
        ->getLeft()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getDefaultStyle()
        ->getBorders()
        ->getRight()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    
    foreach(range('A','G') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    $excelData = array(
            0 => array('Jackson','Barbara','27','F','Florida'),
            1 => array('Kimball','Andrew','25','M','Texas'),
            2 => array('Baker','John','28','M','Arkansas'),
            3 => array('Gamble','Edward','29','M','Virginia'),
            4 => array('Anderson','Kimberly','23','F','Tennessee'),
            5 => array('Houston','Franchine','25','F','Idaho'),
            6 => array('Franklin','Howard','24','M','California'),
            7 => array('Chen','Dan','26','M','Washington'),
            8 => array('Daniel','Carolyn','27','F','North Carolina'),
            9 => array('Englert','Grant','25','M','Delaware')
    );
    echo "5"; 
    //*************************************//////
    
    
    /*
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    */
    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    ob_clean();
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');

    //save the file to the server (Excel2007)
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($filename . '.xlsx');

    /*
    ///save the file to the server (Excel5)
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('excel-files/' . $fileName . '.xls');*/
    
    
    /************** MAIL **************/
        $mailto = 'ercecanbalcioglu@gmail.com';
        $subject = 'Excel';
        $message = 'My message';

        $filename = $filename. ".xlsx";
        $content = file_get_contents($filename);
        $content = chunk_split(base64_encode($content));

        // a random hash will be necessary to send mixed content
        $separator = md5(time());

        // carriage return type (RFC)
        $eol = "\r\n";

        // main header (multipart mandatory)
        $headers = "From: name <test@test.com>" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol;

        // message
        $body = "--" . $separator . $eol;
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
        $body .= "Content-Transfer-Encoding: 8bit" . $eol;
        $body .= $message . $eol;

        // attachment
        $body .= "--" . $separator . $eol;
        $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $body .= "Content-Transfer-Encoding: base64" . $eol;
        $body .= "Content-Disposition: attachment" . $eol;
        $body .= $content . $eol;
        $body .= "--" . $separator . "--";

        //SEND Mail
        if (mail($mailto, $subject, $body, $headers)) {
            //echo "mail send ... OK"; // or use booleans here            
            echo 'true';
        }
        else
        {
            //echo "mail send ... ERROR!";
            print_r( error_get_last() );
            echo 'false';
        }
        
    /************** MAIL **************/   
