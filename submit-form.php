<?php
function sanitizeInput($data, $filter) {
    return filter_input(INPUT_POST, $data, $filter);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $name = sanitizeInput('name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = sanitizeInput('email', FILTER_SANITIZE_EMAIL);
    $subject = sanitizeInput('subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $message = sanitizeInput('message', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($name && $email && $subject && $message && isValidEmail($email)) {
        $to = "ambrechirazi08@gmail.com";
        $headers = "From: $email\r\n";
        $body = "Nom: $name\nEmail: $email\nSujet: $subject\nMessage:\n$message";

        if (mail($to, $subject, $body, $headers)) {
            echo "Message envoyé avec succès.";
        } else {
            echo "Échec de l'envoi du message.";
        }
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
