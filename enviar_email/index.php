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

        while($data = $consulta_email_rede->fetch(PDO::FETCH_OBJ)){
                
                $email = $data->EMAIL_SUPERVISOR_DE_REDE;
                $nome  = $data->SUPERVISOR_DE_REDE;
                $cargo = 'SUPERVISOR_DE_REDE';

                $mail->addAddress($email, $nome);   //Destinatário
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Resposta Automática';                 //Assunto
                $mail->Body    = $body;

                //$mail->send();
                //registro($email, $nome, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
        }

        while($geral = $consulta_geral->fetch(PDO::FETCH_OBJ)){
            
            $day_now   = date('d');
            $month_now = date('m');
            $year_now  = date('Y');
            
            $day   = $geral->DATA_RIT[8].''.$geral->DATA_RIT[9];
            $month = $geral->DATA_RIT[5].''.$geral->DATA_RIT[6];
            $year  = $geral->DATA_RIT[0].''.$geral->DATA_RIT[1].''.$geral->DATA_RIT[2].''.$geral->DATA_RIT[3];

            $firstDate = $year.'-'.$month.'-'.$day;
            $secondDate = $year_now.'-'.$month_now.'-'.$day_now;
            
            $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

            $years  = floor($dateDifference / (365 * 60 * 60 * 24));
            $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

            if($days == 1) {
                
                while($ritPendente = $consulta_email_area->fetch(PDO::FETCH_OBJ)) {
            
                    if($ritPendente->DATA_RIT == $geral->DATA_RIT) {

                        $nome_area = $ritPendente->SUPERVISOR_DE_AREA;
                        $email_area = $ritPendente->EMAIL_SUPERVISOR_DE_AREA;
                        $cargo = 'SUPERVISOR_DE_AREA';

                        $mail->addAddress($email_area, $nome_area);   //Destinatário
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Resposta Automática';                 //Assunto
                        $mail->Body    = $body;
            
                        //registro($email_area, $nome_area, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                        //$mail->send();
                        }
                       }
                    }
                    else if($days == 2) {

                        while($ritPendente = $consulta_email_coodenador->fetch(PDO::FETCH_OBJ)) {
                
                            if($ritPendente->DATA_RIT == $geral->DATA_RIT){
                                
                                $nome_coordenador = $ritPendente->COORDENADOR;
                                $email_coordenador = $ritPendente->EMAIL_COORDENADOR;
                                $cargo = 'COORDENADOR';
                                
                                $mail->addAddress($email_coordenador, $nome_coordenador);   //Destinatário
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'Resposta Automática';                 //Assunto
                                $mail->Body    = $body;
                                        
                                //registro($email_coordenador, $nome_coordenador, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                                //$mail->send();
                            }
                            }
                        }
                        else if($days >= 3) {

                            while($ritPendente = $consulta_email_gerente->fetch(PDO::FETCH_OBJ)) {
                                    
                                if($ritPendente->DATA_RIT == $geral->DATA_RIT){
                                    
                                    $nome_gerente = $ritPendente->GERENTE;
                                    $email_gerente = $ritPendente->EMAIL_GERENTE;
                                    $cargo = 'GERENTE';
                
                                    $mail->addAddress($email_gerente, $nome_gerente);   //Destinatário  
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = 'Resposta Automática';                 //Assunto
                                    $mail->Body    = $body;
                    
                                    //registro($email_gerente, $nome_gerente, $dateAndTime, $dateToRename, $dateNow, $timeNow, $cargo);
                                    //$mail->send();

                                }
                            }
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
        //$mail->send();
        
        } catch (Exception $e) {
            echo "<p style='color:#e27777;background: rgba(0, 0, 0, 0.5);text-align: center;font-size: 1rem;padding: 17px;font-weight: bold'>Falha no envio da mensagem: Mailer Error: {$mail->ErrorInfo}</p>";
        }
    // Configurações do servidor
    ?>
</body>
</html>