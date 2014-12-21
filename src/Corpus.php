<?php

namespace SentimentAnalyzer;

class Corpus
{
    private $totalPositive = 0;
    private $positive = [];
    private $totalNegative = 0;
    private $negative = [];

    public function __construct($location = null)
    {
        if($location != null)
        {
            //todo read in json file from location
        }
    }

    /**
     * Adds a string to the corpus that has been classified as positive
     * @param $string - The string to be added to the corpus
     */
    public function addPositiveString($string)
    {
        $tokens = Helper::tokenize($string);

        foreach($tokens as $token)
        {
            $this->positive[$token] = (isset($this->positive[$token])) ? $this->positive[$token] + 1 : 1;
            $this->totalPositive++;
        }
    }

    /**
     * Adds a string to the corpus that has been classified as negative
     * @param $string - The string to be added to the corpus
     */
    public function addNegativeString($string)
    {
        $tokens = Helper::tokenize($string);

        foreach($tokens as $token)
        {
            $this->negative[$token] = (isset($this->negative[$token])) ? $this->negative[$token] + 1 : 1;
            $this->totalNegative++;
        }
    }

    /**
     * Finds the number of occurrences of a word in the positive data set
     * @param $word - The word that is being counted, if no word is passed the total positive word count is returned.
     * @return int The number of occurrences of $word
     */
    public function getPositiveCount($word=null)
    {
        if($word)
            return isset($this->positive[$word]) ? $this->positive[$word] : 0;
        else
            return $this->totalPositive;
    }

    /**
     * Finds the number of occurrences of a word in the negative data set
     * @param $word - The word that is being counted, if no word is passed the total negative word count is returned.
     * @return int The number of occurrences of $word
     */
    public function getNegativeCount($word=null)
    {
        if($word)
            return isset($this->negative[$word]) ? $this->negative[$word] : 0;
        else
            return $this->totalNegative;
    }

    /**
     * Finds the probability of a word occurring in the positive data set
     * @param $word - The word that will be checked
     * @return int The probability that $word will occur
     */
    public function getPositiveProbability($word)
    {
        return isset($this->positive[$word]) ? (float)$this->positive[$word] / $this->totalPositive : 0;
    }

    /**
     * Finds the probability of a word occurring in the negative data set
     * @param $word - The word that will be checked
     * @return int The probability that $word will occur
     */
    public function getNegativeProbability($word)
    {
        return isset($this->negative[$word]) ? (float)$this->negative[$word] / $this->totalNegative : 0;
    }
} 