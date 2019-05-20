<?php
setcookie('injection','JHF1ZXJ5PSJ1c2VyL3VzZXJuYW1lW0BuYW1lPSciLiR1c2VyLiInXSI7',time()+100000);
if(file_exists('users.xml')) {
    $xml = simplexml_load_file('users.xml');
    $user=$_GET['user'];
    $query="user/username[@name='".$user."']";
    $ans = $xml->xpath($query);
    foreach($ans as $x => $x_value)
    {
        echo $x.":  " . $x_value;
        echo "<br />";
    }
}
?>