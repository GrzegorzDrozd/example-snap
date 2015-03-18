<?php
/**
 * Game of Snap!
 *
 * @license LICENSE.txt
 * @author  Grzegorz Drozd
 * @date    2015-03-12
 * @package example-snap
 */
namespace Snap;

/**
 * Class Game
 *
 * @package Snap
 */
class Game {

	/**
	 * @var Player[]
	 */
	private $players;

	/**
	 * @var int
	 */
	private $rounds;

	/**
	 * @var Pile
	 */
	private $pile;

	/**
	 * @var Player
	 */
	private $winner;

	/**
	 * @var string[]
	 */
	private $messages;

	/**
	 * Limit the number of rounds.
	 *
	 * @var int
	 */
	private $limit;

	/**
	 * Game constructor.
	 */
	public function __construct() {
		$this->pile = new Pile();

		$this->players = new \SplObjectStorage();
	}

	/**
	 *  Play the game
	 */
	public function play() {
		while($this->isValid()) {
			$this->playNextRound();
			$this->status();
		}

		$this->addMessage('WINNER: '.$this->getWinner()->getName());
		return $this;
	}
	/**
	 * @return string
	 */
	public function playNextRound(){

		do {
			$player = $this->getNextPlayer();
			$card = $player->getNextCard();

			$this->rounds++;

			// current player does not have any more cards.
			// remove player from the game.
			if (empty($card)) {
				$this->addMessage( 'Player ' . $player->getName() . ' does not have any more cards!' );
				$this->removePlayer( $player );
				continue;
			}
			$this->addMessage($player->getName().' puts '.$card->__toString());

			$this->getPile()->addCard($card);

		} while ($this->isValid() AND $this->getPile()->isValid() AND $this->checkRounds());

		if (count($this->players) == 1) {
			$this->setWinner($this->players->current());
		}

		$this->addMessage($this->players->current()->getName(). ' wins round and gets: '.$this->getPile()->count());
		$this->players->current()->addPile($this->getPile());
	}

	/**
	 * Check if this round is valid - round limit.
	 *
	 * @return bool
	 */
	private function checkRounds() {
		// fail safe for infinity game
		if ($this->rounds == $this->limit) {
			$this->setWinner($this->getPlayerWithMostCards());
			$this->addMessage('After '.$this->limit.' rounds '.$this->getWinner()->getName(). ' have more cards '.$this->getWinner()->getCardsCount());
			return false;
		}
		return true;
	}

	/**
	 * Return a player with most cards
	 *
	 * @return \Snap\Player
	 */
	private function getPlayerWithMostCards() {

		$playersByNumberOfCards = array();
		foreach($this->players as $player) {
			$playersByNumberOfCards[$player->getCardsCount()] = $player;
		}

		ksort($playersByNumberOfCards);

		return array_pop($playersByNumberOfCards);
	}

	/**
	 * Check if there is a winner set to this game
	 *
	 * @return bool
	 */
	public function isThereAWinner(){
		return !empty($this->winner);
	}

	/**
	 * Is this game valid
	 */
	private function isValid() {
		// if only one player left - set the winner
		return (count($this->players) > 1);
	}

	/**
	 * Get next player to draw a card
	 *
	 * @return \Snap\Player
	 */
	private function getNextPlayer() {

		$this->players->next();

		if (!$this->players->current()) {
			$this->players->rewind();
		}
		return $this->players->current();
	}

	/**
	 * Print status of a game
	 *
	 * @return string
	 */
	public function status() {
		$ret = "++++++++++++++++++++\n";
		foreach($this->players as $player){
			$ret .= $player->getName().' has '.$player->getCardsCount()." cards left\n";
		}
		$ret .= "=====================\n";
		$this->addMessage($ret);
		return $ret;
	}

	/**
	 * Add player to the game
	 *
	 * @param \Snap\Player $player
	 *
	 * @return $this
	 */
	public function addPlayer( Player $player ) {
		$this->players->attach($player);
		$this->pile->addOnePlayer();
		return $this;
	}

	/**
	 * Return current players
	 *
	 * @return \SplObjectStorage
	 */
	public function getPlayers() {
		return $this->players;
	}

	/**
	 * Set current players
	 *
	 * @param Player[] $players
	 *
	 * @return Game
	 */
	public function setPlayers( $players ) {
		$this->players = $players;
	}

	/**
	 * Get number of rounds
	 *
	 * @return array
	 */
	public function getRounds() {
		return $this->rounds;
	}

	/**
	 * Get current pile
	 *
	 * @return \Snap\Pile
	 */
	public function getPile() {
		return $this->pile;
	}

	/**
	 * Set current pile
	 *
	 * @param \Snap\Pile $pile
	 *
	 * @return Game
	 */
	public function setPile( $pile ) {
		$this->pile = $pile;
	}

	/**
	 * Get winner of a game
	 *
	 * @return \Snap\Player
	 */
	public function getWinner() {
		return $this->winner;
	}

	/**
	 * Set winner of a game
	 *
	 * @param \Snap\Player $winner
	 *
	 * @return Game
	 */
	public function setWinner( $winner ) {
		$this->winner = $winner;
	}

	/**
	 * Remove player from a game
	 *
	 * @param $playerToRemove
	 *
	 * @return bool
	 */
	private function removePlayer( $playerToRemove ) {
		$this->players->detach($playerToRemove);
		return true;
	}

	/**
	 * Add message to the log
	 *
	 * @param $message
	 *
	 * @return $this
	 */
	private function addMessage($message){
		$this->messages[] = $message;
		return $this;
	}

	/**
	 * Get messages from a log
	 *
	 * @return \string[]
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * Set messages log
	 *
	 * @param \string[] $messages
	 *
	 * @return Game
	 */
	public function setMessages( $messages ) {
		$this->messages = $messages;
	}


}
