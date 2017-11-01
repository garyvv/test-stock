/**
 * Created by lsd on 2017/11/1.
 */

/**
 * 打开OSS的文件夹
 * @param ossUrl
 */
function loadOss(ossUrl) {
    layer.open({
        type: 2,
        title: '图片选取',
        shadeClose: true,
        scrollbar: false,
        area: ['1024px', '640px'],
        content: ossUrl
    });
}

/**
 *
 * @param photoId 要删除哪张图片
 * @param modelId 数据库字段
 */
function delPhoto(photoId, modelId) {
    layer.confirm('确认删除该图片？', {
        btn: ['确认','取消'] //按钮
    }, function(){
//        预览删除
        $('#' + photoId).remove();

        var image = '';
//        Input框
        $("#photo-preview img").each(function(i){
            image = image + $(this).attr("src") + ',';
        });
        image = image.substring(0, image.length - 1);
        $('#' + modelId).val(image);

//        计算选的图片数量
        $('#count-photo').text(parseInt($('#count-photo').text()) - 1);
        layer.msg('删除预览图成功', {icon: 1});
    });
}

/**
 * HTML id：count-photo，photo-preview默认占用
 * @param divId 需要加按钮的div id，
 * @param modelId 数据库存储的字段
 * @param ossUrl 要打开OSS的路径
 * @param images 初始的图片
 */
function ossImage(divId, modelId, ossUrl, images) {
    var btnOss = '<br>' +
        '<div id="photo-preview"></div>' +
        '<span class="pull-right" id="count-photo">0</span>' +
        '<button onclick="loadOss(\'' + ossUrl + '\')" type="button" class="pull-left btn btn-primary">选择图片</button>' +
        '<span style="font-size: 12px; color: #999999; line-height: 50px;">点击图片删除</span>' +
        '<br><hr>';
    $('#' + divId).append(btnOss);

    var imageNum = 0;
//    预览
    $.each(images,function(i,value) {
        imageNum ++;
        var img = '<img ' +
            'id="photo-' + i + '" ' +
            'onclick="delPhoto(\'photo-' + i + '\', ' + modelId + ')" ' +
            'style="border: 1px solid #3c8dbc; border-radius: 5px;padding: 2px; height: 50px;width: auto;margin-right: 3px" ' +
            'src="' + value + '">';
        $('#photo-preview').append(img);
    });

//    初始化图片预览和计数
    $('#count-photo').text(imageNum);
}