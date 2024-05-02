<?php

namespace App\Services;

class Catalogs
{
    public static function all()
    {
        return [
            'Вывески',
            'Комплексное оформление',
            'Рекламная оклейка',
            'Мобильные конструкции',
            'Таблички и навигаторы',
            'Городская реклама',
            'Подставки, холдеры и ценники',
            'Инфостенды',
            'POSM'
        ];
    }

    public static function get($id)
    {
        return self::all()[$id];
    }

    public static function subCatalogs(): array
    {
        return [
            0 => [
                'Объёмные буквы' => 'https://telegra.ph/KATALOG-02-12-7',
                'Световые коробы' => 'https://telegra.ph/KATALOG-02-12-8',
                'Псевдообъемные буквы' => 'https://telegra.ph/KATALOG-02-12-9',
                'Крышные конструкции' => 'https://telegra.ph/KATALOG-02-12-10'
            ],
            1 => [
                'Оформления офисов' => 'https://telegra.ph/KATALOG-02-14',
                'Оформления магазино' => 'https://telegra.ph/KATALOG-02-14-3',
                'Оформления учебных центров' => 'https://telegra.ph/KATALOG-02-14-2'
            ],
            2 => [
                'Реклама на автотранспорте' => 'https://telegra.ph/KATALOG-02-14-5',
                'Оклейка витражей' => 'https://telegra.ph/KATALOG-02-14-4'
            ],
            3 => [
                'Поп-ап (pop-up)' => 'https://telegra.ph/KATALOG-02-14-9',
                'Промостойка' => 'https://telegra.ph/KATALOG-02-14-8',
                'Х-баннер (паучок)' => 'https://telegra.ph/KATALOG-02-14-7',
                'Роллуп (roll-up)' => 'https://telegra.ph/KATALOG-02-14-6'
            ],
            4 => [
                'Таблички и указатели' => 'https://telegra.ph/KATALOG-02-14-10',
                'Дверные таблички' => 'https://telegra.ph/KATALOG-02-14-11',
                'Навигационные панели' => 'https://telegra.ph/KATALOG-02-14-12',
                'Навигационные пилоны' => 'https://telegra.ph/KATALOG-02-14-13'
            ],
            5 => [
                'Рекламная стелла' => 'https://telegra.ph/KATALOG-02-14-15',
                'Рекламный пилон' => 'https://telegra.ph/KATALOG-02-14-16',
                'Навигационный рекламный указатель' => 'https://telegra.ph/KATALOG-02-14-17',
                'Флагшток' => 'https://telegra.ph/KATALOG-02-14-18'
            ],
            6 => [
                'Подставки' => 'https://telegra.ph/KATALOG-02-14-21',
                'Холдеры' => 'https://telegra.ph/KATALOG-02-14-21',
                'Ценники' => 'https://telegra.ph/KATALOG-02-14-21'
            ],
            7 => [
                'Инфостенды' => 'https://telegra.ph/KATALOG-02-14-20'
            ],
            8 => [
                'POSM' => 'https://telegra.ph/KATALOG-02-14-19'
            ]
        ];

    }

    public static function getExamples()
    {
        return [
            'Объёмные буквы' => 'https://telegra.ph/KATALOG-09-17',
            'Световой короб' => 'https://telegra.ph/KATALOG-09-17-2',
            'Реклама на авто' => 'https://telegra.ph/KATALOG-09-17-3',
            'Таблички' => 'https://telegra.ph/KATALOG-09-17-4',
            'Оформления' => 'https://telegra.ph/KATALOG-09-17-5',
            'Туманка' => 'https://telegra.ph/KATALOG-09-17-6',
            'Керамические буквы' => 'https://telegra.ph/KATALOG-09-17-7',
            'Керамический герб' => 'https://telegra.ph/KATALOG-09-17-8',
            'Стеллы' => 'https://telegra.ph/KATALOG-09-17-9',
            'Неон' => 'https://telegra.ph/KATALOG-09-17-10',
            'Видео буквы' => 'https://telegra.ph/KATALOG-09-17-11',
            'Картина из Холста' => 'https://telegra.ph/KATALOG-09-17-12',
            'Крышевая конструкция' => 'https://telegra.ph/KATALOG-09-17-13'

        ];
    }
}
