<?php

    $to = 'user2barbier@gmail.com';

    $subject = 'Test';

    $from = 'test@email.com';

     

    // To send HTML mail, the Content-type header must be set

    $headers  = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

     

    // Create email headers

    $headers .= 'From: '.$from."\r\n".

        'Reply-To: '.$from."\r\n" .

        'X-Mailer: PHP/' . phpversion();

     

    // Compose a simple HTML email message

$message = '<html><body>';

$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

$message .= "<tr><td><img src='http://www.phpgang.com/wp-content/uploads/gang.jpg' alt='PHP Gang' /></td></tr>";

$message .= "<tr><td colspan=2>Dear \$Name,<br /><br />We thank you for subscribe phpgang.com you are now in phpgang download list you can download any source package from our site.</td></tr>";

$message .= "<tr><td colspan=2 font='colr:#999999;'><I>PHPGang.com<br>Solve your problem. :)</I></td></tr>"; 

$message .= "</table>";

$message .= "</body></html>";

     

    // Sending email

    if(mail($to, $subject, $message, $headers)){

        echo 'Your mail has been sent successfully.';

    } else{

        echo 'Unable to send email. Please try again.';

    }

    ?>

