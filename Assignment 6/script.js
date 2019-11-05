$.ajax({
    method: "GET",
    url: "https://api.weatherbit.io/v2.0/current?city=Los+Angeles,CA",
    data: {
        key: "213ceda9832a4e7ba027ff814e193bc0",
        units: "I"
    }
})

.done(function(results) {
    console.log(results);
    $("#weather").html("Today's weather in Los Angeles: "
    + results.data[0].temp + "° "
    + results.data[0].weather.description + ". Feels like "
    + results.data[0].app_temp+ "° ");
})

.fail(function() {
    console.log("ERROR");
})

$("#task-form").on("submit", function(event) {
    event.preventDefault();
    let userInput = $("#input").val().trim();
    if(userInput.length > 0){
        $("#task-list").append("<li class='tasks'><i class='far fa-square'></i>      " + userInput + "</li>");
    }
});

$("#task-list").on("click", ".tasks", function() {
    $(this).toggleClass("line");
});

$("#task-list").on("click", ".fa-square", function(event) {
    event.stopPropagation();
    $(this).parent().fadeOut(function() {
        $(this).remove();
    });
});

$("#plus-sign").on("click", function() {
    $("#task-form").slideToggle();
});