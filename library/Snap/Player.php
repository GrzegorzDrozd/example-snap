<?php
/**
 * Player representation
 *
 * @license LICENSE.txt
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */
namespace Snap;

use Snap\Card;

/**
 * Class Player
 *
 * @package Snap
 */
class Player {

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var \Snap\Card[]
	 */
	private $cards;

	/**
	 * @param $name
	 */
	public function __construct($name) {
		$this->setName($name);
	}

	/**
	 * Add pile of cards to the player
	 *
	 * @param Pile $pile
	 */
	public function addPile( Pile $pile) {
		$this->cards = array_merge($this->cards, $pile->getCards());
		$pile->reset();

		return $this;
	}

	/**
	 * @param \Snap\Card $card
	 */
	public function addCard( Card $card ) {
		$this->cards[] = $card;
	}

	/**
	 * @return Card|null
	 */
	public function getNextCard() {
		return array_pop($this->cards);
	}

	/**
	 * @return int
	 */
	public function getCardsCount() {
		return count($this->cards);
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return Player
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return Card[]
	 */
	public function getCards() {
		return $this->cards;
	}

	/**
	 * @param Card[] $cards
	 *
	 * @return Player
	 */
	public function setCards( $cards ) {
		$this->cards = $cards;
	}
}
