<?php
//call library
require_once ('lib/nusoap.php');
//using soap_server to create server object
$server = new soap_server;
//register a function that works on server
$server->register('caculate');

// create the function


function caculate($x, $y, $z)
{
    if(!($x || $y || $z)){
        return new soap_fault('Client','','Put Your Name!'); 
    }
    if($z == 1)
    {
        $result = $x + $y;
    }elseif($z == 2)
    {
        $result = $x - $y;
    }elseif($z == 3)
    {
        $result = $x * $y;
    }elseif($z ==4)
    {
        $result = $x / $y;
    }
    return $result;
}
// create HTTP listener
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
    $server->service($HTTP_RAW_POST_DATA);
exit();
 ?> 