<?php
require_once "../admin/config.php";
// Getting data from the website settings table
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
    $semail              = $row['semail'];
    $remail              = $row['remail'];
}
    $valid = 1;
    $error_message = "";
    if(empty($_POST['name'])) {
        $valid = 0;
        $error_message .= "Nome completo não pode estar vazio
<br>";
    }
    if(empty($_POST['email'])) {
        $valid = 0;
        $error_message .= 'Endereço de email não pode estar vazio
<br>';
    } else {
    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	        $valid = 0;
	        $error_message .= 'Endereço de email deve ser válido
<br>';
	    } 
    }
    if(empty($_POST['subject'])) {
        $valid = 0;
        $error_message .= "Assunto não pode estar vazio
<br>";
    }
    if(empty($_POST['message'])) {
        $valid = 0;
        $error_message .= "A mensagem não pode estar vazia
<br>";
    }
    if($valid == 1) {
    		// Sending Email
    		$to = $remail;
		$from = $semail;
		$subject = 'email de contato';
		$message = 'Você recebeu um email de contato'.$config['site_title'].'<br><br>Sender Name: '.$_POST['name'].'<br><br>Sender Email: '.$_POST['email'].'<br><br>Subject: '.$_POST['subject'].'<br><br>Message: '.$_POST['message'];
		$headers = 'From: ' . $from . "\r\n" .'Reply-To: ' . $_POST['email'] . "\r\n" .'X-Mailer: PHP/' . phpversion() . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=ISO-8859-1\r\n";
		// Sending the email
		mail($to, $subject, $message, $headers);
?>
<div id="contactsuccess" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bem sucedido
</h4>
      </div>
      <div class="modal-body">
        <p>Sua mensagem foi enviada com sucesso
.<br>Nós entraremos em contato com você o mais breve possível!
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div id="contactsuccess" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Falha</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $error_message; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>