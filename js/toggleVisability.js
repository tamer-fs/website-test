var input_selected = false;

function toggle() {
    var input = document.getElementById("password-toggle");
    var image = document.getElementById("toggle-image");
    if (input.type === "password") {
        input.type = "text";
        image.src = "../assets/images/visibility_off.png"
    } else {
        input.type = "password";
        image.src = "../assets/images/visibility_on.png"
    }
}

