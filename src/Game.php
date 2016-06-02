<?php
namespace Bowling;

class Game
{
    const FRAMES_IN_GAME = self::ALL_PINS_DOWN;
    const ALL_PINS_DOWN  = 10;
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
        for ($frame = 0; $frame < self::FRAMES_IN_GAME; $frame++) {
            if ($this->isStrike($rollIndex)) {
                $score += $this->strikeScore($rollIndex);
                $rollIndex++;
            } elseif ($this->isSpare($rollIndex)) {
                $score += $this->spareScore($rollIndex);
                $rollIndex += 2;
            } else {
                $score += $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
                $rollIndex += 2;
            }
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
        return ($this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1]) == self::ALL_PINS_DOWN;
    }

    /**
     * @param $rollIndex
     *
     * @return bool
     */
    public function isStrike($rollIndex)
    {
        return $this->rolls[$rollIndex] == self::ALL_PINS_DOWN;
    }

    /**
     * @param $rollIndex
     *
     * @return mixed
     */
    public function strikeBonus($rollIndex)
    {
        return $this->rolls[$rollIndex + 1] + $this->rolls[$rollIndex + 2];
    }

    /**
     * @param $rollIndex
     *
     * @return mixed
     */
    protected function spareBonus($rollIndex)
    {
        return $this->rolls[$rollIndex + 2];
    }

    /**
     * @param $rollIndex
     *
     * @return int
     */
    protected function strikeScore($rollIndex)
    {
        return self::ALL_PINS_DOWN + $this->strikeBonus($rollIndex);
    }

    /**
     * @param $rollIndex
     *
     * @return int
     */
    protected function spareScore($rollIndex)
    {
        return self::ALL_PINS_DOWN + $this->spareBonus($rollIndex);
    }
}