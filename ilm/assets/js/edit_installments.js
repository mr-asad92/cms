var count = 0;

var InstallmentNo = 1;
var val = 0;
var ddlNo = 0;
var arrDates = [];
var countPendAmnt = 0;

$(document).ready(function () {
    ////$('#loader').show();
    //$("body").css({ opacity: 1.0 });
    // GenerateRow();
    initCount();
});

//$(window).load(function () {
//    $('#loader').hide();
//})

$('#InitialAmount').change(function () {
    var InitialAmount = $(this).val().trim();
    if (InitialAmount > 0) {
        InstallmentNo = 2;
    } else {
        InstallmentNo = 1;
    }
    InitialAmount = parseFloat(InitialAmount ? InitialAmount : 0);
    var tot = $('#tot').val();
    tot = parseFloat(tot ? tot : 0);
    var total = tot - InitialAmount;
    $('#InstallmentAmount').val(total);
    GenerateRow();
});

//$('#btnMakeInst').click(function () {
//    GenerateRow();
//});

function GetNextDate() {
    var start = new Date();
    //start = start.toLocaleString();
    var end = $('#dto').val();
    //var diff = new Date(end - start);
    var diff = new Date(Date.parse(end) - Date.parse(start))
    var days = diff / 1000 / 60 / 60 / 24;
    days = Math.round(days);
    var No = $('.txtNo');
    No = No.length;
    var DayToAdd = days / No;
    DayToAdd = Math.round(DayToAdd);
    Date.prototype.addDays = function (days) {
        var dat = new Date(this.valueOf());
        dat.setDate(dat.getDate() + days);
        return dat;
    }
    var date = start;
    arrDates = [];
    for (var i = 0; i < No; i++) {
        var NxtDate = date.addDays(DayToAdd);
        date = NxtDate;
        arrDates.push(NxtDate);
    }
}

function initCount(){
    ddlNo = $('.rw').length;
    count = ddlNo;

}

function GenerateRow() {
    ddlNo = $('.rw').length;
    if (ddlNo > 0 && ddlNo != 'undefined' && ddlNo != '') {
        count = 0;
        $('.rw').remove();
        var htm = '';
        for (var i = 0; i < ddlNo; i++) {
            count++;
            htm += '<tr class="rw">'
            htm += ' <td class="text-center" id="NoOfInst"><input class="form-control txtNo" data-val="true" data-val-number="The field NoOFInstallment must be a number." data-val-required="The NoOFInstallment field is required." id="FeeInstallmentDetails" readonly="readonly" name="installmentNo[]" value="2" type="text"><span class="field-validation-valid text-danger VLDNo" data-valmsg-for="FeeInstallmentDetails[0].NoOFInstallment" data-valmsg-replace="true"></span></td>'
            htm += '<td class="text-center" id="PendAmnt"><input class="form-control txtAmnt installment_amounts" data-val="true" data-val-number="The field InstallmentAmount must be a number." data-val-required="The InstallmentAmount field is required." id="FeeInstallmentDetails" name="installmentAmount[]" value="10000" type="text"><span class="field-validation-valid text-danger VLDAmnt" data-valmsg-for="FeeInstallmentDetails[0].InstallmentAmount" data-valmsg-replace="true"></span></td>'
            htm += '<td class="text-center" id="dte"><div class="input-group date "><input value="05/20/2018" class="form-control txtDate" data-val="true" data-val-date="The field InstallmentDate must be a date." data-val-required="The InstallmentDate field is required." id="Date" name="installmentDate[]" type="text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div><span class="field-validation-valid text-danger VLDDate" data-valmsg-for="FeeInstallmentDetails[0].InstallmentDate" data-valmsg-replace="true"></span></td>'

            htm += '<td>UnPaid</td>';
            htm += '<td><input type="button" value="Add" class="btn btn-info btnAdd">&nbsp;<input type="button" value="Remove" class="btn btn-info btnDel"></td></tr>'
        }
        $('#tbdy').append(htm);
        ReName();
    }
}

function ReName() {
    var pendAmnt = $('#InstallmentAmount').val();
    var txtNo = $('.txtNo');
    var txtAmnt = $('.txtAmnt');
    var txtDate = $('.txtDate');
    var VLDNo = $('.VLDNo');
    var VLDAmnt = $('.VLDAmnt');
    var VLDDate = $('.VLDDate');

    var paidCount = $('.pad').length;
    var lim = paidCount;

    val = 0;
    NoOfInst = txtNo.length - paidCount;

    val = pendAmnt / NoOfInst;
    var cnt = 0;
    if ($('#InitialAmount').val().trim() > 0) {
        cnt = 2;
    } else {
        cnt = 1;
    }

    GetNextDate();
    countPendAmnt = 0;


    var todayDate = getTodayDate();
    var to_date = $("#dto").val();

    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var firstDate = new Date(todayDate);
    var secondDate = new Date(to_date);

    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));

    // console.log(diffDays);
    var installmentDiff = Number(diffDays) / Number(NoOfInst);

    var current_date = firstDate;

    for (var i = 0; i < txtDate.length; i++) {

        if (i < lim) {

        }else {
            InstallmentNo = cnt + i;
            $(txtNo[i]).attr('value', InstallmentNo)


            instVal = pendAmnt / NoOfInst;

            if (txtDate.length != i + 1) {
                instVal = Math.ceil(instVal / 10) * 10;
            }

            NoOfInst--;
            pendAmnt = pendAmnt - instVal;

            val = Math.ceil(val / 10) * 10

            current_date = current_date.addDays(installmentDiff);

            $(txtAmnt[i]).attr('value', instVal)
            var dat = arrDates[i];
            // $(txtDate[i]).datepicker("setDate", dat);
            // $(txtDate[i]).datepicker({dateFormat: 'dd-mm-yy'});
            $(txtDate[i]).datepicker("setDate", current_date);
            /* $(txtDate[i]).datepicker({ setDate: current_date });*/


            var pendamnt = txtAmnt[i].value;
            pendamnt = parseFloat(pendamnt ? pendamnt : 0);
            countPendAmnt += pendamnt;
        }

    }


    ReSetValidation();
}

function getTodayDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    return today;
}

$(document).on('click', '.btnAdd', function () {

    var row = $(this).closest('.rw');
    var cpy = row.clone();
    $(row).after(cpy);
    InstallmentNo++;
    count++;
    //$('#ddlNo').val(count);
    ReName();
});

$(document).on('click', '.btnDel', function () {

    if (count > 1) {
        var row = $(this).closest('.rw');
        var cpy = row.remove();
        InstallmentNo--;
        count--;
        ReName();
        //$('#ddlNo').val(count);
    }
});

function ReSetValidation() {
    var form = $('form').removeData('validator').removeData('unobtrusiveValidation');
    $.validator.unobtrusive.parse(form);
}
//for toggling Dynamic Date
$(document).on('click', '.date', function () {
    $(this).datepicker({ todayHighlight: true });
});

$('#btnSubmit').click(function () {
    countPendAmnt = 0;
    $('.txtAmnt').each(function () {
        var pendamnt = $(this).val();
        countPendAmnt += parseFloat(pendamnt ? pendamnt : 0);
    });

    var pendAmnt = $('#InstallmentAmount').val();
    if (countPendAmnt == pendAmnt) {
        frm.submit();
    } else {
        $.pnotify({
            title: 'Amount Error',
            text: 'Pending amount and installments amount should be equal',
            type: 'error'
        });
        return false;
    }
});