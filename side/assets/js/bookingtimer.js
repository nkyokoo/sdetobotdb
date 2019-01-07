
//Booking.php

let timeout;
let idleTimer = 0;

//Check Mouse Activity
window.addEventListener('ready',function () {




$(document).ready(function() {

    try {
        checkIfIdle();
        timeout = setInterval(function(){checkIfIdle();}, 1000); // 1 second = 1000ms

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

    }    catch (e) {

    }

    });
});

//check if you're idle too long.
