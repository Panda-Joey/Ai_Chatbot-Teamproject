function sendMessage() {
    const inputField = document.getElementById("messageInput");
    const message = inputField.value.trim();

    if (message === "") return; // stuurt niks als er niks is getypt

    
    const chatBox = document.getElementById("chatBox");

    // Nieuw bericht-element maken
    const userMessage = document.createElement("div");
    userMessage.classList.add("user-message");
    userMessage.textContent = message;

    // Bericht toevoegen aan chat
    chatBox.appendChild(userMessage);

    // Input leegmaken
    inputField.value = "";
}

function showAnswer() {
    // vragenlijst verbergen
    document.getElementById("questionList").style.display = "none";

    // antwoord tonen
    const answerText = document.getElementById("answer").innerText;
    const chatBox = document.getElementById("chatBox");

    const answerDiv = document.createElement("div");
    answerDiv.className = "ai-message";
    answerDiv.innerText = answerText;

    chatBox.appendChild(answerDiv);
}
