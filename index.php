<?php 
include 'db.php'


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
        $sql = "SELECT vraag, antwoord FROM vraag";
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

<input id="messageInput" type="text" placeholder="Typ je bericht..." >
<button onclick="sendMessage()">Verstuur</button>
</div>

<script src="bericht.js"></script>
</body>
</html>

