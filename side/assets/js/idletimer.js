
let timeout;
let idleTimer = 0;
//Check Mouse Activity
$(document).ready(function () {


    timeout = setInterval(checkIfIdle, 1000) ;// 1 second = 1000ms

    //check if mouse is moving
    document.onmousemove = function(){
        idleTimer = 0;

    };

    //check if you press any key.
    document.onkeypress = function () {
        idleTimer = 0;

    };

});


//check if you're idle too long and incrementing.
function checkIfIdle() {
    idleTimer++;
    let idleLimit = 29;
    if (idleTimer > idleLimit){ //Max idle LIMIT
        //Stop the timer

        clearInterval(timeout);
        //popup message or Timeout box if any.

        //Reload Page.
        location.reload();


    }
}
