<?php
require_once "Minion.php";

class Evil extends Minion
{
  public function __construct()
  {
    $name = 'Evil';
    $health = rand(60, 90);
    $strength = rand(60, 90);
    $defense = rand(40, 60);
    $speed = rand(40, 60);
    $luck = rand(25, 40);
    $skills = [];

    parent::__construct($name, $health, $strength, $defense, $speed, $luck, $skills);
  }
}
