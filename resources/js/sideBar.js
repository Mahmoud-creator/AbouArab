$(document).ready(function () {
    $(".sidebar-button").click(function () {
        $("#sidebar").slideToggle();
        $("#main-container").toggleClass("hidden");
    })
})
