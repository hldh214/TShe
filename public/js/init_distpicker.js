$('.province').each(function (_, value) {
    let province_no = $(value).data('no');
    $(value).text($(document).distpicker('getDistricts')[province_no]);
});

$('.city').each(function (_, value) {
    let city_no = $(value).data('no');
    $(value).text($(document).distpicker('getDistricts', $(value).prev().data('no'))[city_no]);
});

$('.district').each(function (_, value) {
    let district_no = $(value).data('no');
    $(value).text($(document).distpicker('getDistricts', $(value).prev().data('no'))[district_no]);
});
