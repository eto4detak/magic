<?php 
function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip = get_transient( 'HTTP_CLIENT_IP_' . get_ip() );
if ( false === $ip ) {
	set_transient( 'HTTP_CLIENT_IP_'.$ip, $ip, DAY_IN_SECONDS );
	var_dump($ip);
} ?>