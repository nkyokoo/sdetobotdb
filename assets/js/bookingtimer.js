let timeout;
let idleTimer = 0;
//Check Mouse Activity
$(document).ready(function () {


    try {
        //Doing certain Events every 1000ms
        timeout = setInterval(checkIfIdle, 60000);// 1 second = 1000ms

        //check if mouse is moving
        document.onmousemove = function () {
            idleTimer = 0;
            //test
            let x = document.getElementById("test");
            x.innerHTML = idleTimer;
        };

        //check if you press any key.
        document.onkeypress = function () {
            idleTimer = 0;
            //test
            let x = document.getElementById("test");
            x.innerHTML = idleTimer;
        };
    } catch (e) {
    }

});


//check if you're idle too long and incrementing.
function checkIfIdle() {
    try {
        idleTimer++;
        let x = document.getElementById("test");
        x.innerHTML = idleTimer;
        let idleLimit = 14;
        if (idleTimer > idleLimit) { //Reaching the booking idle limit, reload page

            //Stop the timer
            clearInterval(timeout);
            //popup message or Timeout box if any if clicked Reload Page.

            //Reload Page.
            location.reload();


        }
    } catch (e) {
    }
}





