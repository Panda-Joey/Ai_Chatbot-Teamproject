<?php
include 'config.php';
include 'auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

// rol check
$username = $_SESSION['username'];
$dbUser = mysqli_real_escape_string($conn, $username);
$roleQueryResult = mysqli_query($conn, "SELECT role FROM gebruikers WHERE username = '$dbUser' LIMIT 1");
$is_boss = false;
if ($roleQueryResult && mysqli_num_rows($roleQueryResult) === 1) {
    $roleRow = mysqli_fetch_assoc($roleQueryResult);
    if (isset($roleRow['role']) && $roleRow['role'] === 'boss') $is_boss = true;
}

if (!$is_boss) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $answerText = isset($_POST['antwoord']) ? trim($_POST['antwoord']) : '';
    if ($questionId <= 0 || $answerText === '') {
        header('Location: dashboard.php');
        exit;
    }

    $answerEscaped = mysqli_real_escape_string($conn, $answerText);
    $updateSql = "UPDATE ai_vraag SET antwoord = '$answerEscaped', beantwoord = 1 WHERE id = $questionId";
    mysqli_query($conn, $updateSql);

    header('Location: dashboard.php');
    exit;
}

$questionId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($questionId <= 0) {
    header('Location: dashboard.php');
    exit;
}

$q = mysqli_query($conn, "SELECT id, vraag, antwoord, beantwoord FROM ai_vraag WHERE id = $questionId LIMIT 1");
if (!($q && mysqli_num_rows($q) === 1)) {
    header('Location: dashboard.php');
    exit;
}

$row = mysqli_fetch_assoc($q);
$questionText = htmlspecialchars($row['vraag']);
$existingAnswer = htmlspecialchars($row['antwoord']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Beantwoord vraag</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container qcard">
        <div class="questiontext"><?php echo $questionText; ?></div>
        <form method="post" action="answer.php">
            <input type="hidden" name="id" value="<?php echo (int)$questionId; ?>">
            <div class="qcard">
                <textarea name="antwoord" class="autosize" required><?php echo $existingAnswer; ?></textarea>
                <div class="actions">
                    <button class="submit-btn" type="submit">Opslaan en markeren als beantwoord</button>
                </div>
            </div>
        </form>
    </div>

    <script>
    // maakt de tekst balk groter wanneer de balk vol is met tekst
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
</body>
</html>
