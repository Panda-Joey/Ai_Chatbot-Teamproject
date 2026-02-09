<?php
include 'db.php';
include 'auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
    
    $result = register($username, $email, $password, $password_confirm);
    
    if ($result['success']) {
        header('Location: login.php');
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
    <title>Registreren - AI Butler</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container auth-container">
        <div class="header">
            <h1>Bed & Breakfast</h1>
            <p>Registreer voor AI Butler</p>
        </div>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required placeholder="Kies een gebruikersnaam">
            </div>
            
            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" required placeholder="email@email.com">
            </div>
            
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required placeholder="Minimaal 6 karakters">
            </div>
            
            <div class="form-group">
                <label for="password_confirm">Bevestig Wachtwoord</label>
                <input type="password" id="password_confirm" name="password_confirm" required placeholder="Herhaal wachtwoord">
            </div>
            
            <button type="submit" class="submit-btn">Registreren</button>
        </form>
        
        <div class="login-link">
            <p>Heb je al een account? <a href="login.php">Log hier in</a></p>
        </div>
    </div>
</body>
</html>
