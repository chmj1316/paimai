
window.addEventListener("popstate", function () {
    $("div.IMG").lazyload({
        effect: "fadeIn"
    });
});
