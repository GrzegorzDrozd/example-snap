<?php
/**
 * Object representing a card in a game.
 *
 * It has a group: Hearts, Diamonds, Clubs, Spades and a value.
 *
 * @license LICENSE.txt
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */
namespace Snap;

/**
 * Class Card
 *
 * @package Snap
 */
class Card {

	/**
	 * Hearts, Diamonds, Clubs, Spades,
	 *
	 * @var string
	 */
	private $group;

	/**
	 * ace(1), 2-10, jack(11), queen(12), king(13)
	 *
	 * @var int
	 */
	private $value;

	/**
	 * Get group
	 *
	 * @return string
	 */
	public function getGroup() {
		return $this->group;
	}

	/**
	 * Set group
	 *
	 * @param string $group
	 *
	 * @return Card
	 */
	public function setGroup( $group ) {
		$this->group = $group;
	}

	/**
	 * Get value
	 *
	 * @return int
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Set value
	 *
	 * @param int $value
	 *
	 * @return Card
	 */
	public function setValue( $value ) {
		$this->value = $value;
	}

	/**
	 * Get text representation of a card. Group and a value
	 *
	 * @return string
	 */
	public function __toString() {
		$ret = '';

		switch($this->value) {
			case 1;
				$ret = 'Ace';
				break;
			case 11;
				$ret = 'Jack';
				break;
			case 12;
				$ret = 'Queen';
				break;
			case 13;
				$ret = 'King';
				break;
			default:
				$ret = (string)$this->value;
		}

		$ret .= ' of ';

		switch($this->group) {
			case 0:
				$ret .= 'Hearts';
				break;
			case 1:
				$ret .= 'Diamonds';
				break;
			case 2:
				$ret .= 'Clubs';
				break;
			case 3:
				$ret .= 'Spades';
				break;
		}

		return $ret;
	}
}
