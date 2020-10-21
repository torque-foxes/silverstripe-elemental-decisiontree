<?php

namespace DNADesign\SilverStripeElementalDecisionTree\Tests\Model;

use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeAnswer;
use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeStep;
use SilverStripe\Dev\SapphireTest;

class DecisionTreeStepTest extends SapphireTest
{

    protected static $fixture_file = './ElementDecisionTreeTest.yml';

    public function testToJSONData()
    {
        $step = $this->objFromFixture(DecisionTreeStep::class, 'one');
        $answer = $this->objFromFixture(DecisionTreeAnswer::class, 'one_one');
        $answer2 = $this->objFromFixture(DecisionTreeAnswer::class, 'one_two');
        $answer3 = $this->objFromFixture(DecisionTreeAnswer::class, 'one_three');

        $data = $step->toJSONData();

        $this->assertEquals('What is your favourite colour?', $data['title']);
        $this->assertTrue($data['isQuestion']);
        $this->assertEquals('<p>Select from the below answers</p>', $data['content']);
        $this->assertFalse($data['hideTitle']);
        $this->assertEquals([$answer->ID, $answer2->ID, $answer3->ID], $data['answers']);
        $this->assertTrue($data['isFirst']);
    }
}
