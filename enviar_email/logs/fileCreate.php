<?php

function registro($email = 'null', $nome = 'null', $dateAndTime, $dateToRename, $dateNow, $timeNow, $funcion){
    
    $conn = new PDO('mysql:host=167.114.1.72; dbname=suportes_suportespi','suportes_samuel', 'LQ6KUvI0Ap*3');
    $query_reg = $conn->prepare('INSERT INTO tb_registro (EMAIL, NOME, DATA_ATUAL, HORA_ATUAL, CARGO) VALUES (?,?,?,?,?)');
    $query_reg->execute([$email, $nome, $dateNow, $timeNow, $funcion]);

    $msg = "[$dateNow] [INFO]: EMAIL:[$email] NOME:[$nome] CARGO:[$funcion]";
    
    if(file_exists('registro_'.$dateToRename.'.log')){
        $file = fopen('registro_'.$dateToRename.'.log', 'a');
        fwrite($file, $msg);

    }else {
        file_put_contents('registro_'.$dateToRename.'.log', $msg);
    }
}

?>