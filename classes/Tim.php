<?php
require_once "Minion.php";

class Tim extends Minion
{

  public $bananaStrikeChance = 10;
  public $umbrellaShieldChance = 20;


  public function __construct()
  {
    $name = 'Tim';
    $health = rand(70, 100);
    $strength = rand(70, 80);
    $defense = rand(45, 55);
    $speed = rand(40, 50);
    $luck = rand(10, 30);
    $skills = ['bananaStrike', 'umbrellaShield'];

    parent::__construct($name, $health, $strength, $defense, $speed, $luck, $skills);
  }
}
