<?php


if (isset($_SESSION['user'])) {
    echo "

      <nav class='navbar navbar-expand-lg navbar-light bg-light' onclick='' style='background: rgba(227,234,239,1)  !important;'>
          <a class='navbar-brand' style='' href='/'><img src='../assets/images/logo.svg' style='color: white; margin: 0 !important; padding: 0!important; width: 8rem; height: auto'class='images' alt='logo'></a>
             <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                 <span class=\"navbar-toggler-icon\"></span>
            </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
         <ul class=\"navbar-nav mr-auto\">
				<li class=\"nav-item\"><a class=\"nav-link\"  style='position: relative; float: right' href=\"../user/\">"; echo $_SESSION['user']['name'] ; echo "</a></li>
              </ul>
          </div>
      </nav>";
}else{
    echo "

      <nav class='navbar navbar-expand-lg navbar-light bg-light' style='background: rgba(227,234,239,1)  !important;'>
          <a class='navbar-brand' style='' href='/'><img src='../assets/images/logo.svg' style='color: white; margin: 0 !important; padding: 0!important; width: 8rem; height: auto'class='images' alt='logo'></a>
          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
             <span class=\"navbar-toggler-icon\"></span>
          </button>
          <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
            <ul class=\"navbar-nav mr-auto\">
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
