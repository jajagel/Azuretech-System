<?php
function getAddress($latitude, $longitude)
{

    $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&key=AIzaSyCy5e4PTG0mVDPWmxnYJdGgh8PRxe8MxI4';
    $jsons = @file_get_contents($url);
    $data = json_decode($jsons,true);
    $address = $data['results'][0]['formatted_address'];
 return $address;
}
$latitude=$_POST['lat'];
$longitude=$_POST['lng'];


$address=getAddress($latitude, $longitude);
echo $address;

// produces output
// Address: 58 Brooklyn Ave, Brooklyn, NY 11216, USA

?>