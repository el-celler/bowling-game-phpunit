<?php

namespace Bowling;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var Game $game */
    private $game;



    public function testOneSpare()
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->rollMany(17,0);
        $this->assertSame(16, $this->game->score());
    }

    public function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    public function testOneStrike()
    {
        $this->rollStrike();
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(16, 0);
        $this->assertSame(24, $this->game->score());
    }

    public function rollStrike()
    {
        $this->game->roll(10);
    }

    /**
     * SetUp for each test
     */
    protected function setUp()
    {
        $this->game = new Game();
    }

    /**
     * @param int $rolls
     * @param int $pins
     */
    protected function rollMany($rolls, $pins)
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

    public function testGameGutterGame()
    {
        $this->rollMany(20, 0);
        $this->assertSame(0, $this->game->score());
    }

    public function testGameAllOnes()
    {
        $this->rollMany(20, 1);
        $this->assertSame(20, $this->game->score());
    }
}
