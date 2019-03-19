<?php


  function isLoggedIn()
  {
  	if (isset($_SESSION['user'])) {
      return true;
      echo "
      <nav class='navbar navbar-expand-lg navbar-light bg-light'>
          <a class='navbar-brand' style='' href='/'><img src='./assets/img/header_logo.png' type='png' class='images'></a>
          <div class='collapse navbar-collapse' id='navbarNavDropdown'>
              <ul class='navbar-nav'>
              </ul>
          </div>
      </nav>";
  	}else{
  		return false;
      echo "
      <nav class='navbar navbar-expand-lg navbar-light bg-light'>
          <a class='navbar-brand' style='' href='/'><img src='./assets/img/header_logo.png' type='png' class='images'></a>
          <div class='collapse navbar-collapse' id='navbarNavDropdown'>
              <ul class='navbar-nav'>
              </ul>
          </div>
      </nav>";
  	}
  }
