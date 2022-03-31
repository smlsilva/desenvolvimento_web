<?php
function registro($email = 'null', $nome = 'null', $dateAndTime, $dateToRename, $dateNow, $timeNow, $ip = 'null'){
    
    //$conn = new PDO('mysql:host=localhost; dbname=tutocrudphp','root', '');
    $query_reg = $conn->prepare('INSERT INTO tb_registro (EMAIL, NOME, DATA_ATUAL, HORA_ATUAL, IP) VALUES (?,?,?,?,?)');
    $query_reg->execute([$email, $nome, $dateNow, $timeNow, $ip]);

    if(file_exists('registro_'.$dateToRename.'.log')){
        $file = fopen('registro_'.$dateToRename.'.log', 'a');
        fwrite($file, $email.'->'.$nome.' '. $dateNow. ' '. $ip);

    }else {
        file_put_contents('registro_'.$dateToRename.'.log', $email.' -> '.$nome. ' '. $dateAndTime. ' '. $ip);
    }
}
?>