<?php
static $indice = 1;
$nome = htmlspecialchars(strip_tags($_POST['nome']));
$endereco = htmlspecialchars(strip_tags($_POST['endereco']));
$email = htmlspecialchars(strip_tags($_POST['email']));
$telacampante = htmlspecialchars(strip_tags($_POST['telacampante']));
$nascimento = htmlspecialchars(strip_tags($_POST['dtnascimento']));
$responsavel = htmlspecialchars(strip_tags($_POST['responsavel']));
$telresponsavel = htmlspecialchars(strip_tags($_POST['telresponsavel']));
$medicamentos = htmlspecialchars(strip_tags($_POST['remedios']));

$refresh = '<meta http-equiv="refresh" content="1; url=../index.html#confirmacao-inscricao" />';

 if ($nome != '' && $email != '' && $endereco != '' && $nascimento != '' && $responsavel != '' && $telresponsavel != '')
 {
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer();

	$msg = '<html><head><meta charset="utf-8"></head><body>';
	$msg .= "<strong>NOME:</strong> $nome<br>";
    $msg .= "<strong>E-MAIL:</strong> $email<br>";
    $msg .= "<strong>ENDEREÇO:</strong> $endereco<br>";
    $msg .= "<strong>TELEFONE:</strong> $telacampante<br>";
    $msg .= "<strong>NASCIMENTO:</strong> $nascimento<br>";
    $msg .= "<strong>RESPONSÁVEL:</strong> $responsavel<br>";
    $msg .= "<strong>TELEFONE DO RESPONSÁVEL:</strong> $telresponsavel<br>";
    $msg .= "<strong>MEDICAMENTOS:</strong> $medicamentos<br><br><br>";
    $msg .= "</body></html>";

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;	// enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	$autenticacao = file('autenticacao.txt', FILE_IGNORE_NEW_LINES);//file_get_contents('senha.txt');
	$mail->Username   = $autenticacao[0];
	$mail->Password   = $autenticacao[1];

	$mail->SetFrom($email, $nome);
	$mail->Subject    = "Nova Inscricao AcaNPC 2015";
	$mail->AltBody    = "Para visualizar esta mensagem seu gerenciador de e-mail precisa estar habilitado para visualização de HTML."; // optional, comment out and test
	$mail->MsgHTML($msg);

	$address = "acanpcinscricoes@gmail.com";
	$mail->AddReplyTo($email, $nome);
	$mail->AddAddress($address, "Ministério NPC");

	
	if ($mail->Send())
    {
        echo '<script type="text/javascript">alert("Inscricao Efetuada!")</script>';

        $mailConfirmacao = new PHPMailer();
        $msgConfirmacao = '<html><head><meta charset="utf-8"></head><body>';
        $msgConfirmacao .= "Olá, <strong> $nome!</strong><br/>";
        $msgConfirmacao .= "Sua inscrição foi efetuada com sucesso.<br/><br/>";
        $msgConfirmacao .= "Para confirmar a inscrição efetue o pagamento dentro de 15 dias em nossas reuniões ou através do link do pagseguro oferecido em nosso site.<br/><br/><br/>";
        $msgConfirmacao .= "Em Cristo,<br/>Ministerio NpC.";
        $msgConfirmacao .= "</body></html>";
        $mailConfirmacao->IsSMTP(); // telling the class to use SMTP
		$mailConfirmacao->SMTPDebug  = 0;
		$mailConfirmacao->SMTPAuth   = true;                  // enable SMTP authentication
		$mailConfirmacao->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mailConfirmacao->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mailConfirmacao->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mailConfirmacao->Username   = $autenticacao[0];
		$mailConfirmacao->Password   = $autenticacao[1];            // GMAIL password
		$mailConfirmacao->SetFrom("acanpcinscricoes@gmail.com", "Ministerio NpC");
		$mailConfirmacao->Subject    = "Confirmacao de Inscricao AcaNPC 2015";
		$mailConfirmacao->AltBody    = "Para visualizar esta mensagem seu gerenciador de e-mail precisa estar habilitado para visualização de HTML."; // optional, comment out and test
		$mailConfirmacao->MsgHTML($msgConfirmacao);
		$mailConfirmacao->AddAddress($email, $nome);
		$mailConfirmacao->Send();

        exit ($refresh);    
    } else {
        echo '<script type="text/javascript">alert("Problema no envio da mensagem. Por favor tente mais tarde..")</script>';
    }
} else{
    echo '<script type="text/javascript">alert("Por favor preencha todos os campos.")</script>'; 
}
?>