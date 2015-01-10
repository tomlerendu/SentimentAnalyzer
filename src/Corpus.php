<?php
namespace TomLerendu\SentimentAnalyzer;

class Corpus
{
    private $totalPositive = 0;
    private $totalNegative = 0;
    private $positive = [];
    private $negative = [];

    public function __construct($location = null)
    {
        //If the corpus already exists as a file
        if ($location != null) {
            $corpusLoader = new CorpusLoader();
            $corpusLoader->load($location, $this);
        }
    }

    /**
     * Adds a word to the corpus that has been classified as positive
     * @param $word - The word to be added to the corpus
     * @param $count - How many times the word occurred
     */
    public function addPositiveWord($word, $count = 1)
    {
        $this->positive[$word] = (isset($this->positive[$word])) ? $this->positive[$word] + $count : $count;
        $this->totalPositive += $count;
    }

    /**
     * Adds a word to the corpus that has been classified as negative
     * @param $word - The word to be added to the corpus
     * @param $count - How many times the word occurred
     */
    public function addNegativeWord($word, $count = 1)
    {
        $this->negative[$word] = (isset($this->negative[$word])) ? $this->negative[$word] + $count : $count;
        $this->totalNegative += $count;
    }

    /**
     * Finds the number of occurrences of a word in the positive data set
     * @param $word - The word that is being counted, if no word is passed the total positive word count is returned.
     * @return int The number of occurrences of $word
     */
    public function getPositiveCount($word = null)
    {
        if ($word)
            return isset($this->positive[$word]) ? $this->positive[$word] : 0;
        else
            return $this->totalPositive;
    }

    /**
     * Finds the number of occurrences of a word in the negative data set
     * @param $word - The word that is being counted, if no word is passed the total negative word count is returned.
     * @return int The number of occurrences of $word
     */
    public function getNegativeCount($word = null)
    {
        if ($word)
            return isset($this->negative[$word]) ? $this->negative[$word] : 0;
        else
            return $this->totalNegative;
    }

    public function getRatios($word)
    {
        //The probability of the word from either the positive or negative sets
        $wordTotal = $this->getPositiveProbability($word) + $this->getNegativeProbability($word);

        $positive = ($this->getPositiveCount($word) === 0) ? 0 : $this->getPositiveProbability($word) / $wordTotal;
        $negative = ($this->getNegativeCount($word) === 0) ? 0 : $this->getNegativeProbability($word) / $wordTotal;

        //Deal with the special case of 0 for both positive and negative
        if ($positive === 0 && $negative === 0) {
            $positive = 0.5;
            $negative = 0.5;
        }

        return [
            'positive' => $positive,
            'negative' => $negative
        ];
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