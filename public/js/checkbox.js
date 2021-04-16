$(document).ready(function() {
    $("#chonAll").click(function() {
        $(":checkbox").prop("checked", true);
    });
    $("#bochonAll").click(function() {
        $(":checkbox").prop("checked", false);
    });
    $("#xoaAll").click(function() {
        if ($(":checked").length === 0) {
            alert("Vui lòng chọn ít nhất một mục!");
            return false;
        }
    });
});