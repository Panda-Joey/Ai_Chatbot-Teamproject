<?php 



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
        <?php echo "Welkom bij de AI chatbot van Bed & Breakfast!"?> 
    </div>

<input id="messageInput" type="text" placeholder="Typ je bericht..." >
<button onclick="sendMessage()">Verstuur</button>
</div>

<script src="ai.js"></script>
</body>
</html>

