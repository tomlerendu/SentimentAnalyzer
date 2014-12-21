<?php

namespace SentimentAnalyzer;


class Helper
{
    /**
     * Tokenize a string
     * @param $string - The string to be tokenized
     * @return array - The tokens
     */
    public static function tokenize($string)
    {
        $tokens = strtolower($string);
        $tokens = preg_replace('/[^a-z0-9 ]/', '', $tokens);
        $tokens = preg_split('/\s\s+| /', $tokens);
        $tokens = array_diff($tokens, ['']);

        return $tokens;
    }
} 