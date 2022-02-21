<?php
// $http_client = $_SERVER['HTTP_CLIENT_IP'];
$http_x_forward = $_SERVER['HTTP_X_FORWARED_FOR'];
$remote_add = getenv('REMOTE_ADDR');

function getIp()
{
    // if (isset($http_client)) {
    //     return $http_client;
    // } else 
    if(isset($http_x_forward)){
        return $http_x_forward;
    }
    // } else{
        // return (isset($remote_add) ? $remote_add : '');
    // }
}
// function get_client_ip() {
//     $ipaddress = '';
//     if (getenv('HTTP_CLIENT_IP'))
//         $ipaddress = getenv('HTTP_CLIENT_IP');
//     else if(getenv('HTTP_X_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//     else if(getenv('HTTP_X_FORWARDED'))
//         $ipaddress = getenv('HTTP_X_FORWARDED');
//     else if(getenv('HTTP_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_FORWARDED_FOR');
//     else if(getenv('HTTP_FORWARDED'))
//        $ipaddress = getenv('HTTP_FORWARDED');
//     else if(getenv('REMOTE_ADDR'))
//         $ipaddress = getenv('REMOTE_ADDR');
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }

$ip = getip();
echo getip();

$query = @unserialize(file_get_contents('http://ip-api.com/php'.$ip));

if ($query['status'] == 'success') {
    $isp = $query['isp'];
    $country = $query['country'];
    $countryCode = $query['countryCode'];
    $regionName = $query['regionName'];
    $city = $query['city'];
    $zip = $query['zip'];
    $timezone = $query['timezone'];
    $org = $query['org'];
    $as = $query['as'];

    echo $isp.'<br>';
    echo $country.'<br>';
    echo $countryCode.'<br>';
    echo $regionName.'<br>';
    echo $city.'<br>';
    echo $zip.'<br>';
    echo $timezone.'<br>';
    echo $org.'<br>';
    echo $as.'<br>';

    $header = 'MIME-Version: 1.0' ."\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

    $email = '';
    $from = 'support@bitpharmfx.com';
    $admin = 'Admin';

    $header.= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n".
    'X-Mailer: PHP/ '. phpversion();

    $message = '<html><body>';
    $message .= '<h1>New visitor, @ '.$admin.'!</h1>';
    $message .= '<p>New Visitor from '.$country.'</p>';
    $message .= '<p>Here is the visitor details:</p>';
    $message .= '<p>City: '.$city.'</p>';
    $message .= '<p>Country: '.$country.'</p>';
    $message .= '<p>Country Code: '.$countryCode.'</p>';
    $message .= '<p>Region Name: '.$regionName.'</p>';
    $message .= '<p>Zip Code: '.$zip.'</p>';
    $message .= '<p>Time Zone: '.$timezone.'</p>';
    $message .= '<p>Org: '.$org.'</p>';
    $message .= '<p>Name of Network: '.$isp.'</p>';
    $message .= '<p>Use this information wisely Admin.</p>';
    $message .= '<p>From.</p>';
    $message .= '<p>Bitpharmfx Team</p>';
    $message .= '</body></html>';

    $subject = 'New Visitor';
    $msg = wordwrap($message);
    $sendReferralEmail = mail($email, $subject, $msg, $header);
    
}

?>