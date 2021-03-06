<?php
require_once '/var/www/pop/web/assets/autoload.php';

if (!$isLoggedIn)
  $UserSystem->redirect('/user/login?mustBeLoggedIn');

$lobbies = $pop->browseLobbies();

echo '<div class="ribbon"><div><table><tr>';
echo '<th></th>';
echo '<th>Owner</th>';
echo '<th>Current Players</th>';
echo '<th>Max Players</th>';
echo '<th>Language</th>';
echo '</tr>';

/**
 * @var lobby $lobby
 */
foreach ($lobbies as $lobby) {
  if (!is_object($lobby))
    continue;

  $row = "<tr class='clickable-row' data-href='$lobby->joinURL'>";
  $row .= "<td>$lobby->name</td>";
  $row .= "<td>{$lobby->owner->username}</td>";
  $row .= "<td>$lobby->currentPlayers</td>";
  $row .= "<td>$lobby->maxPlayers</td>";
  $row .= "<td>$lobby->language</td>";
  $row .= "</tr>";
  echo $row;
}

echo '</table></div></div>';
?>

<script>
  jQuery(document).ready(function ($) {
    $(".clickable-row").click(function () {
      window.location = $(this).data("href");
    });
  });
</script>
