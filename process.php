<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$name = trim((string) filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW));
$email = trim((string) filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW));
$password = (string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if ($name === '' || $email === '' || $password === '') {
    http_response_code(400);
    exit('All fields are required.');
}

if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
    http_response_code(400);
    exit('Name must be between 2 and 100 characters.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit('Invalid email address.');
}

if (strlen($password) < 8 || strlen($password) > 72) {
    http_response_code(400);
    exit('Password must be between 8 and 72 characters.');
}

try {
    $databaseFile = __DIR__ . '/secure_db.sqlite';
    $pdo = new PDO('sqlite:' . $databaseFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )'
    );

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash)
         VALUES (:name, :email, :password_hash)'
    );

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password_hash' => $passwordHash,
    ]);
} catch (PDOException $exception) {
    if ($exception->getCode() === '23000') {
        http_response_code(409);
        exit('That email address is already registered.');
    }

    http_response_code(500);
    exit('A server error occurred while saving your information.');
}

$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Complete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2933;
            padding: 32px 16px;
        }

        main {
            max-width: 520px;
            margin: 0 auto;
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        a {
            color: #0f766e;
        }
    </style>
</head>
<body>
    <main>
        <h1>Registration Successful</h1>
        <p>Thank you, <?= $safeName ?>. Your account information was stored securely.</p>
        <p><a href="index.html">Return to the registration form</a></p>
    </main>
</body>
</html>
