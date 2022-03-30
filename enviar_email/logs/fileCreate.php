<?php
function registro($email = 'null', $nome = 'null', $dateNow, $time, $ip = 'null'){
    if(file_exists('registro_'.$time.'.log')){
        $file = fopen('registro_'.$time.'.log', 'a');
        fwrite($file, $email.'->'.$nome.' '. $dateNow. ' '. $ip);
    }else {
        file_put_contents('registro_'.$time.'.log', $email.'->'.$nome. ' '. $dateNow. ' '. $ip);
    }
}
?>