const path = document.querySelector("path.slide-path");
let length = 0;
let interval;

function startDrawing() {
    length = 150;
    interval = setInterval(increaseLength, 1);
}

const increaseLength = () => {
    const pathLength = path.getTotalLength();
    length += 1;
    if (length >= pathLength) {
        clearInterval(interval);
    }
    path.style.strokeDasharray = `${length} ${pathLength}`;
    path.style.strokeDashoffset = pathLength - length;
};
