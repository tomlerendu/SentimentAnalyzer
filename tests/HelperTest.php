<?php

class HelperTest extends PHPUnit_Framework_TestCase
{
    public function testTokenize()
    {
        $strings = [
            'Hello',
            'Hello world',
            'Hello, world',
            'Hello,,,- World,,,',
            'Hello  world',
            'Hello world (hello world)',
            'HELLO WORLD',
            'Hello... World',
            'hello! world!!'
        ];

        $expectedResults = [];
        foreach($strings as $item)
            $expectedResults[] = SentimentAnalyzer\Helper::tokenize($item);

        $actualResults = [
            ['hello'],
            ['hello', 'world'],
            ['hello', 'world'],
            ['hello', 'world'],
            ['hello', 'world'],
            ['hello', 'world', 'hello', 'world'],
            ['hello', 'world'],
            ['hello', 'world'],
            ['hello', 'world']
        ];

        for($i=0; $i<count($strings); $i++)
            $this->assertTrue($actualResults[$i] === $expectedResults[$i]);
    }
}
 