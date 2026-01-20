
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

    const begroeting =
    msg.includes("hallo") ||
    msg.includes("hoi") ||
    msg.includes("hi") ||
    msg.includes("hey") ||
    msg.includes("goedemiddag") ||
    msg.includes("goedeavond") ||
    msg.includes("goedemorgen");

const vragen =
     msg.includes("vraag") ||
    msg.includes("vragen");


const doei = 
    msg.includes("doei") ||
    msg.includes("tot ziens") ||
    msg.includes("bedankt");

        // begroeting
        if (begroeting) {
            aiReply += "Hallo, hoe kan ik u helpen? ";
        }

        // vragen
        if (vragen) {
            aiReply += "Hier zijn enkele veelgestelde vragen. Staat uw vraag er niet bij? Typ deze hieronder.";
            document.getElementById("questionList").style.display = "block";
        }

        if(doei){
            aiReply += "Tot ziens! Fijne dag verder.";
        }

        

    // AI bericht
    const aiDiv = document.createElement("div");
    aiDiv.className = "ai-message";
    aiDiv.innerText = aiReply;
    chatBox.appendChild(aiDiv);

    inputField.value = "";
}


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

