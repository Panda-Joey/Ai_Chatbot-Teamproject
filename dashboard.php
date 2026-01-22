<?php
include 'config.php';
include 'auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="logout">
        <form method="POST" action="logout.php">
            <button type="submit" class="logout-button">Uitloggen</button>
        </form>
    </div>
   <!-- vragenlijst voor de baas-->
<?php
$is_boss = false;
if (!empty($_SESSION['username'])) {
    $user = mysqli_real_escape_string($conn, $_SESSION['username']);
    $roleResult = mysqli_query($conn, "SELECT role FROM gebruikers WHERE username = '$user' LIMIT 1");
    if ($roleResult && mysqli_num_rows($roleResult) === 1) {
        $roleRow = mysqli_fetch_assoc($roleResult);
        if (isset($roleRow['role']) && $roleRow['role'] === 'boss') $is_boss = true;
    }
}

if ($is_boss) {
    echo '<div class="questions">';
    echo '<h2>Gestelde vragen</h2>';
    $questionsResult = mysqli_query($conn, "SELECT id, vraag, created_at FROM ai_vraag WHERE beantwoord = 0 ORDER BY created_at DESC");
    if ($questionsResult && mysqli_num_rows($questionsResult) > 0) {
        while ($questionRow = mysqli_fetch_assoc($questionsResult)) {
            $questionId = (int)$questionRow['id'];
            $questionText = htmlspecialchars($questionRow['vraag']);
            $createdAtRaw = $questionRow['created_at'];
            try {
                $dateTime = new DateTime($createdAtRaw, new DateTimeZone('UTC'));
                $dateTime->setTimezone(new DateTimeZone('Europe/Amsterdam'));
                $createdAt = $dateTime->format('d-m-Y H:i:s');
            } catch (Exception $exception) {
                $createdAt = htmlspecialchars($createdAtRaw);
            }

            echo "<div class=\"questionbox\">";
            echo "<div class=\"questiontext\">$questionText</div>";
            $answerFormLink = 'answer.php?id=' . $questionId;
            echo "<div class=\"questionactions\">";
            echo "<a class=\"answer-button\" href=\"$answerFormLink\">Beantwoorden</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo '<div class="noquestions">Geen nieuwe vragen op dit moment.</div>';
    }

    echo '</div>';
} else {
    echo '<div class="notboss">Welkom ' . htmlspecialchars($username) . '. Je hebt geen rechten om dit scherm te bekijken.</div>';
}
?>
</body>
</html>

<script>
//  maakt de tekst balk groter wanneer de balk vol is met tekst
document.addEventListener('input', function (event) {
    if (event.target && event.target.tagName.toLowerCase() === 'textarea' && event.target.classList.contains('autosize')) {
        const ta = event.target;
        ta.style.height = 'auto';
        ta.style.height = ta.scrollHeight + 'px';
    }
}, false);
window.addEventListener('load', function () {
    document.querySelectorAll('textarea.autosize').forEach(function(ta){ ta.style.height = 'auto'; ta.style.height = ta.scrollHeight + 'px'; });
});
</script>