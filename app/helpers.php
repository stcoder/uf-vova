<?php

/**
 * Находит в тексте ссылки и оборачивает их в тег.
 *
 * @param string $text
 * @return string
 */
function text_linked($text) {
    $regxp = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/[a-z0-9\-\_\?\&а-я]+)?/i";
    $regxpUser = "/\[(.*)?\|(.*)?\]/i";
    $resultText = $text;

    if (preg_match_all($regxp, $resultText, $m)) {
        if (sizeof($m[0]) > 0) {
            foreach($m[0] as $link) {
                $resultText = str_replace($link, "<a href=\"{$link}\" target='_blank'>{$link}</a>", $resultText);
            }
        }
    }

    if (preg_match($regxpUser, $resultText, $url)) {
        $resultText = preg_replace($regxpUser, "<a href=\"https://vk.com/{$url[1]}\" target=\"_blank\">{$url[2]}</a>", $resultText);
    }

    return $resultText;
}