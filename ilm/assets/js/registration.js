$(document).ready(function () {
    $("#studentinfoadd").on('click', function(){
        $('#advancedetail').toggle();
        $('#studentinfohide').toggle();
        $('#studentinfoadd').toggle();
    });
    $("#studentinfohide").on('click', function(){
        $('#advancedetail').toggle();
        $('#studentinfohide').toggle();
        $('#studentinfoadd').toggle();
    });
    $("#addpmadress").on('click', function(){
        $('#stdpermanentadress').toggle();
    });

    //for showing permanent adress same as present while typing
    $('#presentadress').on('keyup', function () {
        $('#permanentadress').val(this.value);
        $('#guardianadress').val(this.value);
    })
    $('#presentcity').on('keyup', function () {
        $('#permanentcity').val(this.value);
        $('#guardiancity').val(this.value);
    })
    $('#presentdstrct').on('keyup', function () {
        $('#permanentdstrct').val(this.value);
        $('#guardiandstrct').val(this.value);
    })
    $('#presentcntry').on('keyup', function () {
        $('#permanentcntry').val(this.value);
        $('#guardiancntry').val(this.value);
    })

    $("#btnadress").on('click', function(){
        $('#permanentadress').val($('#presentadress').val());
        $('#permanentcity').val($('#presentcity').val());
        $('#permanentdstrct').val($('#presentdstrct').val());
        $('#permanentcntry').val($('#presentcntry').val());
    });
});

var count = 1;

$(document).on('click', '.btnadd', function () {
    var copyDiv = $(this).closest('.addrow');
    var clone = copyDiv.clone();
    clone.find('.form-control').val('');
    //clone.find('.feeamount').val('');
    //copyDiv.find('.btnrmv').show();
    //copyDiv.find('.btnadd').hide();
    //clone.find('.btnrmv').hide();
    //clone.find('.btnadd').show();
    copyDiv.after(clone);
    count++;
    var frm = $(this).closest('.form-horizontal');
    frm.data('validator', null);
    $.validator.unobtrusive.parse(frm);
});

$(document).on('click', '.btnrmv', function () {

    $(this).closest('.addrow').remove();
    count--;

    var frm = $(this).closest('.form-horizontal');
    frm.data('validator', null);
    $.validator.unobtrusive.parse(frm);

});

function rename() {
    var rows = $('.rw');
    //var hiddennstdid = $('.hdnstdid');
    for (var i = 0; i < rows.length; i++) {
        var exam = $(rows[i]).find('.exam');
        var year = $(rows[i]).find('.year');
        var rollNo = $(rows[i]).find('.rollNo');
        var board = $(rows[i]).find('.board');
        var obM = $(rows[i]).find('.obM');
        var tM = $(rows[i]).find('.tM');
        var grade = $(rows[i]).find('.grade');
        var subjects = $(rows[i]).find('.subjects');
        var instituteName = $(rows[i]).find('.instituteName');

        var examFor = $(rows[i]).find('.examFor');
        var yearFor = $(rows[i]).find('.yearFor');
        var rollNoFor = $(rows[i]).find('.rollNoFor');
        var boardFor = $(rows[i]).find('.boardFor');
        var obMFor = $(rows[i]).find('.obMFor');
        var tMFor = $(rows[i]).find('.tMFor');
        var gradeFor = $(rows[i]).find('.gradeFor');
        var subjectsFor = $(rows[i]).find('.subjectsFor');
        var instituteNameFor = $(rows[i]).find('.instituteNameFor');

        $(exam).attr('name', 'PreviousInstitutes[' + i + '].ExamType');
        $(examFor).attr('name', 'PreviousInstitutes[' + i + '].ExamType');
        $(year).attr('name', 'PreviousInstitutes[' + i + '].Year');
        $(rollNo).attr('name', 'PreviousInstitutes[' + i + '].RollNo');
        $(board).attr('name', 'PreviousInstitutes[' + i + '].Board');
        $(obM).attr('name', 'PreviousInstitutes[' + i + '].ObtainedMarks');
        $(tM).attr('name', 'PreviousInstitutes[' + i + '].TotalMarks');
        $(grade).attr('name', 'PreviousInstitutes[' + i + '].Grade');
        $(subjects).attr('name', 'PreviousInstitutes[' + i + '].Subjects');
        $(instituteName).attr('name', 'PreviousInstitutes[' + i + '].InstituteName');

        $(yearFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].Year');
        $(rollNoFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].RollNo');
        $(boardFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].Board');
        $(obMFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].ObtainedMarks');
        $(tMFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].TotalMarks');
        $(gradeFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].Grade');
        $(subjectsFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].Subjects');
        $(instituteNameFor).attr('data-valmsg-for', 'PreviousInstitutes[' + i + '].InstituteName');
        //$(hiddennstdid[i]).attr('name', 'PreviousInstitutes[' + i + '].StudentId');
    }
}

var required_elems_count = 1;
var already_focus = false;

function validate(currentElement, className){
    if ($(currentElement).val() == '' ){
        $('.'+className).remove();
        var errElem = "<span style='color:red;' class='"+className+"'>* This field is required.</span>";
        $(errElem).insertAfter(currentElement);
        $(currentElement).attr("style","border:1px solid red;");

    }
    else{
        $('.'+className).remove();
        $(currentElement).attr("style","");

        if(required_elems_count >= 16){
            //enable save button
            $("#saveFormBtn").removeAttr('disabled');
        }
        required_elems_count++;
    }

}

function calculateFee(){

    var admFee = Number($("#AdmFee").val());
    var feePkg = Number($("#feePkg").val());
    var tuitionFee = Number($("#tuitionFee").val());
    var boardUniRegFee = Number($("#boardUniRegFee").val());
    var libFee = Number($("#libFee").val());
    var miscFee = Number($("#miscFee").val());
    var otherFee = Number($("#otherFee").val());

    var totalFee = admFee + feePkg + tuitionFee + boardUniRegFee + libFee;
    var grandTotal = totalFee + miscFee + otherFee;

    // $("#totalFee").val(totalFee);
    $("#totalFee").val(grandTotal);
    $("#grandTotal").val(grandTotal);
}

