<?php
// auto_load 로 전역 관리할 때, 이름 충돌을 피하기 위해 사용한다.
if (!function_exists("markdown")) {
    function markdown(?string $text = null): string
    {
        return app(ParsedownExtra::class)->text($text);
    }
}
