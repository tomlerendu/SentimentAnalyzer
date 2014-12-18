<?php

namespace TweetSentiment;


class Data
{
    private $pos = [];
    private $neg = [];

    public function __construct($dataDir)
    {

    }

    private function loadDataDir($dataDir)
    {

    }

    /**
     * Finds the number of occurrences of a word in the positive data set
     * @param $word - The word that is being counted
     * @return int The number of occurrences of $word
     */
    public function getPosCount($word)
    {
        return isset($pos[$word]) ? $pos[$word] : 0;
    }

    /**
     * Finds the number of occurrences of a word in the negative data set
     * @param $word - The word that is being counted
     * @return int The number of occurrences of $word
     */
    public function getNegCount($word)
    {
        return isset($neg[$word]) ? $neg[$word] : 0;
    }
} 