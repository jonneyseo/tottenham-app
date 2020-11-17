
  <!-- The API where the data comes from and read them into a string as a PHP variable -->
  <?php 
    // api from gootystats (https://footystats.org/api/) and limited usage is allowed for free with the key=example
	$leagueTable = file_get_contents("https://api.footystats.org/league-tables?key=example&season_id=4759");
	$leagueTable = json_decode($leagueTable, true);
	$leagueTable = $leagueTable['data']['league_table'];
  ?>

    <ons-toolbar>
        <div class="center">Season Table <span class="rank-year"> | 2020-2021</span></div>
    </ons-toolbar>

    <ons-list>
        <!-- table header -->
        <ons-list-item class="rank">
            <div class="left">
                Rank
            </div>
            <div class="center">
                Team
            </div>
            <div class="right rank-right">
                Points&nbsp&nbsp&nbspW&nbsp&nbspD&nbsp&nbspL&nbsp 
            </div>
        </ons-list-item>
    
        <!-- Display all the team rank data for each lines -->
        <?php foreach ($leagueTable as $key => $team): ?>
        <ons-list-item class="rank">
            <!-- position(rank) on the left -->
            <div class="left rank-left">
                <?php echo $team['position'] ?>
            </div>
            <!-- team logo and name in the center -->
            <div class="center">
                <img class="team-logo" src="img/logo/<?php echo $team['id']?>.png">&nbsp&nbsp<?php echo $team['cleanName'] ?>
            </div>
            <!-- stats (points, W-D-L on the right) -->
            <div class="right rank-right">
                <?php echo $team['points'] ?>&nbsp&nbsp&nbsp&nbsp
                <?php echo $team['seasonWins_home']+$team['seasonWins_away'] ?>&nbsp&nbsp
                <?php echo $team['seasonDraws_home']+$team['seasonDraws_away'] ?>&nbsp&nbsp
                <?php echo $team['seasonLosses_home']+$team['seasonLosses_away'] ?>&nbsp 
            </div>
        </ons-list-item>
        <?php endforeach ?>

</ons-list>