function getData(){
    $.ajax({
        type: 'post',
        url: 'getDetails.php',
        data: { portfolio: "chosenPortfolio"},
        success: function(data) {
            if (data >= 14) {
                // status(chosenPortfolio, "DONE");
                alert("DONE");
                // resultsView();
            } else {

            }
        }
    });
}