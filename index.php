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
        <?php echo "Hier word de meest gestelde vragen beantwoord."?><br><br>
        <ul id="questionList">
             <li onclick="showAnswer()">
                <?php
        $sql = "SELECT vraag, antwoord FROM vraag WHERE idvraag = 1";
        $result = $conn->query($sql);

        if ($row = $result->fetch_assoc()) {
            echo htmlspecialchars($row['vraag']);

            
            echo "<div id='answer' style='display:none;'>";
            echo htmlspecialchars($row['antwoord']);
            echo "</div>";
        }
        ?>
            <li>
                 <?php
        $sql = "SELECT vraag, antwoord FROM vraag WHERE idvraag = 2";
        $result = $conn->query($sql);

        if ($row = $result->fetch_assoc()) {
            echo htmlspecialchars($row['vraag']);

            
            echo "<div id='answer' style='display:none;'>";
            echo htmlspecialchars($row['antwoord']);
            echo "</div>";
        }
        ?>
        </ul>
                
         

    </div>

<input id="messageInput" type="text" placeholder="Typ je bericht..." >
<button onclick="sendMessage()">Verstuur</button>
</div>

<script src="ai.js"></script>
</body>
</html>

