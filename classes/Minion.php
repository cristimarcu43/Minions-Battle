<?php

class Minion
{
  private $name;

  private $health;

  private $strength;

  private $defense;

  private $speed;

  private $luck;

  private $skills;

  public $attackDamage;

  public function __construct($name, $health, $strength, $defense, $speed, $luck, $skills)
  {
    $this->name = $name;
    $this->health = $health;
    $this->strength = $strength;
    $this->defense = $defense;
    $this->speed = $speed;
    $this->luck = $luck;
    $this->skills = $skills;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getHealth()
  {
    return $this->health;
  }

  public function setHealth($newHealth)
  {
    $this->health = $newHealth;
  }

  public function getStrength()
  {
    return $this->strength;
  }

  public function setStrength($newStrength)
  {
    $this->strength = $newStrength;
  }

  public function getDefense()
  {
    return $this->defense;
  }

  public function setDefense($newDefense)
  {
    $this->defense = $newDefense;
  }

  public function getSpeed()
  {
    return $this->speed;
  }
  public function getLuck()
  {
    return $this->luck;
  }

  public function getSkills()
  {
    return $this->skills;
  }

  public function setSkills($newSkills)
  {
    $this->skills = $newSkills;
  }

  // public function calculateDamage()
  // {
  //   $this->attackDamage = max($this->getStrength() - $this->getDefense(), 0);
  // }

  // public function bananaStrike()
  // {
  //   return $this->attackDamage * 2;
  // }

  // public function umbrellaShield($attack)
  // {
  //   return $attack / 2;
  // }
}
