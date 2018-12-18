let timeout;
let idleTimer = 0;

//Check Mouse Activity
$(document).ready(function () {
    clearTimeout(timeout);
    timeout = setInterval(function(){checkIfIdle();}, 1000); // 1 minute

    //check if mouse is moving
    document.onmousemove = function(){
        idleTimer = 0;
        let d = document.getElementById("test");

        d.innerHTML = idleTimer;

    };

    //check if you press any key.
    document.onkeypress = function () {
        idleTimer = 0;
        let d = document.getElementById("test");

        d.innerHTML = idleTimer;

        // alert("Get real");
    };
});

//check if you're idle too long.
function checkIfIdle() {
    idleTimer++;
    let d = document.getElementById("test");

    d.innerHTML = idleTimer;

    if (idleTimer > 19){ //20 min
        alert("Timeout!");
        //Go to a Page
    }
}