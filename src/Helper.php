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
        $tokens = [];

        $token = strtok($string, '\t');

        while($token !== false)
        {
            $tokens[] = $token;
            $token = strtok('\t');
        }

        return $tokens;
    }
} 