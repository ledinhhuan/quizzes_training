$(function () {
    //save checked radio into localstorage if user refresh page
    let radioGroups = JSON.parse(localStorage.getItem('selected') || '{}');
    Object.keys(radioGroups).map(function (radionId) {
        $('#' + radioGroups[radionId]).attr('checked', true);
    });

    $('.form-check-input').on('click', function(){
        radioGroups[this.name] = this.id;
        localStorage.setItem("selected", JSON.stringify(radioGroups));
    });

    //submit quizz and remove localstorage
    $("#submitQuiz").click(function(){
        if (confirm("Do you want to submit this ?")) {
            localStorage.removeItem('selected');
        } else {
            return false;
        }
    });
});
