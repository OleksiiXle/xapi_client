
$(document).ready(function () {
    // console.log(_cinema_hall);
    var d = JSON.parse(_cinema_hall);
    $.each(d, function (index, rowData) {
       // console.log(index + '***********************8');
        drawRow(index, rowData);
    });

});

function drawRow(index, rowData) {
    /*
{number: 13, status: "free", price: "150", persona: "None"
 */
    var disabledTxt;
    var ret = '<div class="kinoRow" id="kinoRow_' + index + '">' +
                '<div class="row">' +
                    '<div class="col-md-1">' + index +
                    '</div>' +
                    '<div class="col-md-11" align="center">';

    $.each(rowData, function (i, data) {
        disabledTxt = (data['status'] != 'free') ? 'disabled' : '';
        ret += '<button id="id_' + index + '_' + data['number'] + '" class="seatBtn ' + data['status'] + '"' +
            'data-rownumber="' + index + '" ' +
            'data-seatnumber="' + data['number'] + '" ' +
            'data-status="' +  data['status'] + '" '+
            'data-persona="' +  data['persona'] + '" ' +
            'onclick="seatClick(this)" ' +
            disabledTxt +
            '>' +
                data['number'] +
            '</button>';
    });
    ret += '</div></div></div>';
    $('#rows').append(ret);
}

function seatClick(btn) {
    var seatData = btn.dataset;
    if ($(btn).hasClass('free')){
        $(btn).removeClass('free').addClass('taken');
        btn.dataset['status'] = 'taken'
    } else {
        $(btn).removeClass('taken').addClass('free');
        btn.dataset['status'] = 'free'
    }
   // console.log(btn.dataset);
}

function reservate() {
    var reservation = [];
    var buf = [];
    $('.taken').each(function () {
        console.log(this.dataset['persona']);
        if (this.dataset['persona'] == 'None'){
            buf = {'rowNumber' : this.dataset['rownumber'], 'seatNumber' : this.dataset['seatnumber']};
            reservation.push(JSON.stringify(buf));
        }
    });
    $('#reservation').val(JSON.stringify(reservation));
    $('#form-reservate').submit();


}
