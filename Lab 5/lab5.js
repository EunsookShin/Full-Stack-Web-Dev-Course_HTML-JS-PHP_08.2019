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