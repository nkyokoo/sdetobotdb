let source = new EventSource("../backend_instantiate/int_cartevent.php");
source.onmessage = function(event) {
    document.getElementById("cartItemCount").innerHTML += event.data;
};