<?php

if (!function_exists('transliterateToRussian')) {
    function transliterateToRussian($text)
    {
        $transliteration = [
            'a' => 'а', 'b' => 'б', 'c' => 'ц', 'd' => 'д', 'e' => 'е',
            'f' => 'ф', 'g' => 'г', 'h' => 'х', 'i' => 'и', 'j' => 'й',
            'k' => 'к', 'l' => 'л', 'm' => 'м', 'n' => 'н', 'o' => 'о',
            'p' => 'п', 'q' => 'к', 'r' => 'р', 's' => 'с', 't' => 'т',
            'u' => 'у', 'v' => 'в', 'w' => 'в', 'x' => 'кс', 'y' => 'ы',
            'z' => 'з', ' ' => ' ', '-' => '-', '_' => '_',
            'A' => 'А', 'B' => 'Б', 'C' => 'Ц', 'D' => 'Д', 'E' => 'Е',
            'F' => 'Ф', 'G' => 'Г', 'H' => 'Х', 'I' => 'И', 'J' => 'Й',
            'K' => 'К', 'L' => 'Л', 'M' => 'М', 'N' => 'Н', 'O' => 'О',
            'P' => 'П', 'Q' => 'К', 'R' => 'Р', 'S' => 'С', 'T' => 'Т',
            'U' => 'У', 'V' => 'В', 'W' => 'В', 'X' => 'Кс', 'Y' => 'Ы',
            'Z' => 'З'
        ];

        return strtr($text, $transliteration);
    }
}