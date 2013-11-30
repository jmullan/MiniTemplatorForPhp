<?php
namespace tests;


/**
 *
 */
class EngineTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
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
        $output = ob_get_clean();
        $this->assertEquals($expected, $output);
    }
}
