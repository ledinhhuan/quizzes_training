$(function(){$.validator.addMethod("valueNotEquals",function(e,t,r){return r!==e},"Value must not equal arg."),$("#handle-question").validate({rules:{topic_id:{valueNotEquals:""},level:{valueNotEquals:""},content:{required:!0},is_correct:{required:!0}},messages:{topic_id:{valueNotEquals:"Please select an item!"},level:{valueNotEquals:"Please select an item!"},content:{required:"Content must have be required!"},is_correct:{required:"Please select answer!"}},errorElement:"div",errorClass:"text-danger"}),$("#submit").click(function(){let e=$("input[name='answer[]']").map(function(){return $(this).val()}).get(),t=!1;return _.uniq(e).length!==e.length?($("#error").text("Answer must be unique!").addClass("text-danger"),t=!0):$("#error").text("").removeClass("text-danger"),!t&&$("#handle-question").submit()})});