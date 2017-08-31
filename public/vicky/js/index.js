/**
 * Created by dodd on 2017/8/31.
 */


function genPhotoHtml(data) {
    var photos;

    jQuery.each(data, function (key, value) {
        photos =
            "<div class='box'>" +
            "<img class='images' src='" + value.image + "'>" +
            "<p class='font-content'>" + value.content + "</p>" +
            "<p class='font-date'>" + value.datetime + "</p>" +
            "</div>";

        $("#photo").append(photos);
    });

}
