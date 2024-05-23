<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = "jha.abhinav0207@gmail.com";  // Replace with your email address
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/html\r\n";

        $email_content = "<h2>New Contact Message</h2>";
        $email_content .= "<p><strong>Name:</strong> $name</p>";
        $email_content .= "<p><strong>Email:</strong> $email</p>";
        $email_content .= "<p><strong>Subject:</strong> $subject</p>";
        $email_content .= "<p><strong>Message:</strong><br>$message</p>";

        if (mail($to, $subject, $email_content, $headers)) {
            echo json_encode(["message" => "Your message has been sent. Thank you!"]);
        } else {
            echo json_encode(["message" => "Something went wrong. Please try again."]);
        }
    } else {
        echo json_encode(["message" => "Invalid email address. Please check and try again."]);
    }
} else {
    echo json_encode(["message" => "Invalid request method."]);
}
?>
