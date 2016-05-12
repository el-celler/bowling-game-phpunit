<?php
namespace Bowling;

class Game
{
    /** @var int $score  */
    private $score = 0;
    /** @var array  */
    private $rolls = array();
    /** @var int  */
    private $currentRoll = 0;

    /**
     * Game constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $pins
     */
    public function roll($pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    /**
     * @return int
     */
    public function score()
    {
        $score = 0;
        for ($i = 0; $i < count($this->rolls) ; $i++) {
            $score += $this-> rolls[$i];
        }
        return $score;
    }
}