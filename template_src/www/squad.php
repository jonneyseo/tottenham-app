
  <!-- The API where the data comes from and read them into a string as a PHP variable -->
  <?php 
    // brings internal json data
	  $squadUrl = "js/squad-data.json";
    $squadResponse = file_get_contents($squadUrl);
    $squadData = json_decode($squadResponse);   
  ?>

  <ons-toolbar>
    <div class="center">Player List <span class="rank-year"> | 2020-2021</span></div>
  </ons-toolbar>

  <ons-list id="squad-list">

    <!-- Display all the players data for each lines -->
    <?php foreach ($squadData->squad as $player)
      {
    ?>
      <ons-list-item class="squad-card">
        <!-- player photo, squad number, and name on the left -->
        <div class="left">
          <img id="playerImg" src="<?php echo $player->img?>">
            <span class="squad" id="playerNumber"><?php echo $player->number?></span>
            <span class="squad" id="playerName"><?php echo $player->name?></span>
        </div>
        <!-- players' nationality on the center -->
        <div class="center">
          <p class="squad" id="playerNation"><?php echo $player->nation?></p>
        </div>
        <!-- player's position on the right -->
        <div class="right rank-right">
          <span class="squad" id="playerPosition"><?php echo $player->position?></span>
        </div>
      </ons-list-item>
    <?php
      }
    ?>

  </ons-list>