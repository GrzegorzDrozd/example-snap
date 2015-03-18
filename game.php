<?php

namespace Snap;

use \Snap\Card;

/**
 * Here are the rules of the game:
 * Two players are dealt the same number of cards from a shuffled deck.
 * Each player takes it in turns to place their next card on a pile between them.
 * If the two top cards on the pile match in numeric value (e.g. 9 == 9), the last player
 * to place a card takes all the cards in the pile.
 *
 * The game continues until one player is out of cards.
 *
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */

require_once 'library/Snap/Card.php';
require_once 'library/Snap/Deck.php';
require_once 'library/Snap/Game.php';
require_once 'library/Snap/Pile.php';
require_once 'library/Snap/Player.php';

$game = new \Snap\Game();

$game->addPlayer( new \Snap\Player( 'Player 1' ) );
$game->addPlayer( new \Snap\Player( 'Player 2' ) );
$game->addPlayer( new \Snap\Player( 'Player 3' ) );
$game->addPlayer( new \Snap\Player( 'Player 4' ) );

\Deck::dealCards($game->getPlayers());

//$game->play();
print_r($game->play()->getMessages());
