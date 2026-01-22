<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vraag = $_POST['vraag'];

    $sql = "INSERT INTO vraag (vraag, beantwoord) VALUES (?,0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $vraag);

    if ($stmt->execute()) {
        echo "Vraag word binnenkort beantwoord.";
    } else {
        echo "Er is iets mis gegaan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vraag indienen</title>
    <link rel="stylesheet" href="TP.css">
</head>
<body>

<h2>Stel je vraag</h2>

<form action="#" method="post">

    <label>
        Vraag:<br>
        <textarea name="vraag" rows="4" required></textarea>
    </label><br><br>

    <button type="submit">Versturen</button>
</form>

</body>
</html>
