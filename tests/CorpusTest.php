<?php


class CorpusTest extends PHPUnit_Framework_TestCase
{
    public function testWordCount()
    {
        $corpus = new SentimentAnalyzer\Corpus();

        $corpus->addPositiveWord('two', 2);
        $corpus->addPositiveWord('hello');
        $corpus->addPositiveWord('hello', 1);
        $corpus->addPositiveWord('test');

        $corpus->addNegativeWord('hello', 5);
        $corpus->addNegativeWord('the');
        $corpus->addNegativeWord('a', 1);

        $this->assertEquals(2, $corpus->getPositiveCount('two'));
        $this->assertEquals(2, $corpus->getPositiveCount('hello'));
        $this->assertEquals(1, $corpus->getPositiveCount('test'));
        $this->assertEquals(0, $corpus->getPositiveCount('word'));

        $this->assertEquals(5, $corpus->getNegativeCount('hello'));
        $this->assertEquals(1, $corpus->getNegativeCount('a'));
        $this->assertEquals(1, $corpus->getNegativeCount('the'));
        $this->assertEquals(0, $corpus->getNegativeCount('word'));
    }

    public function testProbability()
    {
        $corpus = new SentimentAnalyzer\Corpus();

        $corpus->addPositiveWord('the');
        $corpus->addPositiveWord('probability');
        $corpus->addPositiveWord('is');
        $corpus->addPositiveWord('one');
        $corpus->addPositiveWord('in');
        $corpus->addPositiveWord('six');

        $this->assertEquals(1/6, $corpus->getPositiveProbability('the'));
        $this->assertEquals(1/6, $corpus->getPositiveProbability('six'));
        $this->assertEquals(0, $corpus->getPositiveProbability('hello'));
    }

    public function testLoadingDataFile()
    {
        $corpus = new SentimentAnalyzer\Corpus('../tests/test-corpus.json');

        $this->assertEquals(11, $corpus->getPositiveCount());
        $this->assertEquals(13, $corpus->getNegativeCount());

        $this->assertEquals(5, $corpus->getPositiveCount('the'));
        $this->assertEquals(4, $corpus->getNegativeCount('it'));

        $this->assertEquals(2/11, $corpus->getPositiveProbability('good'));
        $this->assertEquals(2/13, $corpus->getNegativeProbability('bad'));
    }
}
 