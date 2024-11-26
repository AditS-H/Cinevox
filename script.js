let cover_block = document.getElementById("cover-block");
let body = document.getElementsByTagName("body")[0];

setTimeout(() => {
    cover_block.style.display = "none";
    body.style.overflowY = "auto";
}, 2900);


AOS.init();