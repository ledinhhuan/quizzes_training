$(function(){let e=$('input[name="answer[]"]').length;$("#add-field").click(function(a){a.preventDefault(),e<4&&(e++,$(".answer-field").append('<div class="row"><div class="col-sm-1"><div class="radio" style="margin-top: 17px;"><label><input type="radio" name="is_correct" value="'+e+'"><input type="hidden" value="" name="id[]"/><span class="circle"></span><span class="check"></span></label></div></div><div class="col-sm-9"><div class="form-group label-floating is-empty"><label class="control-label"></label><input class="form-control check-answer" type="text" name="answer[]" required><span class="material-input"></span></div></div><div class="col-sm-2"><button class="btn btn-danger btn-round btn-fab btn-fab-mini remove_field"><i class="material-icons">remove</i></button></div></div>'))}),$(".answer-field").on("click",".remove_field",function(a){a.preventDefault(),console.log("a"),$(this).parent().parent().remove(),e--}),$(".check-answer").each(function(){$(this).rules("add",{required:!0,messages:{required:"Answer must be required!"}})})});