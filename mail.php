<?php
// sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // pobranie danych z formularza
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);
    
    // sprawdzenie, czy pola zostały wypełnione
    if (empty($name) || empty($email) || empty($message)) {
        echo "Proszę wypełnić wszystkie pola.";
        exit;
    }
    
    // sprawdzenie, czy adres e-mail jest poprawny
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Nieprawidłowy adres e-mail.";
        exit;
    }
    
    // sprawdzenie, czy pole z kodem antyspamowym jest puste
    if (!empty($_POST["findme"])) {
        echo "Wysłanie formularza nie powiodło się.";
        exit;
    }
    
    // ustawienie odbiorcy, tematu i treści e-maila
    $to = "admin@cyberads.pl";
    $subject = "Wiadomość ze strony internetowej";
    $body = "Od: $name\n E-mail: $email\n Wiadomość:\n $message";
    
    // ustawienie nagłówków e-maila
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // wysłanie e-maila
    if (mail($to, $subject, $body, $headers)) {
        echo "Wiadomość została wysłana.";
    } else {
        echo "Wysłanie wiadomości nie powiodło się.";
    }
    
    // funkcja do testowania danych z formularza
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>
