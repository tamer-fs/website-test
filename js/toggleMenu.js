function toggle_menu() {
    menu = document.getElementById("side-menu");
    if (menu.style.left === "-200vw") {
        menu.style.left = "0px";
    } else {
        menu.style.left = "-200vw";
    }
}