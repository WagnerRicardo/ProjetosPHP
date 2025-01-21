<?php
    require './libs/PHPmailer/Exception.php';
    require './libs/PHPmailer/Oauth.php';
    require './libs/PHPmailer/PHPMailer.php';
    require './libs/PHPmailer/POP3.php';
    require './libs/PHPmailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $destino = null;
        private $assunto = null;
        private $mensagem = null;
        private $status = ['codigo' => null, 'descricao' => ''];

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function validaMensagem(){
            if(empty($this->destino) || empty($this->assunto) || empty($this->mensagem)){
                $status['codigo'] = 2;
                return false;
            }
            return true;
        }
    }

    $msg = new Mensagem();

    $msg->__set('destino', $_POST['destino']);
    $msg->__set('assunto', $_POST['assunto']);
    $msg->__set('mensagem', $_POST['mensagem']);

    if(!$msg->validaMensagem()){
        echo 'Informações invalidas';
        header('Location: index.php');
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'saturnchan42@gmail.com';                     //SMTP username
        $mail->Password   = 'etjz svhm aeoa junv ';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('saturnchan42@gmail.com', 'remetente');
        $mail->addAddress($msg->__get('destino'), 'destinatario');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $msg->__get('assunto');
        $mail->Body    = $msg->__get('mensagem');
        $mail->AltBody = $msg->__get('mensagem');

        $mail->send();

        $status['codigo'] = 1;
        $status['descricao'] = 'Mensagem foi enviada com sucesso para o e-mail: '. $msg->__get('destino') . '.';

    } catch (Exception $e) {

        $status['codigo'] = 2;
        $status['descricao'] = "Houve um Erro ao enviar o e-mail: {$mail->ErrorInfo}";

    }
?>

<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

            <div class="container">
                <?php 
                    if($status['codigo'] == 1){
                        echo '<h1 class="display-4 text-success">Mensagem enviada com sucesso!</h1>';
                        echo "<p>{$status['descricao']}</p>";
                    }
                    if($status['codigo'] == 2){
                        echo '<h1 class="display-4 text-danger">Ops!</h1>';
                        echo "<p>{$status['descricao']}</p>";
                    }
                
                ?>
                <a href="index.php" class="btn btn-info btn-lg mt-5 text-white">Voltar</a>
            </div>

	</body>
</html>