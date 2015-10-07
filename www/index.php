<?php
  include_once('constant.php');
?>
<!DOCTYPE HTML5>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Destiny Light Calculator</title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL;?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SCSS Styles -->
    <link href="<?php echo BASE_URL;?>css/styles.css" rel="stylesheet">

  </head>
  <body>
      <header class="container">
        <h1 class="titleText">Destiny Light Level Journal V1.0</h1>
        <h4>(Doesn't support older IE)</h4>
      </header>
      <div class="pageContainer container">

        <div class="LoginWrapper">
          <!--//////////////////////////////////////////////////////////////
          Login form used to GET bungie account data to GET inventory stats
          ///////////////////////////////////////////////////////////////-->
          <form id="destinyLogin" class="col-md-12" action="login.php" method="post">
            <fieldset>
              <h2>Destiny Login</h2>
              <div class="selectPlatform col-md-2">
                <label class="formLabel col-md-12" for="platform">Account Platform:</label>
                <select name="platform" class="form-control col-md-3" required>
                  <option value=""></option>
                  <option selected="selected" value="2">Playstation</option>
                  <option value="1">Xbox</option>
                </select>
              </div>
              <div class="input-gamertag col-md-6">
                <label class="formLabel col-md-6" for="gamertag">Gamertag</label>
                <input class="form-control" type="text" name="gamertag" value="SNIPEOUTdaLIGHTS" placeholder="Gamertag" required>
              </div>
              <input class="loginSubmit btn" type="submit" value="Submit">
            </fieldset>
          </form>

          <div id="charWrapper">
            <div id="gamerTag" class="col-md-12">
              <span id="platformIcon"></span>
              <span id="gamerTagName"></span>
            </div>

          </div>
        </div>

        <form id="destinyLevel" class="col-md-12" action="action.php" method="post">
          <div class="errorText alert alert-danger" role="alert"></div>
          <div class="charText alert alert-danger" role="alert"></div>
          <div class="numText alert alert-danger" role="alert"></div>
          <div class="negText alert alert-danger" role="alert"></div>
          
          <fieldset class="col-md-6">

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="primary">Primary Weapon</label>
                <input class="weaponInput form-control" type="text" name="primary" placeholder="999" maxlength="3" required>
                <div class="itemName"></div>
                <div class="itemIcon"></div>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="special">Special Weapon</label>
                <input class="weaponInput form-control" type="text" name="special" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="heavy">Heavy Weapon</label>
                <input class="weaponInput form-control" type="text" name="heavy" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="ghost">Ghost (Level 40)</label>
                <input class="ghostInput form-control" type="text" name="ghost" placeholder="999" maxlength="3" required>
              </div>
            </div>

          </fieldset>

          <fieldset class="col-md-6">

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="helmet">Helmet</label>
                <input class="armourInput form-control" type="text" name="helmet" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="gauntlets">Gauntlets</label>
                <input class="armourInput form-control" type="text" name="gauntlets" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="chest">Chest</label>
                <input class="armourInput form-control" type="text" name="chest" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="legs">Legs</label>
                <input class="armourInput form-control" type="text" name="legs" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="classItem">Class Item</label>
                <input class="armourInput form-control" type="text" name="classItem" placeholder="999" maxlength="3" required>
              </div>
            </div>

            <div class="form-group col-md-12">
              <div class="input-primary col-md-6">
                <label class="formLabel col-md-12" for="artifact">Artifact</label>
                <input class="armourInput form-control" type="text" name="artifact" placeholder="999" maxlength="3" required>
              </div>
            </div>

          <div class="form-group col-md-12">
            <input class="formSubmit btn" type="submit" value="Submit">
            <input class="formClear btn" type="button" value="clear">
          </div>

          </fieldset>

        </form>
      </div>

    <div id="outputLevel">
      <div class="centered">
        <span class="lightLevelText"><h3>Your light level is: </h3></span>
          <span class="lightIcon"><img src="images/light.png" alt="light"></span>
            <span id="lightLevelValue"><h3></h3></span>
      </div>
    </div>

  </body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="<?php echo BASE_URL;?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL;?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/script.js"></script>
</html>
