<?php

namespace App\Enums;

interface EnumInterface
{
    public static function all();

    public static function keys();

    public static function values();

    public static function hasKey();

    public static function hasValue();
}