<?php
namespace Bowling;

class Game
{
    /** @var int $score  */
    private $score = 0;

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
        $this->score += $pins;
    }

    /**
     * @return int
     */
    public function score()
    {
        return $this->score;
    }
}