const questions = [
    {
        question: "Hi, How can I assist you today?",
        choices: [
            { text: "What are the school hours?", response: "Our school is open from 8:00 AM to 6:00 PM, Monday to Friday." },
            { text: "Where is the school located?", response: "P4 Bulanao, Tabuk City, Kalinga,or you can check our location in the map to our website." },
            { text: "How can I contact the administration?", response: "You can reach our administration office at 0912345678 or email adminkcst@gmail.com." }
        ]
    },
    {
        question: "Is there anything else you want to know?",
        choices: [
            { text:  "What are the school hours?", response: "Our school is open from 8:00 AM to 6:00 PM, Monday to Friday." },
            { text: "Where is the school located?", response: "P4 Bulanao, Tabuk City, Kalinga,or you can check our location in the map to our website." },
            {text: "How can I contact the administration?", response: "You can reach our administration office at 0912345678 or email adminkcst@gmail.com." }
        ]
    },
    {
        question: "Would you like to know more about our facilities?",
        choices: [
            { text:  "What are the school hours?", response: "Our school is open from 8:00 AM to 6:00 PM, Monday to Friday." },
            { text: "Where is the school located?", response: "P4 Bulanao, Tabuk City, Kalinga,or you can check our location in the map to our website." },
            { text: "How can I contact the administration?", response: "You can reach our administration office at 0912345678 or email adminkcst@gmail.com." }
        ]
    }
];

const chatContent = document.getElementById('chatContent');
const chatContainer = document.getElementById('chatContainer');

function toggleChat() {
    if (chatContainer.style.display === "none" || chatContainer.style.display === "") {
        chatContainer.style.display = "flex";
    } else {
        chatContainer.style.display = "none";
    }
}

function addChatBubble(text, isUser = false) {
    const bubble = document.createElement('div');
    bubble.classList.add('chat-bubble');
    bubble.classList.add(isUser ? 'user-bubble' : 'bot-bubble');
    bubble.textContent = text;
    chatContent.appendChild(bubble);
    chatContent.scrollTop = chatContent.scrollHeight;
}

function loadQuestion(index) {
    if (index >= questions.length) {
        addChatBubble("Thank you for chatting! Feel free to ask more questions.");
        setTimeout(() => {
            chatContent.innerHTML = ""; 
            loadQuestion(0); 
        }, 9000);
        return;
    }

    const currentQuestion = questions[index];
    addChatBubble(currentQuestion.question);

    const choicesBlock = document.createElement('div');
    choicesBlock.classList.add('choices');

    currentQuestion.choices.forEach(choice => {
        const button = document.createElement('button');
        button.textContent = choice.text;
        button.onclick = () => {
            addChatBubble(choice.text, true); 
            addChatBubble(choice.response); 
            choicesBlock.remove();
            loadQuestion(index + 1);
        };
        choicesBlock.appendChild(button);
    });

    chatContent.appendChild(choicesBlock);
}

loadQuestion(0);
