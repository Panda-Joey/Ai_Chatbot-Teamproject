<?php
include 'db.php'; 

function login($username, $password) {
    global $conn;
    
    if (empty($username) || empty($password)) {
        return array('success' => false, 'message' => 'Gebruikersnaam en wachtwoord zijn verplicht.');
    }
    
    $username = mysqli_real_escape_string($conn, $username);
    
    $sql = "SELECT id, username, email, password FROM gebruikers WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        return array('success' => false, 'message' => 'Databasefout: ' . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            
            return array('success' => true, 'message' => 'Succesvol ingelogd!');
        } else {
            return array('success' => false, 'message' => 'Ongeldig wachtwoord.');
        }
    } else {
        return array('success' => false, 'message' => 'Gebruiker niet gevonden.');
    }
}

function register($username, $email, $password, $password_confirm) {
    global $conn;
    
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        return array('success' => false, 'message' => 'Alle velden zijn verplicht.');
    }
    
    if ($password !== $password_confirm) {
        return array('success' => false, 'message' => 'Wachtwoorden komen niet overeen.');
    }
    
    if (strlen($password) < 6) {
        return array('success' => false, 'message' => 'Wachtwoord moet minimaal 6 karakters zijn.');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array('success' => false, 'message' => 'Ongeldig e-mailadres.');
    }
    
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    
    $check_sql = "SELECT id FROM gebruikers WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        return array('success' => false, 'message' => 'Gebruikersnaam of email bestaat al.');
    }
    
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $insert_sql = "INSERT INTO gebruikers (username, email, password, role) VALUES ('$username', '$email', '$password_hash', 'user')";
    
    if (mysqli_query($conn, $insert_sql)) {
        return array('success' => true, 'message' => 'Account succesvol aangemaakt!');
    } else {
        return array('success' => false, 'message' => 'Registratie mislukt: ' . mysqli_error($conn));
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
