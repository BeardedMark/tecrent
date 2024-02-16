<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\DiscordClass;


class ConnectorController extends Controller
{
    public function sendDiscord(Request $request, $subject)
    {
        $requestData = $request->except(['_token']);
        $fields = [];

        foreach ($requestData as $key => $value) {
            if ($value !== null)
                $fields[] = [
                    'name' => $key,
                    'value' => $value,
                    'inline' => false,
                ];
        }

        $discordBot = new DiscordClass(env('APP_DISCORD'));

        $discordBot
            ->addEmbed([
                "title" => $subject,
                "description" => $request->header('referer'),
                "fields" => $fields,
            ])
            ->send();

        return redirect()
            ->back()
            ->with('success', 'Ваше сообщение отправлено нам в Discord');
    }
}
