function sendMessage() {
    const inputField = document.getElementById("messageInput");
    const message = inputField.value.trim();

    if (message === "") return; // voorkomt lege berichten

    // Chatbox selecteren
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
