<?php
/**
 * Current pile of cards
 *
 * @license LICENSE.txt
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */
namespace Snap;

use Snap\Card;

/**
 * Class Pile
 *
 * @package Snap
 */
class Pile {

	/**
	 * @var Card[]
	 */
	private $cards;

	/**
	 * @var int
	 */
	private $playersNumber;

	/**
	 * New cards pile
	 *
	 * @param int $players
	 */
	public function __construct($players = 0) {
		$this->playersNumber = $players;
	}

	/**
	 * Is this pile valid?
	 *
	 * @return bool
	 */
	public function isValid() {
		if (count($this->cards) < 3) {
			return true;
		}

		$count = count($this->cards);

		if ($this->cards[$count-1]->getValue() == $this->cards[$count-2]->getValue()) {
			return false;
		}

		return true;
	}

	/**
	 * Reset a pile
	 */
	public function reset() {
		$this->cards = array();
	}

	/**
	 * Count number of cards in a pile
	 *
	 * @return int
	 */
	public function count() {
		return count($this->cards);
	}

	/**
	 * Add one new player
	 */
	public function addOnePlayer(){
		$this->playersNumber++;
	}

	/**
	 * Get cards from a pile
	 *
	 * @return Card[]
	 */
	public function getCards() {
		return $this->cards;
	}

	/**
	 * Place a card on the bottom of a card pile
	 *
	 * @param $card
	 */
	public function addCard(Card $card) {
		$this->cards[] = $card;
	}
}
