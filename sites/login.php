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
        <link href='/millionAIR/css/general.css' media='screen' rel='stylesheet' type='text/css'/>
        <link href='/millionAIR/css/font.css' media='screen' rel='stylesheet' type='text/css'/>
        <link href='/millionAIR/css/form.css' media='screen' rel='stylesheet' type='text/css'/>
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
          <form class='title_profile_align' action='/millionAIR/sites/basket.php' method='post'>
            <input class='button button_title' type='submit' name='basket' value='Basket'>
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
      </div>
        <div class='spacer_top'></div>
        <div id='content'>
          <div class='login_form'>
            <?php
              if (empty($_SESSION['userID'])) {                                 // if user is not loggin in give him a form to log in
                echo "  <form action='/millionAIR/sites/login_entry.php' method='post'>
                          Please insert your login credentials:
                          <input type='text' name='username' placeholder='Name' autocomplete='off' autofocus>
                          <input type='password' name='password' placeholder='Password' autocomplete='off'>
                          <input type='submit' class='button' value='login'>
                        </form>";
              } else {                                                          // if user is logged in tell him
                echo "  <form action='/millionAIR/index.php' method='post'>
                          You are already logged in!
                          <input type='submit' class='button' value='continue shopping'>
                        </form>";
              }
            ?>
          </div>
        </div>
    </body>
</html>
