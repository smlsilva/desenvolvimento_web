<?php
include 'logs/fileCreate.php';
include 'database/conn.php';
include 'database/update.php';
include 'settings/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar email</title>
    <style>
        html {
            font-family: sans-serif
        }
    </style>
</head>
<body>
    <?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './lib/vendor/autoload.php';

        $mail = new PHPMailer(true);
        
        date_default_timezone_set('America/Sao_Paulo');
        $dateAndTime = date('d/m/Y H:i:s');
        $dateToRename = date('d_m_y');
        $dateNow = date('d/m/Y');
        $timeNow = date('H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];

    try {

        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Exibe informações do processo de envio
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                        //Send using SMTP
        $mail->Host       = 'mail.suportespi.com.br';           //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                               //Enable SMTP authentication
        $mail->Username   = $username;                          //SMTP username
        $mail->Password   = $password;                          //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have

    //Remetente e Destinatário 
        $mail->setFrom($username, 'Suporte SPI');          // Origem
        
    //Conteúdo
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //somente texto
        //Enviar
        
        $conn->query('UPDATE rit SET RESUMO = UPPER(RESUMO)');
        $conn->query('UPDATE rit SET SITUACAO = UPPER(SITUACAO)');
        $conn->query($updateReplace);

        while($data = $enviarEmailRede->fetch(PDO::FETCH_OBJ)){
                
                $email = $data->EMAIL_SUPERVISOR_DE_REDE;
                $nome  = $data->SUPERVISOR_DE_REDE;
                $cargo = 'SUPERVISOR_DE_REDE';

                $mail->addAddress($email, $nome);   //Destinatário
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Resposta Automática';                 //Assunto
                $mail->Body    = $body;
        
                $mail->send();
                registro($email, $nome, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
        }
        
        while($datas = $consulta_registros->fetch(PDO::FETCH_OBJ)) {
            
            $day_now = date('d');
            $month_now = date('m');
            $year_now = date('Y');

            $day = $datas->DATA_ATUAL[0].''.$datas->DATA_ATUAL[1];
            $month = $datas->DATA_ATUAL[3].''.$datas->DATA_ATUAL[4];
            $year = $datas->DATA_ATUAL[6].''.$datas->DATA_ATUAL[7].''.$datas->DATA_ATUAL[8].''.$datas->DATA_ATUAL[9];

            if(($day < $day_now) or ($month < $month_now) or ($year < $year_now)) {

                if($day < $day_now) {

                    if($day_now - $day == 1) {
                        
                        while($consulta_area = $enviarEmailArea->fetch(PDO::FETCH_OBJ)) {
                            $nome_area = $consulta_area->SUPERVISOR_DE_AREA;
                            $email_area = $consulta_area->EMAIL_SUPERVISOR_DE_AREA;
                            $cargo = 'SUPERVISOR_DE_AREA';
    
                            $mail->addAddress($email_area, $nome_area);   //Destinatário
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Resposta Automática';                 //Assunto
                            $mail->Body    = $body;
            
                            registro($email_area, $nome_area, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                            $mail->send();
                        }
    
                   } else if(($day_now - $day >= 2) and ($day_now - $day <= 20)) {
                    
                        while($consulta_coordenador = $enviarEmailCoordenador->fetch(PDO::FETCH_OBJ)) {
                            $nome_coordenador = $consulta_coordenador->COORDENADOR;
                            $email_coordenador = $consulta_coordenador->EMAIL_COORDENADOR;
                            $cargo = 'COORDENADOR';
    
                            $mail->addAddress($email_coordenador, $nome_coordenador);   //Destinatário
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Resposta Automática';                 //Assunto
                            $mail->Body    = $body;
                            
                            registro($email_coordenador, $nome_coordenador, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                            $mail->send();
                        }
    
                   } else if (($day_now - $day > 20) and ($day_now <= 30)) {
                    
                        while($consulta_gerente = $enviarEmailGerente->fetch(PDO::FETCH_OBJ)) {
                            $nome_gerente = $consulta_gerente->GERENTE;
                            $email_gerente = $consulta_gerente->EMAIL_GERENTE;
                            $cargo = 'GERENTE';
    
                            $mail->addAddress($email_gerente, $nome_gerente);   //Destinatário  
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Resposta Automática';                 //Assunto
                            $mail->Body    = $body;
            
                            registro($email_gerente, $nome_gerente, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                            $mail->send();
                        }    
                   }
                }

            } else {
                echo 'Sem registro';
            }
        }

        $mail->addAddress('gustavo.balmeida@telefonica.com', 'Gustavo Almeida');
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resposta Automática';                 //Assunto
        $mail->Body    = $body;
        
        $mail->addAddress('lima.eduardo@telefonica.com', 'Eduardo de Lima');
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resposta Automática';                 //Assunto
        $mail->Body    = $body;
        
        //registro($email, $nome, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
        $mail->send();
        
        } catch (Exception $e) {
        echo "<p style='color:#e27777;background: rgba(0, 0, 0, 0.5);text-align: center;font-size: 1rem;padding: 17px;font-weight: bold'>Falha no envio da mensagem: Mailer Error: {$mail->ErrorInfo}</p>";
        }
    // Configurações do servidor
    ?>
</body>
</html>