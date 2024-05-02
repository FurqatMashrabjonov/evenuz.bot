<?php

namespace App\Telegram\Keyboards;

use App\Services\Catalogs;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;

class ReplyMarkupKeyboards
{
    public static function language(): ReplyKeyboardMarkup
    {
        return ReplyKeyboardMarkup::make(
            resize_keyboard: true,
            one_time_keyboard: true,
        )->addRow(
            KeyboardButton::make('🇺🇿O\'zbekcha'),
            KeyboardButton::make('🇷🇺Русский'),
            KeyboardButton::make('🇬🇧English'),
        );
    }

    public static function phone(?string $lang = null): ReplyKeyboardMarkup
    {
        return ReplyKeyboardMarkup::make(
            resize_keyboard: true,
            one_time_keyboard: true
        )->addRow(
            KeyboardButton::make(
                text: text('phone.send_my_phone', lang($lang)),
                request_contact: true
            )
        );
    }

    public static function mainMenu(): ReplyKeyboardMarkup
    {
        return ReplyKeyboardMarkup::make(resize_keyboard: true)->addRow(
            KeyboardButton::make('📒Каталог'),
            KeyboardButton::make('🖼Примеры')
        )->addRow(
            KeyboardButton::make('ℹ️О Компании'),
            KeyboardButton::make('📞Связаться')
        )->addRow(
            KeyboardButton::make('📪Наш адрес')
        );
    }

    public static function catalogs()
    {
        $inline = InlineKeyboardMarkup::make();
        foreach (Catalogs::all() as $key => $catalog) {
            $inline->addRow(
                InlineKeyboardButton::make($catalog, callback_data: "catalog:$key")
            );
        }
        return $inline;
    }

    public static function subCatalogs($id)
    {
        $inline = InlineKeyboardMarkup::make();
        foreach (Catalogs::subCatalogs()[$id] as $key => $subCatalog) {
            $inline->addRow(
                InlineKeyboardButton::make($key, web_app: WebAppInfo::make($subCatalog))
            );
        }

        //add back button
        $inline->addRow(
            InlineKeyboardButton::make('⬅️Назад', callback_data: "back")
        );

        return $inline;
    }

    public static function examples($page = 0): InlineKeyboardMarkup
    {
        $inline = InlineKeyboardMarkup::make();
        $examples = Catalogs::getExamples();
        //for by page
        $examples = array_slice($examples, $page * 5, 5);
        foreach ($examples as $key => $example) {
            $inline->addRow(
                InlineKeyboardButton::make($key, web_app: WebAppInfo::make($example))
            );
        }
        //make next and prev button in one row
        $allPages = floor(count(Catalogs::getExamples()) / 5);
        if ($page == 0) {
            $inline->addRow(
                InlineKeyboardButton::make("Вперед➡️", callback_data: "next_examples:" . ($page + 1))
            );
        } else if ($page > 0 && $page < $allPages) {
            $inline->addRow(
                InlineKeyboardButton::make("⬅️Назад", callback_data: "next_examples:" . ($page - 1)),
                InlineKeyboardButton::make("Вперед➡️", callback_data: "next_examples:" . ($page + 1))
            );
        } else if ($page == $allPages) {
            $inline->addRow(
                InlineKeyboardButton::make("⬅️Назад", callback_data: "next_examples:" . ($page - 1))
            );
        }
        return $inline;
    }
}
