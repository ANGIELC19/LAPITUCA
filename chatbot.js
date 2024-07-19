document.addEventListener('DOMContentLoaded', function () {
    const chatbot = document.getElementById('chatbot');
    const chatbotButton = document.getElementById('chatbot-button');
    const chatMessages = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');

    const botAvatar = 'img/chatbox.png';
    const userAvatar = 'img/user.png';

    let lastQuestion = '';
    let waitingForMoreQuestions = false;

    chatbotButton.addEventListener('click', function () {
        chatbot.style.display = chatbot.style.display === 'none' ? 'block' : 'none';
        if (chatbot.style.display === 'block') {
            addMessage('Bot', 'Hola, soy Doradita, tu asistente virtual de la broastería "La Pituca". Estoy aquí para ayudarte con nuestros productos, pedidos y cualquier consulta que tengas.', true);
            addMessage('Bot', '¿En qué puedo ayudarte hoy? Escribe una pregunta o elige una de las siguientes opciones:', true);
            addButtons(['Reservación', 'Promociones', 'Próximo evento']);
            waitingForMoreQuestions = false;
        }
    });

    function addMessage(sender, message, isBot = false) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message');
        messageElement.classList.add(isBot ? 'bot-message' : 'user-message');

        const avatar = document.createElement('img');
        avatar.src = isBot ? botAvatar : userAvatar;
        avatar.alt = isBot ? 'Bot Avatar' : 'User Avatar';
        avatar.classList.add('avatar');

        const messageContent = document.createElement('div');
        messageContent.classList.add('message-content');
        messageContent.textContent = message;

        messageElement.appendChild(avatar);
        messageElement.appendChild(messageContent);

        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addButtons(options) {
        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('button-container');
        options.forEach(option => {
            const button = document.createElement('button');
            button.classList.add('option-button');
            button.textContent = option;
            button.addEventListener('click', () => handleUserInput(option));
            buttonContainer.appendChild(button);
        });
        chatMessages.appendChild(buttonContainer);
    }

    function handleUserInput(input) {
        addMessage('Usuario', input, false);
        getBotResponse(input);
    }

    function getBotResponse(message) {
        message = message.toLowerCase();
        let response = '';
        let options = [];

        if (message.includes('reservación') || message.includes('reservar')) {
            response = 'Para hacer una reservación, te redirigiré a nuestra página de reservas.';
            setTimeout(() => {
                window.location.href = 'contactanos.html#reservation-form';
            }, 2000);
        } else if (message.includes('carta virtual')) {
            response = 'Puedes ver nuestra carta virtual en nuestro sitio web. ¿Te gustaría más información sobre algún plato en particular?';
            options = ['Sí', 'No'];
            lastQuestion = 'carta_virtual';
        } else if (message === 'sí' && lastQuestion === 'carta_virtual') {
            response = 'Platos recomendados:';
            options = ['Alitas BBQ - S/15.00', 'Alitas Acevichadas - S/15.00', 'Encuentro Broaster - S/10.00', 'Salchipapa - S/10.00', 'Patacones - S/10.00'];
            lastQuestion = '';
        } else if (message.includes('horario') || message.includes('hora')) {
            response = 'Nuestro horario de atención es de lunes a domingo de 18:00 a 22:00.';
        } else if (message.includes('ubicación') || message.includes('dirección')) {
            response = 'Estamos ubicados en la Calle Moquegua 290, Caja de agua. ¿Te gustaría saber la referencia?';
            options = ['Sí, dame la referencia', 'No, gracias'];
        } else if (message.includes('referencia')) {
            response = 'La referencia es: A la altura del paradero 7 de Caja de Agua.';
        } else if (message.includes('promociones') || message.includes('ofertas')) {
            response = 'Actualmente tenemos una promoción Combo Broaster. ¿Te gustaría conocer más detalles?';
            options = ['Más detalles'];
        } else if (message.includes('más detalles')) {
            response = 'Por la compra de cualquier Broaster + S/5.00 llévate una porción de chaufa y un vaso de refresco.';
        } else if (message.includes('evento') || message.includes('próximo evento')) {
            response = 'Nuestro próximo evento será este sábado 20 de julio, vuelve la CUMBIA Y EL VALLENATO con LOS DUROS DE COLOMBIA; Ven y disfruta de 20:00 a 23:40. ¡Esperamos verte allí!';
        } else if (message.includes('contacto') || message.includes('número')) {
            response = 'Puedes contactarnos por teléfono al 967 525 084 o por Facebook: https://shre.ink/lapituca';
        } else if (message.includes('gracias') || message.includes('está bien') || message === 'ok') {
            response = '¿Hay algo más en lo que pueda ayudarte?';
            options = ['Sí, tengo otra pregunta', 'No, gracias'];
            waitingForMoreQuestions = true;
        } else if (message === 'No, gracias' && waitingForMoreQuestions) {
            response = 'Entiendo, fue un placer ayudarte.';
            addMessage('Bot', response, true);
            setTimeout(() => {
                chatbot.style.display = 'none';
            }, 2000);
            return;
        } else if (message === 'sí, tengo otra pregunta' && waitingForMoreQuestions) {
            response = 'De acuerdo, ¿podrías reformularla o elegir una de estas opciones?';
            options = ['Reservación', 'Horario', 'Ubicación', 'Promociones', 'Próximo evento', 'Contacto'];
            waitingForMoreQuestions = false;
        } else {
            response = '¿Podrías reformularla o elegir una de estas opciones?';
            options = ['Reservación', 'Horario', 'Ubicación', 'Promociones', 'Próximo evento', 'Contacto'];
        }

        setTimeout(() => {
            addMessage('Bot', response, true);
            if (options.length > 0) {
                addButtons(options);
            }
        }, 1000);
    }

    userInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const message = userInput.value.trim();
            if (message) {
                handleUserInput(message);
                userInput.value = '';
            }
        }
    });
});
