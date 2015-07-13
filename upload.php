<?php

if( !is_uploaded_file($_FILES['inputfile']['tmp_name']) ) 
{
    header("Location: index.php");
    exit();
}

$filename = sha1_file($_FILES['inputfile']['tmp_name']);

if (!move_uploaded_file( 
 	$_FILES['inputfile']['tmp_name'],
    sprintf('./uploads/%s', $filename)
)) {
    throw new RuntimeException('Failed to move uploaded file.');
}

$mt940_header = "{1:F01INGBNL2ABXXX0000000000}
{2:I940INGBNL2AXXXN}
{4:
:20:P14022000000001
:25:%s
:28C:00000
:60F:%s";

$mt940_template = "
:61:%s
:86:%s";

$mt940_footer = "
:62F:C140220EUR564,35
-}
";

$row = 0;
if (($handle = fopen( dirname(__FILE__) . "/uploads/".$filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {        
        $row++;
        if ( $row == 1 ) continue;
        if ( $row == 2 ) 
    	{
    		$mt940 = sprintf(
    			$mt940_header,
    			$data[2] . "EUR", // :25 - Rekeningidentificatie
    			"C" . date("ymd", strtotime($data[0])) . "EUR0,00" // :60F
			);      
    	}

        $mt940 .= sprintf(
        	$mt940_template,    
        	date("ymd", strtotime($data[0])) . date("md", strtotime($data[0])) . ( ($data[5] == "Bij") ? "C" : "D" ) . $data[6] . "NTRFEREF//0000000000100".$row."\n/TRCD/00100/", // :61
        	"/CNTP/".$data[3]."/////REMI/USTD//".$data[8]."/"
        	);

    }
    fclose($handle);

    unlink( dirname(__FILE__) . "/uploads/".$filename );
}
else
{
    throw new RuntimeException('Failed to read uploaded file.');
}

$mt940 .= $mt940_footer;

header("Content-type: application/octet-stream;");
header("Content-transfer-encoding: Binary;");
header("Content-disposition: attachment; filename=\"" . basename($_FILES['inputfile']['name']) . ".STA" . "\"");
echo $mt940;