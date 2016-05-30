<?php
class StackTest extends PHPUnit_Framework_TestCase
{
    public function testMatchingIncrementalSequentialCharacters() {
        include_once( dirname(__FILE__) . '/../../day11/part1.php');
        $testString = "abc";
        $this->assertTrue(matchSequentialIncreasing($testString));
    }

    public function testNotMatchingIncrementalSequentialCharacters() {
        include_once( dirname(__FILE__) . '/../../day11/part1.php');
        $testString = "abd";
        $this->assertFalse(matchSequentialIncreasing($testString));
    }

    public function testMatchingIncrementalSequentialCharactersInLargerString() {
        include_once( dirname(__FILE__) . '/../../day11/part1.php');
        $testString = "aadsdfabcbbbytr";
        $this->assertTrue(matchSequentialIncreasing($testString));
    }
}
