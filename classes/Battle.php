<?php

class Battle
{

  public $firstPlayer;

  public $secondPlayer;

  public function compareSpeedAndLuck($minion1, $minion2)
  {
    if ($minion1->getSpeed() > $minion2->getSpeed() || ($minion1->getSpeed() == $minion2->getSpeed() && $minion1->getLuck() > $minion2->getLuck())) {
      return $minion1;
    } else {
      return $minion2;
    }
  }

  public function bananaStrike()
  {
    $chance = 10;
    $randomNumber = rand(1, 100);
    if ($randomNumber < $chance + 1) {
      return true;
    } else {
      return false;
    }
  }

  public function umbrellaShield()
  {
    $chance = 20;
    $randomNumber = rand(1, 100);
    if ($randomNumber < $chance + 1) {
      return true;
    } else {
      return false;
    }
  }

  public function switchRoles($currentAttacker, $currentDefender)
  {
    $nextAttacker = $currentDefender;
    $nextDefender = $currentAttacker;

    return [$nextAttacker, $nextDefender];
  }


  public function performAttackSimple($attacker, $defender)
  {
    $damage = $attacker->getStrength() - $defender->getDefense();
    $newHealth = $defender->getHealth() - $damage;
    $defender->setHealth($newHealth);
    echo "<p>{$attacker->getName()} performed a simple attack and dealt $damage damage to {$defender->getName()} ({$defender->getHealth()}).</p>";
  }

  public function performAttackBanana($attacker, $defender)
  {

    $damage = $attacker->getStrength() * 2 - $defender->getDefense();
    $newHealth = $defender->getHealth() - $damage;
    $defender->setHealth($newHealth);
    echo "<p>{$attacker->getName()} used Banana Strike and dealt $damage damage to {$defender->getName()} ({$defender->getHealth()}).</p>";
  }

  public function performDefenseUmbrella($attacker, $defender)
  {

    $damage = ($attacker->getStrength() - $defender->getDefense()) / 2;
    $newHealth = $defender->getHealth() - $damage;
    $defender->setHealth($newHealth);
    echo "<p>{$attacker->getName()} received Umbrella Shield and dealt $damage damage to {$defender->getName()} ({$defender->getHealth()}).</p>";
  }
}
