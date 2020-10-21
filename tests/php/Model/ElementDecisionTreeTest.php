<?php

namespace DNADesign\SilverStripeElementalDecisionTree\Tests\Model;

use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeAnswer;
use DNADesign\SilverStripeElementalDecisionTree\Model\DecisionTreeStep;
use DNADesign\SilverStripeElementalDecisionTree\Model\ElementDecisionTree;
use SilverStripe\Dev\SapphireTest;

class ElementDecisionTreeTest extends SapphireTest
{

    protected static $fixture_file = './ElementDecisionTreeTest.yml';

    public function testGetBlockJSON()
    {
        $tree = $this->objFromFixture(ElementDecisionTree::class, 'one');

        $step = $this->objFromFixture(DecisionTreeStep::class, 'one');
        $step2 = $this->objFromFixture(DecisionTreeStep::class, 'two');

        $answer = $this->objFromFixture(DecisionTreeAnswer::class, 'one_one');
        $answer2 = $this->objFromFixture(DecisionTreeAnswer::class, 'one_two');
        $answer3 = $this->objFromFixture(DecisionTreeAnswer::class, 'one_three');

        $data = json_decode($tree->getBlockJSON(), true);

        // check block data
        $this->assertEquals('Test Element Decision Tree', $data['blockTitle']);
        $this->assertEquals('<p>Select answers below</p>', $data['blockIntro']);

        // check steps data
        $this->assertEquals(2, count($data['steps']));
        $this->assertEquals([$step->ID, $step2->ID], array_keys($data['steps']));

        foreach ($data['steps'] as $stepData) {
            $this->assertTrue(array_key_exists('title', $stepData));
            $this->assertTrue(array_key_exists('isQuestion', $stepData));
            $this->assertTrue(array_key_exists('content', $stepData));
            $this->assertTrue(array_key_exists('hideTitle', $stepData));
            $this->assertTrue(array_key_exists('answers', $stepData));
            $this->assertTrue(array_key_exists('isFirst', $stepData));
        }

        // check answers data
        $this->assertEquals(3, count($data['answers']));
        $this->assertEquals([$answer->ID, $answer2->ID, $answer3->ID], array_keys($data['answers']));

        foreach ($data['answers'] as $answerData) {
            $this->assertTrue(array_key_exists('title', $answerData));
            $this->assertTrue(array_key_exists('goTo', $answerData));
        }
    }
}
