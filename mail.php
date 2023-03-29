<?php
// Adres e-mail odbiorcy
$to = "adres_odbiorcy@example.com";

// Temat e-maila
$subject = "Wiadomość z formularza kontaktowego";

// Zawartość e-maila
$message = "Imię i nazwisko: " . $_POST['name'] . "\r\n";
$message .= "E-mail: " . $_POST['email'] . "\r\n";
$message .= "Wiadomość: " . $_POST['message'];

// Adres e-mail nadawcy
$from = $_POST['email'];

// Nagłówki e-maila
$headers = "From:" . $from . "\r\n";
$headers .= "Reply-To:" . $from . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Wysłanie e-maila
if(mail($to, $subject, $message, $headers)) {
    // Wyczyszczenie formularza
    $_POST = array();
    // Przekierowanie na stronę główną
    header("Location: index.html?success=true");
} else {
    echo "Wystąpił błąd podczas wysyłania wiadomości.";
}
?>
