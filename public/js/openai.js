/* Работа с API */

// Выгрузка ответов
// Формирует валидный запрос для получения ответа на цепочку писем
function GetApiMessages(messages, callback, n = 1, temperature = 0.8) {
    var request = {
        model: "gpt-3.5-turbo",
        temperature: temperature,
        n: n,
        messages: messages, // [{"role": "user","content": "Привет!"}]
    };

    GetGptResponse(
        "https://api.openai.com/v1/chat/completions",
        request,
        function (data) {
            callback(data);
        }
    );
}

// Выгрузка картинок
// Формирует валидный запрос для извлечения изображений
function GetApiImages(prompt, callback, n = 1) {
    var request = {
        prompt: prompt,
        n: n,
        size: "256x256", //256x256, 512x512, or 1024x1024.
    };

    GetGptResponse(
        "https://api.openai.com/v1/images/generations",
        request,
        function (data) {
            callback(data);
        }
    );
}

// Отправка запроса и возврат ответа
// С помощьб jQuery отправляется запрос и по окончанию запускается переданная Callback функция
function GetGptResponse(url, data, callback) {
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + sessionStorage.getItem("API-KEY"),
        },
        data: JSON.stringify(data),
        success: function (response) {
            if (response) {
                callback(response);
            } else {
                callback("Ошибка: API OpenAI не доступен");
            }
        },
        error: function (e) {
            console.log(e);
            callback(e);
        },
    });
}

/* Работа с LocalStorage */

//LoadMessages();

// Чтение быстрого чата
// Считывание из переменной массива сообщений
function ReadMessagesFastChat() {
    const messages = JSON.parse(localStorage.getItem("fast_chat")) || [];
    return messages;
}

// Сообщение в быстрый чат
// Добавляет в переменную с массивом новый объект сообщения
function AddMessageToFastChat(message) {
    const messages = JSON.parse(localStorage.getItem("fast_chat")) || [];

    messages.push(message);

    localStorage.setItem("fast_chat", JSON.stringify(messages));
}

// Очистка быстрого чата
// Удаляет переменную которая хранит в себе JSON массив
function RemoveFastChat() {
    localStorage.removeItem("fast_chat");
    location.reload();
}

/* Работа с UI */

// Ввод текста
// Событие ввода текста в окно ввода сообщения
$("#message-input").on("input", function () {
    MsgInputHeight();
});

// Загрузка быстрого чата
// Формирование списка на базе переменной с массивом сообщений
async function LoadMessages() {
    const uiOutput = $("#message-list");
    let messages = ReadMessagesFastChat().reverse();

    for await (const message of messages) {
        const data = await $.post("src/message.php", { message: message });

        uiOutput.prepend(data);
        $(window).scrollTop($(document).height());
    }
}

// Отправка сообщения
// Отображение сообщений в интерфейсе и запросы в API для ответов
function SendMessage() {
    const uiInput = $("#message-input");
    const uiOutput = $("#message-list");

    if (!uiInput.val()) {
        return;
    }

    let message = { role: "user", content: uiInput.val() };

    $.post(
        "/message",
        {
            message: message,
        },
        function (data) {
            uiOutput.append(data);
            $(window).scrollTop($(document).height());

            // AddMessageToFastChat(message);
            uiInput.val("");
        }
    );
/*
    let messages = ReadMessagesFastChat();
    messages.unshift({
        role: "system",
        content:
            'Все ответы в этой цепочке писем должны быть строго, не смотря не на что: на русском языке, от лица мужского пола, в непринужденной форме общения на "ты"',
    });
    messages.push(message);

    GetApiMessages(messages, function (data) {
        let results = data.choices;

        for (let index = 0; index < results.length; index++) {
            const element = results[index];

            $.post(
                "/includes/message",
                {
                    message: element.message,
                },
                function (data) {
                    uiOutput.append(data);
                    $(window).scrollTop($(document).height());

                    AddMessageToFastChat(element.message);
                }
            );
        }
    });
*/
    uiInput.height("auto");
    uiInput.focus();
}

// Выявление темы
// Задает вшитый вопрос и полученый ответ подставляет в html переменную
function GetTitleMessages() {
    const uiOutput = $("#chat-title");

    let messages = ReadMessagesFastChat();
    messages.unshift({
        role: "system",
        content:
            'Все ответы в этой цепочке писем должны быть строго, не смотря не на что: на русском языке, от лица мужского пола, в непринужденной форме общения на "ты"',
    });
    messages.push({
        role: "system",
        content:
            "Ответь названием не более чем в пять слов, которое будет отображать тему этой цепочки писем",
    });

    GetApiMessages(messages, function (data) {
        const choices = data.choices;

        for (let index = 0; index < choices.length; index++) {
            const message = choices[index].message;
            uiOutput.html(message.content);
            console.log(message.content);
        }
    });
}

// Вставить текст
// Событие нажатия на кнопку вставки текста из буфера обмена
function PasteMessageBox() {
    const uiInput = $("#message-input");

    navigator.clipboard.readText().then(function (clipText) {
        uiInput.val(clipText);
        uiInput.focus();
        MsgInputHeight();
    });
}

// Автовысота инпута ввода сообщения
// Фкункция регулировки высоты окна ввода сообщения
function MsgInputHeight() {
    const uiInput = $("#message-input");

    uiInput.height("auto");
    uiInput.height(uiInput.prop("scrollHeight") + "px");
}

// Очистить сообщение
// Событие нажатия на кнопку очистки окна текста сообщения
function ClearMessageBox() {
    const uiInput = $("#message-input");

    uiInput.val("");
    uiInput.height("auto");
    uiInput.focus();
}
