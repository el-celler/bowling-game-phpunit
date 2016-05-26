<?php
namespace Bowling;

class Game
{
    /** @var int $score */
    private $score = 0;
    /** @var array */
    private $rolls = [];
    /** @var int */
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
        $score     = 0;
        $rollIndex = 0;
        for ($frameIndex = 0; $frameIndex < 10; $frameIndex++) {
            if ($this->isSpare($rollIndex)) {
                $score += 10 + $this->rolls[$rollIndex + 2];
            } else {
                $score += $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
            }
            $rollIndex += 2;
        }

        return $score;
    }

    /**
     * @param $rollIndex
     *
     * @return bool
     */
    public function isSpare($rollIndex)
    {
        return ($this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1]) == 10;
    }
}