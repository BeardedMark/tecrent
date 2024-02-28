<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use Illuminate\Support\Facades\Mail;
use App\Mail\CartEmail;
use App\Classes\DiscordClass;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = session('cart', []);
        $cardSumm = 0;
        foreach ($cartItems as $id) {
            $cardSumm += Computer::find($id)->price;
        }

        return view('pages.basket', ['cartItems' => $cartItems, 'cardSumm' => $cardSumm]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItems = session('cart', []);

        $cartItems[] = $request->id;

        session(['cart' => $cartItems]);

        return redirect()
            ->back()
            ->with('success', 'Товар успешно добавлен в корзину.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItems = session('cart', []);

        $index = array_search($id, $cartItems);

        if ($index !== false) {
            unset($cartItems[$index]);
        }

        session(['cart' => $cartItems]);

        return redirect()
            ->back()
            ->with('success', 'Товар успешно добавлен в корзину.');
    }

    public function send(Request $request)
    {
        $recipient = env('APP_EMAIL');
        $subject = 'Оформление заказа';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');
        $cartItems = session('cart', []);

        $body = "Имя: $name\nТелефон: $phone\nПочта: $email\nАренда: $startDate - $endDate\nСообщение: $message\n";

        $embeds = [];
        $embeds[] = [
            "title" => $subject,
            "description" => $message,
            "color" => 15258703,
            "fields" => [
                [
                    "name" => "Имя",
                    "value" => $name,
                    "inline" => true
                ],
                [
                    "name" => "Телефон",
                    "value" => $phone,
                    "inline" => true
                ],
                [
                    "name" => "Почта",
                    "value" => $email,
                    "inline" => true
                ],
                [
                    "name" => "Сроки аренды оборудования:",
                    "value" => "",
                ],
                [
                    "name" => "Дата начала",
                    "value" => $startDate,
                    "inline" => true
                ],
                [
                    "name" => "Дата окончания",
                    "value" => $endDate,
                    "inline" => true
                ]
            ]
        ];
        

        foreach ($cartItems as $id) {
            $computer = Computer::find($id);
            $body .= "\n$computer->id : $computer->name : $computer->price руб/день";

            $embeds[] = [
                "title" => $computer->name,
                "url" => route('computers.show', $computer->id),
                "description" => "**$computer->price** руб/день",
                "thumbnail" => [
                    "url" => $computer->imageUrl()
                ],
                "footer" => [
                    "text" => "ID: $computer->id"
                ]
            ];
        }

        $discordBot = new DiscordClass('https://discord.com/api/webhooks/1189437930356359308/UyQB9uNtUcdvX668ESMn1_iLNcH7XSTZRzQ6IRvHAjauA4-2ORV6Vxv0y8NYkVKG8biF');

        $discordBot
            ->setUsername(env('APP_NAME'))
            ->setAvatarUrl(env('APP_URL') . '/logotype.png')
            ->setContent($subject);

        foreach ($embeds as $embed) {
            $discordBot->addEmbed($embed);
        }

        $discordBot->send();

        Mail::raw($body, function ($message) use ($recipient, $subject) {
            $message->to($recipient)->subject($subject);
        });

        return redirect()
            ->route('pages.main')
            ->with('success', 'Письмо отправлено на ' . $request->input('email'));
    }

    public function sendAssembly(Request $request)
    {
        $recipient = env('APP_EMAIL');
        $subject = 'Заявка на подбор';

        $requestData = $request->except(['_token']);
        $jsonContent = json_encode($requestData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Mail::raw($jsonContent, function ($message) use ($recipient, $subject) {
        //     $message->to($recipient)->subject($subject);
        // });

        $webhookURL = 'https://discord.com/api/webhooks/1189437930356359308/UyQB9uNtUcdvX668ESMn1_iLNcH7XSTZRzQ6IRvHAjauA4-2ORV6Vxv0y8NYkVKG8biF';

        // Данные для отправки (в данном случае, текст сообщения)
        $data = [
            "username" => "Вебхук",
            "avatar_url" => "https://i.imgur.com/8gzrpIh.png",
            "content" => "Текст сообщения. До 2000 символов.",
            "embeds" => [
                [
                    "author" => [
                        "name" => "TECRENT",
                        "url" => "https://tecrent.ru/",
                        "icon_url" => "https://tecrent.ru/favicon.ico"
                    ],
                    "title" => "Заголовок",
                    "url" => "https://google.com/",
                    "description" => "Текст сообщения. Здесь можно использовать Markdown. *Курсив* **жирный** __подчёркнутый__ ~~зачёркнутый~~ [гиперссылка](https://google.com) `код`",
                    "color" => 15258703,
                    "fields" => [
                        [
                            "name" => "Текст",
                            "value" => "Ещё текста",
                            "inline" => true
                        ],
                        [
                            "name" => "Нам нужно больше текста",
                            "value" => "Агась",
                            "inline" => true
                        ],
                        [
                            "name" => "Используйте параметр `\"inline\": true` , если вы хотите чтоб поля располагались на одной линии.",
                            "value" => "Ладно..."
                        ],
                        [
                            "name" => "Спасибо!",
                            "value" => "Не за что! :wink:"
                        ]
                    ],
                    "thumbnail" => [
                        "url" => "https://i.imgur.com/2p68pbG.jpg"
                    ],
                    "image" => [
                        "url" => "https://i.imgur.com/2p68pbG.jpg"
                    ],
                    "footer" => [
                        "text" => "Вау! Как классно! :smirk:",
                        "icon_url" => "https://i.imgur.com/AAeBJBp.png"
                    ]
                ]
            ]
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/json',
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($webhookURL, false, $context);

        return redirect()
            ->back()
            ->with('success', 'Письмо отправлено на ' . $recipient);
    }
}
