<?php
namespace tests;


class EngineTest extends \PHPUnit_Framework_TestCase
{

    public function testSampleOne()
    {
        $expected = file_get_contents(__DIR__ . '/sample1_output.htm');

        $t = new \MiniTemplator\Engine();
        $t->readTemplateFromFile(__DIR__ . '/sample1_template.htm');
        $t->setVariable("animal1", "fox");
        $t->setVariable("animal2", "dog");
        $t->addBlock("block1");
        $t->setVariable("animal1", "horse");
        $t->setVariable("animal2", "cow");
        $t->addBlock("block1");
        ob_start();
        $t->generateOutput();
        $actual = ob_get_clean();
        $this->assertEquals($expected, $actual);
    }
    public function testSampleTwo()
    {
        $t = new \MiniTemplator\Engine();
        $ok = $t->readTemplateFromFile(__DIR__ . "/sample2_template.htm");
        $t->setVariable("year", "2003");
        $t->setVariable("month", "April");
        for ($weekOfYear=14; $weekOfYear<=18; $weekOfYear++) {
            for ($dayOfWeek=0; $dayOfWeek<7; $dayOfWeek++) {
                $dayOfMonth =($weekOfYear*7 + $dayOfWeek) - 98;
                if ($dayOfMonth >= 1 && $dayOfMonth <= 30) {
                    $t->setVariable("dayOfMonth", $dayOfMonth);
                } else {
                    $t->setVariable("dayOfMonth", "&nbsp;");
                }
                $t->addBlock("day");
            }
            $t->setVariable("weekOfYear", $weekOfYear);
            $t->addBlock("week");
        }
        ob_start();
        $t->generateOutput();
        $actual = ob_get_clean();
        $expected = file_get_contents(__DIR__ . '/sample2_output.htm');
        $this->assertEquals($expected, $actual);
    }
}
