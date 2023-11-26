<?php include_once "header.php";
session_start();


include "db-connection.php";


$displayButtonGenerate = true;
$displayButtonFight = false;

if (isset($_POST['generate'])) {
  $displayButtonGenerate = false;
  $displayButtonFight = true;
}
?>

<form method="post">
  <?php if ($displayButtonGenerate) { ?>
    <input type="submit" name="generate" value="Generate Stats and Play Fight" />
  <?php } else { ?>
    <!-- <input type="submit" name="fight" value="Fight" /> -->
  <?php } ?>
</form>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var generateButton = document.querySelector('input[name="generate"]');
    var fightButton = document.querySelector('input[name="fight"]');

    if (generateButton) {
      generateButton.addEventListener("click", function() {
        generateButton.style.display = "none";
        fightButton.style.display = "inline-block";
      });
    }
  });
</script>

<?php
include_once __DIR__ . "/classes/Tim.php";
include_once __DIR__ . "/classes/Evil.php";
$tim = new Tim();
$evil = new Evil();

?>


<div class="container">
  <div class="first-column">
    <div class="text-layer">
      <?php echo "<h1>" . $tim->getName() . "</h1>" ?>
      <div class="info-stats">
        <ul>
          <?php
          if (isset($_POST['generate'])) {
            // require_once __DIR__ . "/classes/game/Tim.php";
            // $Tim = new Tim(rand(70, 100), rand(70, 80), rand(45, 55), rand(40, 50), rand(10, 30), []);

            echo "<li>Health:" . $tim->getHealth() . " </li>";
            echo "<li>Strength:" . $tim->getStrength() . "</li>";
            echo "<li>Defense:" . $tim->getDefense() . " </li>";
            echo "<li>Speed:" . $tim->getSpeed() . "</li>";
            echo "<li>Luck:" . $tim->getLuck() . " </li>";
          }

          // $_SESSION['Tim'] = $Tim;
          ?>
        </ul>
      </div>
      <div class="ability-stats">
        <h2>Abilities</h2>
        <?php
        $timSkills = $tim->getSkills();
        if ($timSkills) {
          foreach ($timSkills as $skill) {
            echo "<p>$skill</p>";
          }
        }
        ?>
      </div>
    </div>
  </div>


  <div class="third-column">
    <div class="text-layer">
      <?php echo "<h1>" . $evil->getName() . "</h1>" ?>
      <div class="info-stats">
        <ul>
          <?php
          if (isset($_POST['generate'])) {
            // require_once __DIR__ . "/classes/game/Evil.php";
            // $Evil = new Evil(rand(60, 90), rand(60, 90), rand(40, 60), rand(40, 60), rand(25, 40));

            echo "<li>Health:" . $evil->getHealth() . " </li>";
            echo "<li>Strength:" . $evil->getStrength() . "</li>";
            echo "<li>Defense:" . $evil->getDefense() . " </li>";
            echo "<li>Speed:" . $evil->getSpeed() . "</li>";
            echo "<li>Luck:" . $evil->getLuck() . " </li>";
          }

          // $_SESSION['Evil'] = $Evil;
          ?>
        </ul>
      </div>
      <div class="ability-stats">
        <h2>Abilities</h2>
        <?php
        $evilSkills = $evil->getSkills();
        if ($evilSkills) {
          foreach ($evilSkills as $skill) {
            echo "<p>$skill</p>";
          }
        } else {
          echo "<p> Doesn't have yet</p>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['generate'])) {
  require_once __DIR__ . '/classes/Battle.php';
  include_once "header.php";
  $battle = new Battle();

  // Stabilim cine este atacatorul si cine este aparatorul in prima runda
  $attacker = $battle->compareSpeedAndLuck($tim, $evil);
  $defender = ($attacker == $tim) ? $evil : $tim;

  $round = 1;
  $maxRounds = 20;

  while ($tim->getHealth() > 0 && $evil->getHealth() > 0 && $round <= $maxRounds) {

    $attackerClass = ($attacker == $tim) ? 'attacker-tim' : 'attacker-evil';
    echo "<div class='round $attackerClass'>";
    echo "<p>Round $round</p>";

    $missChance = rand(0, 100);

    if ($missChance >= $defender->getLuck()) {

      $bananaStrikePerformed = false;
      if ($attacker instanceof Tim) {

        foreach ($attacker->getSkills()  as $skill) {
          if ($skill == "bananaStrike" && $battle->bananaStrike() == true) {
            $battle->performAttackBanana($attacker, $defender);
            $bananaStrikePerformed = true;
            break;
          }
        }

        if (!$bananaStrikePerformed) {
          $battle->performAttackSimple($attacker, $defender);
        }
      }
      $umbrellaShieldPerformed = false;
      if ($attacker instanceof Evil) {

        foreach ($defender->getSkills()  as $skill) {
          if ($skill == 'umbrellaShield' && $battle->umbrellaShield() == true) {

            $battle->performDefenseUmbrella($attacker, $defender);
            $umbrellaShieldPerformed = true;
            break;
          }
        }
        if (!$umbrellaShieldPerformed) {
          $battle->performAttackSimple($attacker, $defender);
        }
      }
    } else {
      $damage = 0;
      echo "<p>{$attacker->getName()} was not lucky and throw $damage damage.  </p>";
    }

    echo '</div>';

    $round++;

    if ($round <= $maxRounds) {
      list($attacker, $defender) = $battle->switchRoles($attacker, $defender);
    }
  }

  $winner = ($tim->getHealth() <= 0) ? $evil->getName() : $tim->getName();
  echo '<div class="result-fight">';
  echo '<h1 class="winner">' . $winner . ' Win!</h1>';
  $loser = ($winner === $tim->getName()) ? $evil->getName() : $tim->getName();
  $fightdate = date('Y-m-d H:i:s');
  $roundsplayed  = $round;
  echo '</div>';

  $conn = OpenCon();

  $sql = "INSERT INTO battles (name_winner, name_loser, rounds_played, fight_date)
  VALUES ('$winner', '$loser', '$roundsplayed', '$fightdate')";

  if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  CloseCon($conn);
?>
  <form method="post">
    <input type="submit" name="restart" value="Restart Game" />
  </form>
<?php

} elseif (isset($_POST['restart'])) {
  header("Location: index.php");
}
?>