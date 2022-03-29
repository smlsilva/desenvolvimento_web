<?php
function registro($email = 'null', $nome = 'null', $dateNow){
    if(file_exists('registro.log')){
        $file = fopen('registro.log', 'a');
        fwrite($file, $email.'->'.$nome.' '. $dateNow. ' ');
    }else {
        file_put_contents('registro.log',$email.'->'.$nome. ' '. $dateNow. ' ');
    }
}
?>