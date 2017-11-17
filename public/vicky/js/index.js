/**
 * Created by dodd on 2017/8/31.
 */


function genPhotoHtml(data) {
    var photos;

    jQuery.each(data, function (key, value) {
        photos =
            "<div class='box'>" +
            "<div style='height: 293px;'><img class='images' src='" + value.image + "?x-oss-process=style/card'></div>" +
            "<p class='font-content'>" + value.content + "</p>" +
            "<p class='font-date'>" + value.datetime + "</p>" +
            "</div>";

        $("#photo").append(photos);
    });

}
