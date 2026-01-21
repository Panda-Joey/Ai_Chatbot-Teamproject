<?php
include 'db.php';


$id = $_GET['id'] ?? null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $antwoord = $_POST['antwoord'];
    $keywoord = $_POST['keywoord'];

    $sql = "UPDATE vraag 
            SET antwoord = ?, keywoord = ?, beantwoord = 1
            WHERE idvraag = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $antwoord, $keywoord, $id);
    $stmt->execute();

    echo "<p>Vraag succesvol beantwoord.</p>";
}

// vraag ophalen om te tonen
$vraagData = null;

if ($id) {
    $sql = "SELECT vraag FROM vraag WHERE idvraag = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $vraagData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vraag beantwoorden</title>
    <link rel="stylesheet" href="TP.css">
</head>
<body>

<h2>Vraag beantwoorden</h2>

<?php if ($vraagData): ?>

    <p><strong>Vraag:</strong><br>
        <?= htmlspecialchars($vraagData['vraag']) ?>
    </p>

    <form method="post">

        <input type="hidden" name="id" value="<?= $id ?>">

        <label>
            Antwoord:<br>
            <textarea name="antwoord" rows="4" required></textarea>
        </label><br><br>

        <label>
            Keywoord (voor chatbot):<br>
            <input type="text" name="keywoord" required>
        </label><br><br>

        <button type="submit">Opslaan</button>

    </form>

<?php else: ?>

    <p>Geen geldige vraag geselecteerd.</p>

<?php endif; ?>

</body>
</html>
