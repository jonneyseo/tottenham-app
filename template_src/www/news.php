
  <!-- The API where the data comes from and read them into a string as a PHP variable -->
  <?php
    $newsUrl = 'http://newsapi.org/v2/everything?q=tottenham&from=2020-11-14&language=en&sortBy=publishedAt&apiKey=0d350849496f4280ba1145680e369cd7';
    $newsResponse = file_get_contents($newsUrl);
    $newsData = json_decode($newsResponse);    
  ?>

    <!-- Extract the values from article parameter and set them as a variable -->
    <?php
      // while there is a news, display them in ons-card template as below
      foreach($newsData->articles as $news)
      {
    ?>
      <ons-card>
        <!-- thumbnail -->
        <img src="<?php echo $news->urlToImage?>" alt="News thumbnail" style="width: 100%">
        <div class="title">
          <!-- news title and source media -->
          <h6 class="news_source"> <?php echo $news->source->name ?> </h6>
          <h2> <?php echo $news->title ?></h2>
        </div>
        <div class="content">
          <!-- news description (excerpt) -->
          <p><?php echo $news->description ?> 
            <span id="read-more">
              <!-- this link will allow users to go to original site. -->
              <!-- I was trying to display them as a new stack navigation, but failed -->
              <a href="<?php echo $news->url ?>" target="_blank">Read more..</a>
            </span>
          </p>
          <!-- date published with year, month, day, but substrating time -->
          <p class="publish-date"> <?php echo substr($news->publishedAt, 0, -10) ?> </p>
        </div>
      </ons-card>
    <?php
      }
    ?>

    <!-- Skeleton prototype -->
      <!-- <ons-card>
        <img src="img/news1.jpg" style="width: 100%">
        <div class="title">
          <strong>Upcoming match - West Ham</strong>
        </div>
        <div class="content">
          The Premier League is back after a two-week international break and what a game to get back underway with – a
          London derby against West Ham at Tottenham Hotspur Stadium! <span class="read-more"> Read more..</span>
        </div>
      </ons-card>
      <ons-card>
        <img src="img/news2.jpg" style="width: 100%">
        <div class="title">
          <strong>Bale is back!</strong>
        </div>
        <div class="content">
          Gareth Bale has told Jose Mourinho that he is a far more complete player these days. <span class="read-more">
            Read more..</span>
        </div>
        </div>
      </ons-card>
      <ons-card>
        <img src="img/news3.jpg" style="width: 100%">
        <div class="title">
          <strong>Jose's five-point preview</strong>
        </div>
        <div class="content">
          Jose: “In relation to everyone coming back well, no. Dier didn’t come back well, and, probably, will not be in
          the squad for Sunday. <span class="read-more"> Read more..</span>
        </div>
        </div>
      </ons-card> -->


