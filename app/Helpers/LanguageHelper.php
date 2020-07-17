<?php


namespace App\Helpers;


use Illuminate\Support\Facades\App;

class LanguageHelper
{
    const UZBEK = 'uz';
    const RUSSIAN = 'ru';
    const ENGLISH = 'en';

    public static function getName($className, $lang = null): string
    {
        return self::getAttribute($className, 'name', $lang) ?? '';
    }

    public static function getTitle($className, $lang = null): string
    {
        return self::getAttribute($className, 'title', $lang) ?? '';
    }

    public static function getBody($className, $lang = null): string
    {
        return self::getAttribute($className, 'body', $lang) ?? '';
    }


    public static function getDescription($className, $lang = null): string
    {
        return self::getAttribute($className, 'description', $lang) ?? '';
    }

    public static function getNote($className, $lang = null): string
    {
        return self::getAttribute($className, 'note', $lang) ?? '';
    }

    public static function getComment($className, $lang = null): string
    {
        return self::getAttribute($className, 'comment', $lang) ?? '';
    }

    public static function getAttribute($className, string $attributeName, $lang = null): ?string
    {
        if ($lang) {
            $attribute = $attributeName . '_' . $lang;
        } else {
            $attribute = $attributeName . '_' . self::getCurrentLanguagePrefix();
        }

        if ($className->$attribute) {
            return $className->$attribute;
        }

        return $className->{$attributeName . '_' . self::UZBEK} ?:
                $className->{$attributeName . '_' . self::RUSSIAN} ?:
                    $className->{$attributeName . '_' . self::ENGLISH};
    }

    public static function getCurrentLanguagePrefix(): string
    {
        return mb_substr(App::getLocale(), 0, 2);
    }

    public static function getPrefix($lang): string
    {
        switch ($lang) {
            case self::UZBEK:
                return self::UZBEK;
            case self::RUSSIAN:
                return self::RUSSIAN;
            case self::ENGLISH:
                return self::ENGLISH;
            default:
                return self::getCurrentLanguagePrefix();
        }
    }
}
