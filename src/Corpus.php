<?php

namespace SentimentAnalyzer;


class Corpus
{
    private $positive = [];
    private $negative = [];

    public function __construct($location)
    {
        $this->loadJSONFile($location);
    }

    private function loadJSONFile($location)
    {

    }

    /**
     * Finds the number of occurrences of a word in the positive data set
     * @param $word - The word that is being counted
     * @return int The number of occurrences of $word
     */
    public function getPositiveCount($word)
    {
        return isset($this->positive[$word]) ? $this->positive[$word] : 0;
    }

    /**
     * Finds the number of occurrences of a word in the negative data set
     * @param $word - The word that is being counted
     * @return int The number of occurrences of $word
     */
    public function getNegativeCount($word)
    {
        return isset($this->negative[$word]) ? $this->negative[$word] : 0;
    }

    /**
     * Finds the probability of a word occurring in the positive data set
     * @param $word - The word that will be checked
     * @return int The probability that $word will occur
     */
    public function getPositiveProbability($word)
    {
        return isset($this->positive[$word]) ? $this->positive[$word] / count($this->positive[$word]) : 0;
    }

    /**
     * Finds the probability of a word occurring in the negative data set
     * @param $word - The word that will be checked
     * @return int The probability that $word will occur
     */
    public function getNegativeProbability($word)
    {
        return isset($this->negative[$word]) ? $this->negative[$word] / count($this->negative[$word]) : 0;
    }
} 