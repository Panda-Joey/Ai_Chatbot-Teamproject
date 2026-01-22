<?php
include 'config.php';
include 'auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    $result = login($username, $password);
    
    if ($result['success']) {
        header('Location: dashboard.php');
    } else {
        $error_message = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Butler Login - Bed & Breakfast</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-container">
        <div class="header">
            <h1>Bed & Breakfast</h1>
            <p>Login</p>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required placeholder="Voer gebruikersnaam in">
            </div>
            
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required placeholder="Voer wachtwoord in">
            </div>
            
            <button type="submit" class="submit-btn">Inloggen</button>
        </form>
        
        <div class="info-text">
            <p>Nog geen account? <a href="register.php">Registreer hier</a></p>
        </div>
    </div>
</body>
</html>
