<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Helpers;

trait ClientHelper
{
    /**
     * @return string
     */
    public function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return string
     */
    public function browser(): string
    {
        $browserEnable = [
            "MSIE" => "Internet explorer",
            "Edge" => "Microsoft Edge",
            "Trident" => "Internet explorer",
            "Opera Mini" => "Opera Mini",
            "Opera" => "Opera",
            "Firefox" => "Mozilla Firefox",
            "Chrome" => "Google Chrome",
            "Safari" => "Safari",
            "PostmanRuntime" => "Test"
        ];
        $target = $_SERVER['HTTP_USER_AGENT'];
        foreach ($browserEnable as $browserKey => $browserItem) {
            if (str_contains($target, $browserKey)) {
                $browser = $browserItem;
            } else {
                $browser = "Navegador no identificado";
            }
        }
        return $browser;
    }

    /**
     * @return string
     */
    public function os(): string
    {
        $osEnable = [
            "Windows" => "Windows",
            "Macintosh" => "Mac",
            "Linux" => "Linux",
            "PostmanRuntime" => "Test"
        ];
        $target = $_SERVER['HTTP_USER_AGENT'];
        foreach ($osEnable as $keyOs => $osItem) {
            if (str_contains($target, $keyOs)) {
                $os = $osItem;
            } else {
                $os = "SO no identificado";
            }
        }
        return $os;
    }
}
