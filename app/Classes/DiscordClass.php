<?php

namespace App\Classes;

class DiscordClass
{
    protected $webhookUrl;
    protected $username;
    protected $avatarUrl;
    protected $content;
    protected $embeds = [];

    public function __construct($webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function addEmbed($embed)
    {
        $this->embeds[] = $embed;
        return $this;
    }

    public function send()
    {
        $data = [
            "username" => $this->username,
            "avatar_url" => $this->avatarUrl,
            "content" => $this->content,
            "embeds" => $this->embeds,
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/json',
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($this->webhookUrl, false, $context);

        return $result !== false;
    }
}
