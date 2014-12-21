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
}
 