<?php
    // Get the current page's filename
    $current_page = basename($_SERVER['PHP_SELF']);
    
    // Determine the active link based on the current page
    $home_class = ($current_page == 'index.php') ? 'active' : '';
    $login_class = ($current_page == 'week8_login.php') ? 'active' : '';

    echo '<header><nav>
            <a href="index.php" class="' . $home_class . '">Home</a> | 
            <a href="week8_login_index.php" class="' . $login_class . '">Login</a>
          </nav></header>';
?>
