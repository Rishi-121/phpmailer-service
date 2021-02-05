<?php

include('./PHPMailer/PHPMailerAutoload.php');

$html = "This is the HTML message body <b>in bold!</b>";

echo smtp_mailer('USER_MAIL_ID', 'Here is the subject', $html);
function smtp_mailer($to, $subject, $msg)
{
    try {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 3;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Host = 'MAIL_HOST_NAME';
        $mail->Port = 587;
        $mail->Username = 'SMTP_EMAIL_ID';
        $mail->Password = 'PASSWORD';

        $mail->SetFrom('SMTP_EMAIL_ID');
        $mail->AddAddress($to);

        $mail->IsHTML(true);
        $mail->Charset = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->SMTPOptions = array('ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        ));

        return $mail->send() ? 'Message has been sent' : 'Error!';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
