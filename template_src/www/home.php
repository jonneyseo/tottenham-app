<?php ?>

<!DOCTYPE html>
<html>

<head>
  <meta name="format-detection" content="telephone=no">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">

  <link rel="stylesheet" href="./lib/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="./lib/onsenui/css/onsen-css-components.css">
  <script src="./lib/onsenui/js/onsenui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

  <ons-page>
    <!-- Toolbar works as header that sticks to the top of every views and holds home button -->
    <ons-toolbar>
      <div class="center">News</div>
      <div class="right">
        <ons-toolbar-button id="home-button">
          <ons-icon icon="md-home"></ons-icon>
        </ons-toolbar-button>
      </div>
    </ons-toolbar>

    <!-- I used a tabber to navigate between pages -->
    <ons-tabbar swipeable position="auto">
      <ons-tab page="tab1.html" label="News" icon="fa-newspaper" active>
      </ons-tab>
      <ons-tab page="tab2.html" label="Rank" icon="fa-list-ol">
      </ons-tab>
      <ons-tab page="tab3.html" label="Squad" icon="fa-users">
      </ons-tab>
      <ons-tab page="tab4.html" label="Setting" icon="md-settings">
      </ons-tab>
    </ons-tabbar>
  </ons-page>


  <!-- -------------------------------------------------------------------- -->
  <!-- tab1 is news section that pulls latest news of tottenham F.C via google news api -->
  <template id="tab1.html">
    <ons-page id="tab1">

      <!-- This area is where the hook message is hidden-->
      <ons-pull-hook id="pull-hook">
        Pull to refresh
      </ons-pull-hook>

      <!-- news.php has all info to display news -->
      <?php 
        include_once('news.php');
      ?>

    </ons-page>
  </template>


  <!-- -------------------------------------------------------------------- -->
  <!-- tab2 is about the real-time league ranking table where the data comes from footystats -->
  <template id="tab2.html">
    <ons-page id="tab2">

      <!-- rank.php has all info to display table -->
      <?php 
        include_once('rank.php');
       ?>

    </ons-page>
  </template>


  <!-- -------------------------------------------------------------------- -->
  <!-- tab3 includes squad data (players) stored within the folder as json format -->
  <template id="tab3.html">
    <ons-page id="tab3">

      <!-- squad.php has all info to display player data -->
      <?php 
        include_once('squad.php');
      ?>

    </ons-page>
  </template>


  <!-- -------------------------------------------------------------------- -->
  <!-- tab4 is originally intended to adjust user's setting but it's just a mock up for this assignment  -->
  <template id="tab4.html">
    <ons-page id="tab4">

      <ons-list>
        <ons-list-header>Personal Details</ons-list-header>
        <ons-list-item>
          <div class="left">
            <img class="list-item__thumbnail" src="img/profile.jpg">
          </div>
          <div class="center">
            <span class="list-item__title">John Seo</span><span class="list-item__subtitle">john.seo@gmail.com</span>
          </div>
        </ons-list-item>
        <ons-list-item>
          <div class="left">
            <ons-icon icon="fa-key" class="list-item__icon"></ons-icon>
          </div>
          <div class="center">
            Change password
          </div>
        </ons-list-item>

        <ons-list-header>Connected Accounts</ons-list-header>
        <ons-list-item>
          <div class="left">
            <ons-icon icon="fa-twitter" class="list-item__icon"></ons-icon>
          </div>
          <div class="center">
            Twitter
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>
        <ons-list-item>
          <div class="left">
            <ons-icon icon="fa-instagram" class="list-item__icon"></ons-icon>
          </div>
          <div class="center">
            Instagram
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>
        <ons-list-item>
          <div class="left">
            <ons-icon icon="fa-facebook" class="list-item__icon"></ons-icon>
          </div>
          <div class="center">
            Facebook
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>

        <ons-list-header>Push Notification</ons-list-header>
        <ons-list-item>
          <div class="center">
            News
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>
        <ons-list-item>
          <div class="center">
            Game Review
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>
        <ons-list-item>
          <div class="center">
            New Message
          </div>
          <div class="right">
            <ons-switch></ons-switch>
          </div>
        </ons-list-item>

    </ons-page>
  </template>


  <script type="text/javascript" src="cordova.js"></script>
  <script type="text/javascript" src="js/index.js"></script>

  <script>
    // pull-hook function for news section updates
    ons.ready(function () {
      var pullHook = document.getElementById('pull-hook');

      // present three different messages(or icon) for each state
      pullHook.addEventListener('changestate', function (event) {
        var message = '';

        switch (event.state) {
          case 'initial':
            message = 'Pull to refresh';
            break;
          case 'preaction':
            message = 'Release';
            break;
          case 'action':
            message = '<div class="pull-spinner"><ons-icon icon="md-spinner" class="pull-spinner-icon" spin></ons-icon></div>';
            break;
        }

        //write the messages into the hook
        pullHook.innerHTML = message;

      });
      // this just simulates like the data is loading, for 1 second
      pullHook.onAction = function (done) {
        setTimeout(done, 1000);

        // And the toast message falls from the top, for 2 seconds
        ons.notification.toast('You are up-to-date!', { timeout: 2000, animation: 'fall' });
      };
    });

    // this enables to click home button and go back to the main index page 
    document.querySelector('#home-button').onclick = function () {
      window.location = './index.html';
    };    

    // lables of toolbar change in conjunction with tabber lables 
    document.addEventListener('prechange', function (event) {
      document.querySelector('ons-toolbar .center')
        .innerHTML = event.tabItem.getAttribute('label');
    });

  </script>
</body>

</html>