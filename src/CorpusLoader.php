<?php
namespace TomLerendu\SentimentAnalyzer;

class CorpusLoader implements \JsonStreamingParser_Listener
{
    private $corpus;

    /**
     * Loads a corpus json file into a corpus object.
     *
     * @param $location - The location of the json file relative to the data directory
     * @param Corpus $corpus - The corpus object to load the json data into
     * @throws \Exception
     */
    public function load($location, Corpus $corpus)
    {
        $this->corpus = $corpus;

        $path = dirname(dirname(__FILE__)) . "/data/" . $location;

        //Open the file for reading
        $jsonStream = fopen($path, 'r');
        try {
            //Use the JSON streaming parser with the current object as the listener
            $parser = new \JsonStreamingParser_Parser($jsonStream, $this);
            $parser->parse();
        } catch (\Exception $e) {
            //If an exception occurs close the file
            fclose($jsonStream);
            throw $e;
        }
    }

    private $inPositive = false;
    private $inNegative = false;
    private $atWord = true;
    private $word = '';

    public function file_position($line, $char) { }
    public function start_document() { }
    public function end_document() { }
    public function start_object() { }
    public function end_object() { }
    public function start_array() { }
    public function end_array() { }

    public function key($key)
    {
        //Switch between the positive and negative word sets
        switch($key) {
            case 'positive':
                $this->inPositive = true;
                $this->inNegative = false;
                break;
            case 'negative':
                $this->inPositive = false;
                $this->inNegative = true;
                break;
        }
    }

    public function value($value)
    {
        //If the value is a positive or negative word
        if(($this->inPositive || $this->inNegative) && $this->atWord)
        {
            $this->word = $value;
            $this->atWord = false;
        }

        //If the value is the word count add it to the corpus object

        else if($this->inPositive && !$this->atWord)
        {
            $this->corpus->addPositiveWord($this->word, $value);
            $this->atWord = true;
        }

        else if($this->inNegative && !$this->atWord)
        {
            $this->corpus->addNegativeWord($this->word, $value);
            $this->atWord = true;
        }
    }

    public function whitespace($whitespace) { }
}