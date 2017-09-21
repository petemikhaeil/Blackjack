<?php

/*
 * The function creates the deck of cards, 4 of each number and then 16 10's (representing the picture cards)
 *
 * returns an array of a full deck
 */

function createDeck(){
    $deck = [];
    for($i = 1; $i < 14; $i++) {
        for($j = 0; $j < 4; $j++) {
            if($i < 10 && $i > 1) {
                $deck[] = $i;
            }
            else if($i > 9) {
                $deck[] = 10;
            }
            else if($i == 1) {
                $deck[] = 11;
            }
        }
    }
    return $deck;
}


/*
 * The function randomly picks a card from a deck and then removes it from the deck
 *
 * @params $deck array The parameter should be an array of a set of cards
 *
 * returns a random card/value from the deck
 */

function pickCard($deck) {
    if(gettype($deck) != 'array') {
        return 0;
    }
    else {
        $rand = array_rand($deck);
        return $rand;
    }
}


/*
 * The function totals the value of cards in your hand
 *
 * @params $hand array the paramater is an array of cards in your hand
 *
 * returns the total of the values of cards in your hand
 */

function totalCards($hand) {
    if(gettype($hand) != 'array') {
        return 0;
    }
    else {
        $total = 0;
        foreach ($hand as $card) {
            if (is_int($card)) {
                $total += $card;
            }
        }
        if ($total > 21 && in_array(11, $hand) == 1) {
            $total -= 10;
        }
        return $total;
    }
}
/*
 * This function removes a card from the deck
 *
 * @param $deck array the parameter which is the deck of cards
 * @param $card integer the card to be removed from the deck
 *
 * @returns a new deck with the value of the card missing
 */

function removeFromDeck($deck, $cardKey) {
    if(gettype($deck) != 'array' || gettype($cardKey)  != 'integer') {
        return 0;
    }
    else {
        if($cardKey < count($deck) && $cardKey >= 0) {
            unset($deck[$cardKey]);
            return $deck;
        }
        else{
            return 0;
        }
    }
}

/*
 * The function which decides which player is the winner
 *
 * @params $your_hand array used in order to total player 1's hand in order to compare to the other player
 * @params $dealers_hand array used in order to total player 2's hand in order to compare to the other player
 *
 * returns a string which says which player wins
 */
function decideWinner($your_hand, $dealers_hand) {
    if(gettype($your_hand) != 'array' || gettype($dealers_hand) != 'array') {
        return 0;
    }
    else {
        $your_total = totalCards($your_hand);
        $dealers_total = totalCards($dealers_hand);
        $result = "Your total is " . $your_total . "<br>";
        $result .= "Dealers total is " . $dealers_total . "<br>";

        if ($your_total > $dealers_total) {
            $result .= "You Win";
        } else if ($your_total == $dealers_total) {
            $result .= "It's a Draw";
        } else {
            $result .= "You lose";
        }
        return $result;
    }
}

/*
 * This function runs the other function to actually play the game
 *
 *returns the result in the form of a string saying who wins
 */
function playGame() {
    $deck = createDeck();
    $card1 = pickCard($deck);
    $your_hand[] = $deck[$card1];
    $deck = removeFromDeck($deck, $card1);
    $card2 = pickCard($deck);
    $your_hand[] = $deck[$card2];
    $deck = removeFromDeck($deck, $card2);
    $card3 = pickCard($deck);
    $dealers_hand[] = $deck[$card3];
    $deck = removeFromDeck($deck, $card3);
    $card4 = pickCard($deck);
    $dealers_hand[] = $deck[$card4];
    $result = decideWinner($your_hand, $dealers_hand);
    return $result;
}

echo playGame();


