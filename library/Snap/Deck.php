<?php
/**
 * Deck of cards. It has one of each cards.
 *
 * @license LICENSE.txt
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */

use Snap\Card;
use Snap\Player;

/**
 * Class Deck
 */
class Deck {

	/**
	 * @var \Snap\Card[]
	 */
	private $cards;

	/**
	 *
	 */
	public function __construct(){

		// four groups
		for ($i = 0; $i < 4; $i++) {

			// 14 values
			for ($n = 1; $n < 14; $n++) {
				$card = new Card();
				$card->setGroup($i);
				$card->setValue($n);
				$this->cards[] = $card;
			}
		}

		// shuffle the cards
		shuffle($this->cards);
	}

	/**
	 * Deal cards to the players
	 *
	 * @param $getPlayers
	 *
	 * return Deck
	 */
	public static function dealCards( SplObjectStorage $players ) {
		$deck = new self();

		/** @var Card $card */
		foreach($deck->getCards() as $card){

			/** @var Player $player */
			$player = $players->current();
			if (empty($player)) {
				$players->rewind();
				$player = $players->current();
			}

			$player->addCard($card);

			$players->next();
		}

		return $deck;
	}

	/**
	 * @return \Snap\Card[]
	 */
	public function getCards() {
		return $this->cards;
	}

	/**
	 * @param \Snap\Card[] $cards
	 *
	 * @return Deck
	 */
	public function setCards( $cards ) {
		$this->cards = $cards;
	}
}
