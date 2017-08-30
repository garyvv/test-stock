/**
 * Created by dodd on 2017/8/31.
 */


function genPhotoHtml(data) {
    var photos;

    jQuery.each(data, function (key, value) {
        photos =
            "<div class='box'>" +
            "<img class='images' src='" + value.image + "'>" +
            "<p>" + value.content + "</p>" +
            "<p>" + value.datetime + "</p>" +
            "</div>";

        $("#photo").append(photos);
    });

}
