
<?php
echo"
      <link rel='stylesheet' href='../assets/css/login.css' type='text/css'>
<div class='bar-login'>
        <p class='lead'>
        Dette låne system er lavet af <a href='https://itd.sde.dk' target='_blank'><strong>IT & DATA SKP</strong></a>. Alle rettigheder forbeholdes til
        <a href='https://itd.sde.dk' target='_blank'><strong>IT & DATA SKP</strong></a>
        ikoner er brugt i hensigt til <strong>CREATIVE COMMON</strong> som kan ses <a href='licenser.php' target='_blank' aria-details='' >her</a>
    </p>
</div>      
 <div class='login-shadow'>
    <div class='container'>
 
        <div class='row'>
            <div class='col col-sm-4'>

            </div>
            <div class='col col-sm-4'>


            </div>
            <div class='col col-sm-4'>

            </div>
        </div>
        <div class='row'>
            <div class='col'></div>
            <div class='col'>
                <div class='container'>
                    <div id='loginForm' class='Login-Form'>
                   <h1 id='title2'>Lånesystem</h1>
                        <form action='includes/connectlogin.php' method='post'>
                        <div class='form-group'>
                            <label for='InputUserLogin'>Brugernavn</label>
                            <input type='text' class='form-control' id='InputUserLogin' placeholder='Din brugernavn' name='username' required>
                     
                        </div>
                        <div class='form-group'>
                            <label for='InputPasswordLogin'>Adgangskode</label>
                            <input type='password' class='form-control' id='InputPasswordLogin'  placeholder='•••••••••' name='password' required>
                        </div>
                        <div class='form-group form-check'>
                            <input type='checkbox' class='form-check-input' id='rememberme1'>
                            <label class='form-check-label' for='rememberme1'>Remember me</label>
                        </div>
                        <button type='submit' id='login-button'  class='btn btn-raised btn-danger'>Login</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class='col'></div>
            <div class='col'></div>
            <div class='col'></div>
        </div>
        <div class='row'>
            <div class='col col-sm-4'>

            </div>
            <div class='col ol-sm-4'>

            </div>
            <div class='col col-sm-4'>

            </div>
        </div>
        </div>
    </div>
    
    ";

?>
