<?php
   include("config.php");
   session_start();
   
   if(isset($_POST['itemname']) && isset($_POST['itemprice'])) {

      if ( strcmp($_POST['itemname'],"cxk")==0 && strcmp($_POST['itemprice'],"168")==0 ) {
        $_SESSION['checkAns'] = true;
      }

      else {
        $_SESSION['checkAns'] = false;
      }

   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Question and Answer</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="navbar">
      <a href="#">JITCTF</a>
    </div>  

    <div class="centered-wrapper">
    <div class="centered-content">

    <form class="form-style-7" method="post">
      <a href="trueorfalse.php">Check out what we have in store</a> <br><br>
    <ul>
    <li>
        <label for="itemname">What is the secret item?</label>
        <input type="text" name="itemname" maxlength="100" value="">
        <span>Enter your answer here</span>
    </li>
    <li>
        <label for="itemprice">What is the price of the secret item?</label>
        <input type="text" name="itemprice" maxlength="100" value="">
        <span>Enter your answer here</span>
    </li>
    <li>
        <input type="submit" value="Submit my awesome answers" >
    </li>
    </ul>
    <br />
    <?php 
      if ($_SESSION['checkAns']==true) 
        echo "<b>flag{ef455c75c1434ea4f4a9b7a0bed4c75e}</b>"; 
      else if (isset($_SESSION['checkAns'])) 
        echo "Try harder.";
    ?>
    </form>

    </div>
    </div>
  </body>

</html>
