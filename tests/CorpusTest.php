<?php


class CorpusTest extends PHPUnit_Framework_TestCase
{
    public function testWordCount()
    {
        $corpus = new SentimentAnalyzer\Corpus();

        $corpus->addPositiveString('This sentence has two written two times in it.');
        $corpus->addPositiveString('Another string.');
        $corpus->addNegativeString('Three is written three times in this sentence to make getNegativeCount return three.');
        $corpus->addNegativeString('This is another string');

        $this->assertEquals(2, $corpus->getPositiveCount('two'));
        $this->assertEquals(1, $corpus->getPositiveCount('this'));
        $this->assertEquals(1, $corpus->getPositiveCount('another'));
        $this->assertEquals(0, $corpus->getPositiveCount('hello'));

        $this->assertEquals(3, $corpus->getNegativeCount('three'));
        $this->assertEquals(1, $corpus->getNegativeCount('getnegativecount'));
        $this->assertEquals(1, $corpus->getNegativeCount('another'));
        $this->assertEquals(0, $corpus->getNegativeCount('hello'));
    }

    public function testProbability()
    {
        $corpus = new SentimentAnalyzer\Corpus();

        $corpus->addPositiveString('The probability is one in six.');

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
 