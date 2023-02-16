<?php

namespace Application\manager;

class CartManager
{

    private static array $liste = [];

    public static function loadCart(): void
    {
        if (self::hasSavedCart()) {
            self::$liste = unserialize($_SESSION['cart']);
        }
        var_dump(self::$liste);
    }

    public static function saveCart(): void
    {
        $_SESSION['cart'] = serialize(self::$liste);
    }

    public static function addProduct($product)
    {
        self::$liste[] = $product;
        var_dump(self::$liste);
    }

    public static function hasSavedCart(): bool
    {
        return isset($_SESSION['cart']);
    }

}