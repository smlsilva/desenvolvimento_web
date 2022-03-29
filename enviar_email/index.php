<?php
include 'fileCreate.php';
include 'conn.php';
include 'config.php';
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
    
    // Importar classes PHPMailer para o namespace global
    // Eles devem estar no topo do seu script, não dentro de uma função
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Carrega o autoloader do Composer
    require './lib/vendor/autoload.php';

    // Cria uma instância; passar `true` permite exceções
        $mail = new PHPMailer(true);
        
        date_default_timezone_set('America/Sao_Paulo');
        $dateNow = date('d/m/Y H:i:s');

    try {

        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Exibe informações do processo de envio
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.suportespi.com.br';       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $username;    //SMTP username
        $mail->Password   = $password;                          //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have

    //Remetente e Destinatário 
        $mail->setFrom('automatico@suportespi.com.br', 'Suporte SPI');          // Origem
        
    //Conteúdo
        $date = [
            'day' => date('d'),
            'month' => date('m'),
            'year' => date('Y'),
        ];

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //somente texto
        //Enviar
        
        if(isset($_GET['name'])){
            while($data = $consulta_supervisor_rede->fetch(PDO::FETCH_OBJ)){
                
                echo $data->SUPERVISOR_DE_REDE . '</br>';
                echo $data->EMAIL_SUPERVISOR_DE_REDE . '</br>';
                
                $email = $data->EMAIL_SUPERVISOR_DE_REDE;
                $nome  = $data->SUPERVISOR_DE_REDE;
                
                $mail->addAddress($email, $nome);   //Destinatário
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Resposta Automática';                 //Assunto
                $mail->Body    = '
                <html>
                    <head>
                        <title> Resposta Automática </title>
                    </head>
                    <body>
                        <p>Olá! Solicitante, recebemos a solicitação de Acesso para o colaborador <strong>'.$nome.'</strong> dia '.date('d') .'/'. date('m').'/'.date('Y').', 
                        status inicial é <strong> Solicitado</strong>.</p>
                        <p>O prazo médio é de 7 a 15 dias e você será informado a cada etada do processo até sua conclusão .</p>
        
        
                    </body>
                </html>
                
                '; //html
            registro($email, $nome, $dateNow);
            $mail->send();
        }
        }

    /*while($data = $consulta_supervisor_area->fetch(PDO::FETCH_OBJ)){
            
        echo $data->SUPERVISOR_DE_AREA . '</br>';
        echo $data->EMAIL_SUPERVISOR_DE_AREA . '</br>';
        
        $email = $data->EMAIL_SUPERVISOR_DE_AREA;
        $nome  = $data->SUPERVISOR_DE_AREA;
        
        $mail->addAddress($email, $nome);   //Destinatário
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resposta Automática';                 //Assunto
        $mail->Body    = '
        <html>
            <head>
                <title> Resposta Automática </title>
            </head>
            <body>
                <p>Olá! Solicitante, recebemos a solicitação de Acesso para o colaborador <strong>'.$nome.'</strong> dia '.date('d') .'/'. date('m').'/'.date('Y').', 
                status inicial é <strong> Solicitado</strong>.</p>
                <p>O prazo médio é de 7 a 15 dias e você será informado a cada etada do processo até sua conclusão .</p>


            </body>
        </html>
        
        '; //html
    $mail->send();
    }*/

    /*while($data = $consulta_coordenador->fetch(PDO::FETCH_OBJ)){
            
        echo $data->COORDENADOR . '</br>';
        echo $data->EMAIL_COORDENADOR . '</br>';
        
        $email = $data->EMAIL_COORDENADOR;
        $nome  = $data->COORDENADOR;
        
        $mail->addAddress($email, $nome);   //Destinatário
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resposta Automática';                 //Assunto
        $mail->Body    = '
        <html>
            <head>
                <title> Resposta Automática </title>
            </head>
            <body>
                <p>Olá! Solicitante, recebemos a solicitação de Acesso para o colaborador <strong>'.$nome.'</strong> dia '.date('d') .'/'. date('m').'/'.date('Y').', 
                status inicial é <strong> Solicitado</strong>.</p>
                <p>O prazo médio é de 7 a 15 dias e você será informado a cada etada do processo até sua conclusão .</p>


            </body>
        </html>
        
        '; //html
    $mail->send();
    }*/

    /*while($data = $consulta_gerente->fetch(PDO::FETCH_OBJ)){
            
        echo $data->GERENTE . '</br>';
        echo $data->EMAIL_GERENTE . '</br>';
        
        $email = $data->EMAIL_GERENTE;
        $nome  = $data->GERENTE;
        
        $mail->addAddress($email, $nome);   //Destinatário
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resposta Automática';                 //Assunto
        $mail->Body    = '
        <html>
            <head>
                <title> Resposta Automática </title>
            </head>
            <body>
                <p>Olá! Solicitante, recebemos a solicitação de Acesso para o colaborador <strong>'.$nome.'</strong> dia '.date('d') .'/'. date('m').'/'.date('Y').', 
                status inicial é <strong> Solicitado</strong>.</p>
                <p>O prazo médio é de 7 a 15 dias e você será informado a cada etada do processo até sua conclusão .</p>


            </body>
        </html>
        
        '; //html
    $mail->send();
    }*/
        //echo "<p style='color:#8fe28f;background: rgba(0, 0, 0, 0.5);text-align: center;font-size: 1rem;padding: 17px;font-weight: bold'>Mensagem enviada com sucesso!</p>";
        } catch (Exception $e) {
        echo "<p style='color:#e27777;background: rgba(0, 0, 0, 0.5);text-align: center;font-size: 1rem;padding: 17px;font-weight: bold'>Falha no envio da mensagem: Mailer Error: {$mail->ErrorInfo}</p>";
        }
    // Configurações do servidor
    ?>
    
    <a href='index.php?name=true'>Execute PHP Function</a>

</body>
</html>