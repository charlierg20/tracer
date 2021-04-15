<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

    <title>CRGMG</title>
  </head>
  <body>
    <?php
      if (!isset($_GET['ip'])) {
        header('Location: index.php?ip='.$_SERVER['REMOTE_ADDR']);
      }
      $ip = $_GET['ip'];//$_SERVER['REMOTE_ADDR'];
      $failed = false;
      if ($rawfile = @file_get_contents("http://ipinfo.io/{$ip}/json")) {
        $ipstat = json_decode($rawfile);
      }
      else {
        $failed = true;
      }
    ?>
    <div class="container bg-dark">
      <h1 style="font-size:60pt;margin-bottom:-5px;">TRACER</h1>
      <p class="bottomtext" style="font-size: 16pt">Trace any IP. No ads, no trackers, just a simple IP tracer.</p>
        <div class="row">
          <div class="col-sm" style="text-align: right;">
            <form action="setloc.php" method="post">
              <input type="text" class="form-control inputip" placeholder="IP Address" name="ip">
              <input type="submit" class="btn btn-primary inputbtn" name="ip-submit">
            </form><br>
          </div>
          <div class="col-sm" style="text-align: left;">
            <?php
              if ($failed == false && isset($ipstat->hostname)) {
                echo "IP: {$ipstat->ip}<br>
                Hostname: {$ipstat->hostname}<br>
                City: {$ipstat->city}<br>
                Region: {$ipstat->region}<br>
                Country: {$ipstat->country}<br>
                Coordinates: {$ipstat->loc}<br>
                Organisation/ISP: {$ipstat->org}<br>
                Postal Code: {$ipstat->postal}<br>
                Timezone : {$ipstat->timezone}<br>";
              }
              else {
                echo "There was an error fetching your request. Your IP may be invalid.";
              }
            ?>
          </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>