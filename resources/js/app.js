import "./bootstrap";
import "./welcome/animate-svg.js";
import "./welcome/swiper.js";

import "../scss/app.scss";

const input = document.querySelector("input[name='course-date']");

input.addEventListener("change", (e) => {
    console.log(input.value);
    console.log(input);
});
