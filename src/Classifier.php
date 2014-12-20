<?php

namespace SentimentAnalyzer;


class Classifier
{
    private $data = null;

    public function __construct($dataDir)
    {
        $data = new Data($dataDir);
    }

    public function getSentiment($text)
    {

    }
} 