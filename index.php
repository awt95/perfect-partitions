<!DOCTYPE html>
<!-- Created by Alex Turner, 2015 -->
<html>
  <head>
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" type="text/css" href="pp-style.css"/>
    <title>perfectly sized partitions</title>
  </head>
  <body>
    <center>
      <div id="container">
        <h1>Perfect Partitions</h1><br>
        A dead simple calculator to get perfectly round sizes for your partitions<br><br>
        <form method="POST" action="">
          <table class="nostyle">
            <tr>
              <td>
                <input type="text" placeholder="Desired size" name="desiredsize" class="desiredsize"/>
                <select name="unit" class="selectunit">
                  <option>MB</option>
                  <option selected="selected">GB</option>
                  <option>TB</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><center><input type="submit" value="Get Size" name="getsize"/></center></td>
            </tr>
          </table>
        </form>
      </div>
      <div id="output">
      <?php
        // Check if form has been submitted
        if (isset($_POST["getsize"])) {
          // Calls function using size and unit as specified by user
          // echos result
          echo "<p>" . getPerfectSize($_POST["desiredsize"], $_POST["unit"]) ."</p>";
        }
        // Function to output perfect size for a partition
        // given a target size and unit
        // or outputs an error message
        function getPerfectSize($targetsize, $unit) {
          try {
            // Checks if numeric
            if (!is_numeric($targetsize)) {
              throw new Exception("Size given is not numeric");
            } // if
            // Checks that it is not empty
            if ($targetsize < 1) {
              throw new Exception("Size given is not valid");
            } // if
            // Calculate MiB size (Mebibyte)
            switch($unit) {
              case "TB":  $result = $targetsize * 1048576; break;
              case "GB":  $result = $targetsize * 1024;    break;
              // Default is case for MB
              // Rounds up to nearest integer using ceil()
              default:    $result = ceil($targetsize * 1.024);   break;
            } // switch
            // Now compensate for overhead (simply add 1)
            $result++;
            $iserror = false;
          } //try
          catch (Exception $e){
            // Catches any exceptions
            $iserror = true;
            $result = $e->getMessage();
          } // catch
          // Print result in a formatted style
          if ($iserror) {
            echo "<br>Error: $result";
          } else {
            echo "<br>Partition size required is <b>$result MB</b><br>";
            echo "Enter this value into your disk management software so that your partition appears as exactly <b>$targetsize $unit</b>";
          } // else
        } // function getPerfectSize
      ?> 
      </div>
    </center>
    <div id="footer"><a href="about.html">about</a> | created by <a href="http://alex-turner.uk/">Alex Turner</a>, 2015</div>
  </body>
</html>