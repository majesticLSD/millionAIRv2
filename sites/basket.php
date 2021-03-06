<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document implements the function to log in to the website		                                        -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang='en'>
<?php
  session_start();
?>
<?php
  if (empty($_SESSION['basketID'])) {                                       // if user has no basket take him to empy basket page
    header ('location:/millionAIR/sites/empty_basket.php');
  }
?>
  <head>
      <meta charset='utf-8'>
      <meta name='theme-color' content='#171819'>
      <title>millionAIR</title>
      <link id='favicon' rel='icon' type='' href=''/>
      <!-- This website includes -->
      <!-- External -->
      <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <!-- Internal -->
      <link href='../css/general.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/font.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/form.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/article.css' media='screen' rel='stylesheet' type='text/css'/>
      <script type='text/javascript' src='/millionAIR/js/menu.js'></script>
      <!-- End websites includes -->
  </head>
  <body>
    <div id='titleBar'>
      <div id='title_menu_button' onclick='toggleMenu()'>
        <i class="fas fa-caret-right button_menu"></i>
      </div>
      <div id='title_categories' class='hide'>
        <form class="title-categories" action="/millionAIR/index.php?category=Mods" method="post">
          <input class='button button_title' type="submit" name="Mods" value="Mods">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Atomizers" method="post">
          <input class='button button_title' type="submit" name="Atomizers" value="Atomizers">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Juice" method="post">
          <input class='button button_title' type="submit" name="Juice" value="Juice">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Aroma" method="post">
          <input class='button button_title' type="submit" name="Aroma" value="Aroma">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=DIY" method="post">
          <input class='button button_title' type="submit" name="DIY" value="DIY">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=All" method="post">
          <input class='button button_title' type="submit" name="all" value="All">
        </form>
      </div>
      <span class='font_title'><a href='/millionAIR/index.php'>millionAIR</a></span>
      <div id='title_profile'>
          <!-- Logout / Register Template -->
          <?php
            if (empty($_SESSION['userID'])) {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/login.php' method='post'>
                        <input class='button button_title' type='submit' name='login' value='Login'>
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/register.php' method='post'>
                        <input class='button button_title' type='submit' name='register' value='Register'>
                      </form>";
            } else {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/logout.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Logout'>
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/profile.php' method='post'>
                        <input class='button button_title' type='submit' name='profile' value='Profile'>
                      </form>";
            }
          ?>
          <form class="title_profile_align" action="/millionAIR/sites/basket.php" method="post">
            <input class='button button_title' type="submit" name="basket" value="Basket">
          </form>
          <?php
            if (!empty($_SESSION['admin']) && $_SESSION['admin']) {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/admin.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Admin'>
                      </form>";
            }
          ?>
      </div>
    </div>
    <div class='spacer_top'></div>
    <div id='content'>
      <table id='basket' border="0">
        <tr>
          <th>Article</th>
          <th id='left_column'>Quantity</th>
          <th id='left_column'>Price per Unit</th>
          <th id='left_column'>Price for quantity</th>
        </tr>
        <?php
          $mysqli = new mysqli("localhost", "root","", "millionAIR");           //connect to database
    			if($mysqli->connect_error) {
    				echo ("Fehler ". mysqli_connect_error());
    				exit();
    			}
          $basket = $mysqli->query("SELECT i.item, i.price, i.itemID, p.quantity FROM position p JOIN item i ON p.itemID = i.itemID WHERE p.basketID={$_SESSION['basketID']}");
          $sum = 0;                                                             // select all items from the current basket and initialize a sum
          while ($item = $basket->fetch_array()) {                              // iterate over every item and show it with its price and quantity.
            $itemID = $item['itemID'];
            $priceforquant = $item['quantity'] * $item['price'];
            $quant = $item['quantity'];
            echo "<tr><td>" . $item['item'] . "</td><td id='left_column'>" . $item['quantity'] . "</td><td id='left_column'>"
            . number_format($item['price'],2) . " €</td><td id='left_column'>" . number_format($priceforquant,2) . " €</td>
            <td id='left_column'><form action='/millionAIR/sites/removeitem.php' method='post'>
            <input class='' type='hidden' name='itemID' value='$itemID'>
            <input class='' type='hidden' name='quant' value='$quant'>
            <input class='button button_article button_remove' type='submit' name='submit' value='Remove'></form></td></tr>";
            $sum += $priceforquant;
          }
          echo "<tr><th>ALLTOGETHER</th><th></th><th></th><th id='left_column'>" . number_format($sum,2) . " €</th></tr>";  // show the sum for the price items in the basket
        ?>
        <form class="" action="pay.php" method="post">
          <input type="hidden" name="sum" value='<?php echo $sum; ?>'>
          <input class="button button_title" type="submit" name="" value="Pay">
        </form>
      </table>
    </div>
  </body>
</html>
