<h2><i>Who do you think you are?</i></h2>
<h3>Objective: gain access to the administrative menu</h3>
<!-- everything above this is not part of the challenge -->
<?php
if (!isset($_POST['submit'])){
    echo "<form action='index.php' method='post'><input type='submit' name='submit' value='Enter'></form>";
    exit;
}

$ua = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/(iphone)|(iPhone)|(IPHONE)|(ipad)|(iPad)|(IPAD)/',$ua)){
        echo "flag{2565907fbef6c6fc11fa88f5930dcfb4}";
    echo "<br><a href='index.php'>Back</a>";
}
else {
    echo "Sorry, the admin menu must be viewed from iphone;";
    echo "<br><a href='index.php'>Back</a>";
}
?>
