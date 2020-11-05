<!--
  Created by Tutorialwork
  https://YouTube.com/Tutorialwork
  © 2019 - BetaSystem
-->
<?php
//Get browser language
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//German: de ch at
//Chinese: zh
if($lang == "de" || $lang == "ch" || $lang == "at"){
  require("languages/lang_de.php");
} else if($lang == "zh"){
  require("languages/lang_cn.php");
} else {
  require("languages/lang_en.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_TITLE; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="animated rubberBand">
        <noscript>
          <p class="error"><?php echo NOJS; ?></p>
        </noscript>
        <?php
        require("mysql.php");
        if(isset($_POST["submit"])){
          $stmt = $mysql->prepare("SELECT * FROM beta WHERE BETAKEY = :key");
          $stmt->bindParam(":key", $_POST["key"], PDO::PARAM_STR);
          $stmt->execute();
          $data = 0;
          while($row = $stmt->fetch()){
            $data++;
          }
          if($data == 1){
            $stmt = $mysql->prepare("SELECT * FROM beta WHERE BETAKEY = :key");
            $stmt->bindParam(":key", $_POST["key"], PDO::PARAM_STR);
            $stmt->execute();
            while($row = $stmt->fetch()){
              if($row["UUID"] == "null"){
                if($cracked){
                  $uuid = htmlspecialchars($_POST["spieler"]);
                } else {
                  require("MinecraftUUID.php");
                  $profile = ProfileUtils::getProfile($_POST["spieler"]);
                  if ($profile != null) {
                    $result = $profile->getProfileAsArray();
                    $uuid = ProfileUtils::formatUUID($result['uuid']);
                  }
                }
                $stmt = $mysql->prepare("SELECT * FROM beta WHERE UUID = :uuid");
                $stmt->bindParam(":uuid", $uuid, PDO::PARAM_STR);
                $stmt->execute();
                $data = 0;
                while($row = $stmt->fetch()){
                  $data++;
                }
                if($data == 0){
                  $stmt = $mysql->prepare("UPDATE beta SET UUID = :uuid WHERE BETAKEY = :key");
                  $stmt->bindParam(":uuid", $uuid, PDO::PARAM_STR);
                  $stmt->bindParam(":key", $_POST["key"], PDO::PARAM_STR);
                  $stmt->execute();
                  ?>
                  <script type="text/javascript">
                  swal("<?php echo SUCCESS_STATUS; ?>", "<?php echo SUCCESS; ?>", "success");
                  </script>
                  <?php
                } else {
                  ?>
                  <script type="text/javascript">
                  swal("<?php echo ERROR_STATUS; ?>", "<?php echo PLAYER_ALREADY_REDEEMED; ?>", "error");
                  </script>
                  <?php
                }
              } else {
                ?>
                <script type="text/javascript">
                swal("<?php echo ERROR_STATUS; ?>", "<?php echo KEY_ALREADY_REDEEMED; ?>", "error");
                </script>
                <?php
              }
            }
          } else {
            ?>
            <script type="text/javascript">
            swal("<?php echo ERROR_STATUS; ?>", "<?php echo KEY_INVALID; ?>", "error");
            </script>
            <?php
          }
        }
         ?>
        <h1><?php echo SITE_HEADING; ?></h1>
        <p><?php echo SITE_TEXT; ?></p>
        <form action="index.php" method="post">
          <input type="text" name="spieler" placeholder="<?php echo INPUT_PLAYER; ?>" minlength=3 required><br>
          <input type="text" name="key" placeholder="<?php echo INPUT_KEY; ?>" minlength=5 required><br>
          <button type="submit" name="submit" class="btn"><?php echo INPUT_BUTTON; ?></button>
        </form>
      </div>
    </div>
  </body>
</html>
