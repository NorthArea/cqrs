<?php


namespace App\Service;


class Slack
{
    public function send(string $text, string $channel = 'test_channel'): bool
    {
        $data = json_encode([
            'channel' => "#{$channel}",
            'text' => "```" . $text . " ```",
            'icon_emoji' => ':bug:',
            'username' => 'bug'
        ], JSON_THROW_ON_ERROR);

        $ch = curl_init('https://hooks.slack.com/services/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');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['payload' => $data]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }
}