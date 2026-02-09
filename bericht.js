
function sendMessage() {
    const inputField = document.getElementById("messageInput");
    const message = inputField.value.trim();

    if (message === "") return;

    const chatBox = document.getElementById("chatBox");

    // USER bericht
    const userDiv = document.createElement("div");
    userDiv.className = "user-message";
    userDiv.innerText = message;
    chatBox.appendChild(userDiv);

    // AI logica
    const msg = message.toLowerCase();
    let aiReply = "";

    // VERSTUUR NAAR PHP
    fetch("index.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "message=" + encodeURIComponent(message)
    })
    .then(response => response.text())
    .then(answer => {
        const aiDiv = document.createElement("div");
        aiDiv.className = "ai-message";
        aiDiv.innerText = answer;
        chatBox.appendChild(aiDiv);
    });

    inputField.value = "";
}
        

    // AI bericht
    const aiDiv = document.createElement("div");
    aiDiv.className = "ai-message";
    aiDiv.innerText = aiReply;
    chatBox.appendChild(aiDiv);

    inputField.value = "";



function showAnswer(element) {
    // verberg vragen
    document.getElementById("questionList").style.display = "none";

    // haal antwoord op
    const answer = element.getAttribute("data-answer");

    // toon als AI-bericht
    const chatBox = document.getElementById("chatBox");

    const aiDiv = document.createElement("div");
    aiDiv.className = "ai-message";
    aiDiv.innerText = answer;

    chatBox.appendChild(aiDiv);
}

