//Chainage de const ,;
/** speudo element <span></span>*/
const body = document.querySelector("body"),
    sidebar = body.querySelector("nav"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

/**
 * EVENTS (Manipulation de DOM) - sur les classNames
 * 3 Actions ()
 */

//1- OnClick chevron sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

//2-  OnClick sur .search-box vas enlever .close dans nav donc <nav>
searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
});

//3- OnClick Pointer du switch
modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    // Mofification de texte.
    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";
    }
});