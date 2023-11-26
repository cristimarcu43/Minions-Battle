<?php
include_once "header.php";
include_once "db-connection.php";
session_start();

$conn = OpenCon();

$sql = "SELECT * FROM battles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table>";
  echo "<tr><th> Battle ID </th> <th> Winner </th> <th> Loser </th> <th> Rounds Played </th> <th> Fight Date </th> </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["battle_id"] . "</td>";
    echo "<td>" . $row["name_winner"] . "</td>";
    echo "<td>" . $row["name_loser"] . "</td>";
    echo "<td>" . $row["rounds_played"] . "</td>";
    echo "<td>" . $row["fight_date"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No battles found";
}


CloseCon($conn);
