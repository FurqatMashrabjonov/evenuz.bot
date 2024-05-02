<?php

namespace App\Livewire\Bot;

use Filament\Notifications\Notification;
use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Telegram\Exceptions\TelegramException;

class Control extends Component
{
    public bool $isRunning = false;

    public function mount()
    {
        $this->isRunning = settings('webhook_was_set');
    }

    /**
     * @throws TelegramException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function start()
    {
        $settings = settings();
        $settings->webhook_was_set = true;
        $settings->save();
        bot($settings->bot_token)->setWebhook(generateWebhookUrl($settings->webhook_url).route('webhook', [], false));
        $this->isRunning = true;

        $this->notify(__('settings.bot_started'));
    }

    /**
     * @throws TelegramException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function stop(): void
    {
        $settings = settings();
        $settings->webhook_was_set = false;
        $settings->save();
        bot($settings->bot_token)->deleteWebhook();
        $this->isRunning = false;
        $this->notify(__('settings.bot_stopped'));
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws \JsonException
     * @throws TelegramException
     * @throws GuzzleException
     */
    public function restart(): void
    {
        $settings = settings();
        $settings->webhook_was_set = false;
        $settings->save();
        bot($settings->bot_token)->deleteWebhook();
        $settings->webhook_was_set = true;
        $settings->save();
        sleep(1);
        bot($settings->bot_token)->setWebhook(generateWebhookUrl($settings->webhook_url).route('webhook', [], false));
        $this->isRunning = true;
        $this->notify(__('settings.bot_restarted'));
    }

    public function notify(string $message)
    {
        Notification::make()
            ->title($message)
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.bot.control');
    }
}
