<?php

namespace SentimentAnalyzer;


class CorpusLoader implements \JsonStreamingParser_Listener
{
    private $corpus;

    public function load($location, Corpus $corpus)
    {
        $this->corpus = $corpus;

        $jsonStream = fopen($location, 'r');
        try
        {
            $parser = new \JsonStreamingParser_Parser($jsonStream, $this);
            $parser->parse();
        }
        catch (\Exception $e)
        {
            fclose($jsonStream);
            throw $e;
        }
    }

    public function file_position($line, $char)
    {
        // TODO: Implement file_position() method.
    }

    public function start_document()
    {
        // TODO: Implement start_document() method.
    }

    public function end_document()
    {
        // TODO: Implement end_document() method.
    }

    public function start_object()
    {
        // TODO: Implement start_object() method.
    }

    public function end_object()
    {
        // TODO: Implement end_object() method.
    }

    public function start_array()
    {
        // TODO: Implement start_array() method.
    }

    public function end_array()
    {
        // TODO: Implement end_array() method.
    }

    public function key($key)
    {
        // TODO: Implement key() method.
    }

    public function value($value)
    {
        // TODO: Implement value() method.
    }

    public function whitespace($whitespace)
    {
        // TODO: Implement whitespace() method.
    }
}