<?php
function areyouok($greeting){
    return preg_match('/Baby.*PHP/is',$greeting);
}

$greeting=@$_POST['greeting'];
if(!is_array($greeting)){
    if(!areyouok($greeting)){
        if(strpos($greeting,'Baby PHP')!==false){
            echo 'flag{dad3a37aa9d50688b5157698acfd7aee}';
        }else{
            echo 'Do you kNow .swp file?';
        }
    }else{
        echo 'Do you know PHP?';
    }
}
?>

