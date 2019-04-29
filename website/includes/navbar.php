<?php


if (isset($_SESSION['user']['user_group_id'])) {
    echo "

      <nav class='navbar navbar-expand-lg navbar-light bg-light' onclick='' style='background: rgba(227,234,239,1)  !important;'>
       <button class=\"btn btn-primary\" id='sideBarToggle' onclick='sideBarShow()' type=\"button\">
            <i class=\"material-icons\">menu</i>
           </button>
          <a class='navbar-brand' style='' href='/'><img src='../assets/images/logo.svg' style='color: white; margin: 0 !important; padding: 0!important; width: 8rem; height: auto'class='images' alt='logo'></a>
          <div class='collapse navbar-collapse' id='navbarNavDropdown'>
              <ul class='navbar-nav'>
						
              </ul>
          </div>
      </nav>";
}else{
    echo "

      <nav class='navbar navbar-expand-lg navbar-light bg-light' style='background: rgba(227,234,239,1)  !important;'>
          <a class='navbar-brand' style='' href='/'><img src='../assets/images/logo.svg' style='color: white; margin: 0 !important; padding: 0!important; width: 8rem; height: auto'class='images' alt='logo'></a>
          <div class='collapse navbar-collapse' id='navbarNavDropdown'>
              <ul class='navbar-nav'>
              	<li class=\"nav-item\"><a class=\"nav-link\" href=\"../index.php\">Home</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"\">Contact</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"../login.php\">Log på</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"../register.php\">Register</a></li>
						<li class=\"nav-item\"><a class=\"nav-link\" href=\"https://www.sde.dk/kontakt/kontakt/?\">contact information</a></li>
              </ul>
          </div>
      </nav>
      ";
}
