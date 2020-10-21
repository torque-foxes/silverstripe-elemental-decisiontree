<?php

namespace DNADesign\SilverStripeElementalDecisionTree\Tests\Model;

use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeAnswer;
use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeStep;
use SilverStripe\Dev\SapphireTest;

class DecisionTreeAnswerTest extends SapphireTest
{

    protected static $fixture_file = './ElementDecisionTreeTest.yml';

    public function testToJSONData()
    {
        $answer = $this->objFromFixture(DecisionTreeAnswer::class, 'one_one');
        $step = $this->objFromFixture(DecisionTreeStep::class, 'two');

        $data = $answer->toJSONData();

        $this->assertEquals('Red', $data['title']);
        $this->assertEquals($step->ID, $data['goTo']);
    }
}
