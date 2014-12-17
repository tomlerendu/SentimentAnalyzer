<?php

namespace TweetSentiment;


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