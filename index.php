<?php 
include 'db.php';



if (isset($_POST['message'])) {
 $userMessage = strtolower(trim($_POST['message'] ?? ''));

 $sql = "SELECT antwoord, keywoord FROM vraag WHERE beantwoord = 1";
 $result = $conn->query($sql);

 $bestScore = 0;
 $bestAnswer = "Dank u voor uw vraag. Een medewerker helpt u zo snel mogelijk.";

 while ($row = $result->fetch_assoc()) {
    $keywords = explode(',', strtolower($row['keywoord'] ?? ''));
    $score = 0;

    foreach ($keywords as $kw) {
        if ($kw !== "" && strpos($userMessage, trim($kw)) !== false) {
            $score++;
        }
    }

    if ($score > $bestScore) {
        $bestScore = $score;
        $bestAnswer = $row['antwoord'];
    }
}

echo $bestAnswer;
exit;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Hotel Chatbot</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>


<h2>Chat met onze hotel assistent</h2>
<div class = "ai_chat">

    <div id="chatBox" >
        <?php echo "Welkom bij de AI chatbot van Bed & Breakfast!"?><br><br>


<ul id="questionList" style="display:none;">
>

    <?php
        $sql = "SELECT vraag, antwoord FROM vraag WHERE antwoord IS NOT NULL";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            ?>
    <li 
        onclick="showAnswer(this)"
        data-answer="<?= htmlspecialchars($row['antwoord']) ?>"
        style="cursor:pointer;"
    >
        <?= htmlspecialchars($row['vraag']) ?>
    </li>
    
    <?php
}

?>

<li>
    <a href="TP.php">Stel hier je gewenste vraag!</a>
</li>

</ul>

                
         

    </div>

<input id="messageInput" name="message" method="post" type="text" placeholder="Typ je bericht..." >
<button onclick="sendMessage()">Verstuur</button>
</div>

<script src="bericht.js"></script>
</body>
</html>

