let timeout;
let idleTimer = 0;
//Check Mouse Activity
$(document).ready(function () {


    timeout = setInterval(checkIfIdle, 1000) ;// 1 second = 1000ms

    //check if mouse is moving
    document.onmousemove = function(){
        idleTimer = 0;
        let x = document.getElementById("test");
        x.innerHTML = idleTimer;
    };

    //check if you press any key.
    document.onkeypress = function () {
        idleTimer = 0;
        let x = document.getElementById("test");
        x.innerHTML = idleTimer;
    };

});


//check if you're idle too long and incrementing.
function checkIfIdle() {
    idleTimer++;
    let x = document.getElementById("test");
    x.innerHTML = idleTimer;
    let idleLimit = 29;
    let idleReloadLimit = 14;
    if (idleTimer > idleReloadLimit){ //Max idle LIMIT
        //Stop the timer
        if (idleTimer > idleLimit){
            clearInterval(timeout);
            //The customer has been idle for too long.

            //Redirect to idle settings

        }else {
            clearInterval(timeout);
            //popup message or Timeout box if any.

            //Reload Page.
            location.reload();
        }

    }
}
