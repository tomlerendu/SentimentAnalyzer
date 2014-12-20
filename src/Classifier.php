<?php

namespace SentimentAnalyzer;


class Classifier
{
    private $corpus;

    public function __construct(Corpus $corpus)
    {
        $this->corpus = $corpus;
    }

    public function getSentiment($text)
    {

    }
} 