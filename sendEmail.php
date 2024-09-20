<?php
include 'inc/dbConnection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true);

try {
    $eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $to = isset($_GET['email']) ? $_GET['email'] : '';

    $stmt = $pdo->prepare('SELECT title, description, date, location FROM eventos WHERE id = :id');
    $stmt->execute(['id' => $eventId]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$evento) {
        throw new Exception('Evento não encontrado.');
    }

    if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'teste.agendacrv240920@gmail.com'; 
        $mail->Password = 'testecrv24'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('teste.agendacrv240920@gmail.com', 'Teste De Envio CRV');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Lembrete de Evento';
        
        $body = "Lembrete da tarefa \"{$evento['title']}\"<br>" .
                "Descrição: {$evento['description']}<br>" .
                "Data: " . date('d/m/Y', strtotime($evento['date'])) . "<br>" .
                "Localização: {$evento['location']}";

        $mail->Body = $body;

        $mail->send();
        echo 'Email enviado com sucesso.';
    } else {
        echo 'Endereço de e-mail inválido.';
    }
} catch (Exception $e) {
    echo 'Email não pôde ser enviado. Erro: ',$e, $mail->ErrorInfo;
}
?>
