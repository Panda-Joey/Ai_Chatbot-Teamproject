
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

    if (
        msg.includes("hallo") ||
        msg.includes("hoi") ||
        msg.includes("hi") ||
        msg.includes("hey") ||
        msg.includes("goedemiddag")||
        msg.includes("goedeavond")||
        msg.includes("goedenmorgen")

    ) {
        aiReply = "Hallo, hoe kan ik u helpen?";
    } else {
        aiReply = "Dank u voor uw bericht!";
    }

    // AI bericht
    const aiDiv = document.createElement("div");
    aiDiv.className = "ai-message";
    aiDiv.innerText = aiReply;
    chatBox.appendChild(aiDiv);

    inputField.value = "";
}
