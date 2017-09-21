<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error;

require('../academy21.php');

class StackTest extends TestCase {

    public function testtotalCardsSuccess() {
        $hand = [4,7];
        $total = totalCards($hand);

        $this->assertEquals(11, $total);
    }

    public function testtotalCards1ElementArray() {
        $hand = [3];
        $total = totalCards($hand);

        $this->assertEquals(3, $total);
    }


    public function testtotalCardsStringInput() {
        $hand = "whadup";
        $total = totalCards($hand);

        $this->assertEquals(0, $total);
    }

    public function testtotalCardsAbove21() {
        $hand = [11,11];
        $total = totalCards($hand);

        $this->assertEquals(12, $total);
    }

    public function testcreateDeck() {
        $deck = createDeck();
        $actualDeck = [11, 11, 11, 11, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 5, 6, 6, 6, 6, 7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 9, 9, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];

        $this->assertEquals($actualDeck, $deck);
    }

    public function testpickCardRegularArray() {
        $deck = [1, 3, 4, 6, 7, 3, 2, 1, 5, 8, 8, 3, 2, 6, 9];
        $card = pickCard($deck);

        $this->assertTrue($card < count($deck) && $card >= 0);
    }

    public function testpickCardStringInput() {
        $deck="Sup G";
        $total = pickCard($deck);

        $this->assertEquals(0, $total);
    }

    public function testremoveFromDeckSuccess() {
        $deck = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 11, 11 ,13, 10];
        $key = 5;
        $deck = removeFromDeck($deck, $key);

        $this->assertNotContains(6, $deck);
    }

    public function testremoveFromDeckUnmatchedKey() {
        $deck = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 11, 11 ,13, 10];
        $key = 100;
        $result = removeFromDeck($deck, $key);

        $this->assertEquals(0, $result);
    }

    public function testremoveFromDeckStringInput() {
        $deck = "Boyo";
        $key = 102;
        $result = removeFromDeck($deck, $key);

        $this->assertEquals(0, $result);
    }

    public function testdecideWinnerSuccessWin() {
        $your_total = [8, 5];
        $dealers_total = [2, 3];

        $statement = decideWinner($your_total, $dealers_total);
        $expectedStatement = "Your total is " . 13 . "<br>" . "Dealers total is " . 5 . "<br>" . "You Win";

        $this->assertEquals($expectedStatement, $statement);
    }

    public function testdecideWinnerSuccessDraw() {
        $your_total = [8, 5];
        $dealers_total = [10, 3];

        $statement = decideWinner($your_total, $dealers_total);
        $expectedStatement = "Your total is " . 13 . "<br>" . "Dealers total is " . 13 . "<br>" . "It's a Draw";

        $this->assertEquals($expectedStatement, $statement);
    }

    public function testdecideWinnerSuccessLoss() {
        $your_total = [8, 5];
        $dealers_total = [10, 7];

        $statement = decideWinner($your_total, $dealers_total);
        $expectedStatement = "Your total is " . 13 . "<br>" . "Dealers total is " . 17 . "<br>" . "You lose";

        $this->assertEquals($expectedStatement, $statement);
    }

    public function testdecideWinnerWithLargerArrays() {
        $your_total = [5, 6, 4, 3, 2, 5];
        $dealers_total = [1, 2, 3, 4, 5, 6, 7, 8, 8, 8];

        $statement = decideWinner($your_total, $dealers_total);
        $expectedStatement = "Your total is " . 25 . "<br>" . "Dealers total is " . 52 . "<br>" . "You lose";

        $this->assertEquals($expectedStatement, $statement);
    }

    public function testdecideWinnerWithStrings() {
        $your_total = "Noice";
        $dealers_total = "Smort";

        $statement = decideWinner($your_total, $dealers_total);

        $this->assertEquals(0, $statement);

    }
}