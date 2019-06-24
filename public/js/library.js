function select2create(el, url, palceholder = 'Pilih Data', clear = false) {
    $(el).select2({
        placeholder: palceholder,
        allowClear: clear,
        ajax: {
            url: url,
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

$(document).on('focus', '.select2', function (e) {
    if (e.originalEvent) {
        $(this).find('span.select2-selection').attr("style", "border-color:#3c8dbc !important;");
    }
});
$(document).on('focusout blur', '.select2', function (e) {
    if (e.originalEvent) {
        $(this).find('span.select2-selection').removeAttr("style");
    }
});

function select2isi(el, id, text) {
    if ($(el).find("option[value='" + id + "']").length) {
        $(el).val(id).trigger('change');
    } else {
        var newOption = new Option(text, id, true, true);
        $(el).append(newOption).trigger('change');
    }
}

function dtresponsive(width = 100) {
    return {
        renderer: function ( api, rowIdx, columns ) {
            var data = $.map( columns, function ( col, i ) {
                return col.hidden ?
                    '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                        '<th style="vertical-align: top; padding:3px; padding-right:10px;" width="'+ width +'px">'+col.title+'</th> '+
                        '<td style="padding:3px;">'+col.data+'</td>'+
                    '</tr>' :
                    '';
            } ).join('');

            return data ?
                $('<table/>').append( data ) :
                false;
        }
    }
}

function tglpilih(el = '.tglpilih') {
    $(el).daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY',
            daysOfWeek: [
                "Min",
                "Sen",
                "Sel",
                "Rab",
                "Kam",
                "Jum",
                "Sab"
            ],
            monthNames: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustust",
                "September",
                "Oktober",
                "November",
                "Desember"
            ]
        },
    });
}

function formuang(el = ".formuang", minus = false) {
    $(el).inputmask("numeric", {
        groupSeparator: ".",
        digits: 0,
        autoGroup: true,
        rightAlign: false,
        removeMaskOnSubmit: true,
        allowMinus: minus
    });
}