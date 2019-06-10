<!DOCTYPE html>
<html>
  <head>
    <title>Mastermind Game</title>
  </head>

  <body>

    <h1>Mastermind Game</h1>
       <p>Rules of the game: one player selects a 5 digit secret code, with the condition that all digits are different. The other player attempts to guess it, in as few tries as possible. Every time a guess is made, feedback is given, counting the number of exact matches and inexact matches. 
      <br><br> 
      Example:<br>
      Secret code is: 54218<br>
      Guess code is:  84653<br>
      Exact matches: 1 (number 4). Inexact matches: 2 (numbers 5 and 8).<br><br>
      Let's play with the computer!<br><br>
      </p>

    <?php
       // define variables and set to empty values
       $arg1 = $output = $retc = "";
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $arg1 = test_input($_POST["arg1"]);
         exec("/usr/lib/cgi-bin/computer_mastermind " . $arg1, $output, $retc); 
       }
       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Please enter your secret code: <input type="text" name="arg1"><br>
      <br>
      <input type="submit" value="Go!">
    </form>

    <?php
       // only display if return code is numeric - i.e. exec has been called
       if (is_numeric($retc)) {
         echo "<h2>You entered the following input:</h2>";
         echo $arg1;
         echo "<br>";
       
         echo "<h2>Mastermind output:</h2>";
         foreach ($output as $line) {
           echo $line;
           echo "<br>";
         }
       
         echo "<h2>Mastermind return code:</h2>";
         echo $retc;
       }
    ?>
    
  </body>
</html>
