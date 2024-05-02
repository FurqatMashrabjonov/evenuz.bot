<?php

/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Actions\SetLanguage;
use App\Telegram\Commands\Language;
use App\Telegram\Commands\Phone;
use App\Telegram\Commands\Start;
use App\Telegram\Keyboards\ReplyMarkupKeyboards;
use App\Telegram\Middleware\ChatExists;
use App\Telegram\Middleware\CheckBanned;
use App\Telegram\Middleware\CheckPhone;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

//Global Middlewares
$bot->middleware(ChatExists::class);
$bot->middleware(CheckBanned::class);
$bot->middleware(CheckPhone::class);

//Commands
$bot->onCommand('start', Start::class);
$bot->onCommand('lang', Language::class);
$bot->onCommand('phone', Phone::class);

//Set Language
$bot->onText('🇺🇿O\'zbekcha', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'uz');
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});
$bot->onText('🇷🇺Русский', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'ru');
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});
$bot->onText('🇬🇧English', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'en');
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});

$bot->onCallbackQueryData('set_lang:uz', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'uz');
    $bot->deleteMessage($bot->chat()->id, $bot->message()->message_id);
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});
$bot->onCallbackQueryData('set_lang:ru', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'ru');
    $bot->deleteMessage($bot->chat()->id, $bot->message()->message_id);
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});
$bot->onCallbackQueryData('set_lang:en', function (Nutgram $bot) {
    SetLanguage::set($bot->chat()->id, 'en');
    $bot->deleteMessage($bot->chat()->id, $bot->message()->message_id);
    $bot->sendMessage(text('lang.selected', lang($bot->chat()->id)));
});





$bot->onCommand('start', function (Nutgram $bot) {
    $bot->sendMessage(
        text: 'Добро пожаловать в бот even.uz',
        reply_markup: ReplyMarkupKeyboards::mainMenu()
    );
});

$bot->onText('ℹ️О Компании', function (Nutgram $bot) {
    $bot->sendMessage(
        text: 'https://telegra.ph/O-Kompanii-10-08-2',
        reply_markup: InlineKeyboardMarkup::make()
            ->addRow(
                InlineKeyboardButton::make('Open', web_app: WebAppInfo::make('https://telegra.ph/O-Kompanii-10-08-2'))
            )
    );
});


$bot->onText('📞Связаться', function (Nutgram $bot) {
    $bot->sendMessage(
        text: '📞 71 200 15 05
📩 33 100 15 05
🌐 www.even.uz
🔗https://www.instagram.com/even.uz/',
    );
});

$bot->onText('📪Наш адрес', function (Nutgram $bot) {
    $bot->sendLocation(
        latitude: 41.382128,
        longitude: 69.294766
    );
});

$bot->onText('📒Каталог', function (Nutgram $bot) {
    $bot->sendMessage(
        text: 'Наши каталоги',
        reply_markup: ReplyMarkupKeyboards::catalogs()
    );
});

$bot->onText('🖼Примеры', function (Nutgram $bot) {
    $bot->sendMessage(
        text: 'Примеры наших работ',
        reply_markup: ReplyMarkupKeyboards::examples()
    );
});

//catalogs clicked

$bot->onCallbackQueryData('catalog:(\d+)', function (Nutgram $bot, $id) {
    $bot->editMessageReplyMarkup(
        reply_markup: ReplyMarkupKeyboards::subCatalogs($id)
    );
});

$bot->onCallbackQueryData('back', function (Nutgram $bot) {
    $bot->editMessageReplyMarkup(
        reply_markup: ReplyMarkupKeyboards::catalogs()
    );
});

$bot->onCallbackQueryData('next_examples:(\d+)', function (Nutgram $bot, $page) {
    $bot->editMessageReplyMarkup(
        reply_markup: ReplyMarkupKeyboards::examples((int)$page)
    );
});
