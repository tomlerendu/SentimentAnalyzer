<?php

namespace SentimentAnalyzer;


class Classifier
{
    private $corpus;
    private $neutralThreshold;

    const POSITIVE = 1;
    const NEUTRAL = 0;
    const NEGATIVE = -1;

    public function __construct(Corpus $corpus)
    {
        $this->corpus = $corpus;
        $this->neutralThreshold = 0.1;
    }

    /**
     * Sets the threshold for the classifier choosing neutral for text
     * @param $value - The similarity ( abs(pos-neg) < $value for a neutral classification)
     */
    public function setNeutralThreshold($value)
    {
        $this->neutralThreshold = $value;
    }

    /**
     * Analyze a piece of text to get the sentiment of it.
     * @param $text - The text to be analyzed
     * @return array - An array with the keys positive and negative. The values of the keys add up to 1.
     */
    public function getSentiment($text)
    {
        $tokens = Helper::tokenize($text);

        $totalPositive = 0.0;
        $totalNegative = 0.0;

        //For each token
        foreach($tokens as $token)
        {
            $ratios = $this->corpus->getRatios($token);

            $totalPositive += $ratios['positive'];
            $totalNegative += $ratios['negative'];
        }

        //Rescale so the positive and negative values add up to 1
        $sentiment =  ['positive' => $totalPositive/count($tokens), 'negative' => $totalNegative/count($tokens)];

        return $sentiment;
    }

    /**
     * Classify a piece of text as either positive, negative or neutral.
     * @param $text - The text to be analyzed
     * @return int - The assigned label. Either Classifier::POSITIVE, Classifier::Negative or Classifier::NEUTRAL
     */
    public function getClassification($text)
    {
        $sentiment = $this->getSentiment($text);

        if(abs($sentiment['positive'] - $sentiment['negative']) < $this->neutralThreshold)
            return Classifier::NEUTRAL;
        if($sentiment['positive'] > $sentiment['negative'])
            return Classifier::POSITIVE ;
        else
            return Classifier::NEGATIVE;
    }
} 