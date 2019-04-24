function changeMediumImage(obj) {
    var imgEle = document.getElementById("featured").getElementsByTagName("img")[0];
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    imgEle.src = obj.src.replace("small", "medium");
    imgEle.title = obj.title;
    titleEle.innerHTML = obj.title;
}

function setOpacity(ele, val) {
    ele.style.opacity = val;
}
//淡入效果(含淡入到指定透明度)
function fadeIn(ele, OpaGap, timeGap, opacity, target){
    var val = opacity;

    (function () {
        setOpacity(ele, val);
        val += OpaGap;
        if(val <= target){
            setTimeout(arguments.callee, timeGap);
        }
    })();
}
function fadeOut(ele, OpaGap, timeGap, opacity, target) {
    var val = opacity;

    (function () {
        setOpacity(ele, val);
        val -= OpaGap;
        if(val >= target){
            setTimeout(arguments.callee, timeGap);
        }
    })();
}

function showCaption(){
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    fadeIn(titleEle, 0.02, 25, 0, 0.8);
}
function hideCaption(){
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    fadeOut(titleEle, 0.02, 25, 0.8, 0);
}
window.onload = function (ev) {
    var thumbnails = document.getElementById("thumbnails");
    var thumbnailImgs = thumbnails.getElementsByTagName("img");
    for(var i = 0; i < thumbnailImgs.length; i++){
        thumbnailImgs[i].onclick = function (ev1) { changeMediumImage(this); };
    }
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    var imgEle = document.getElementById("featured").getElementsByTagName("img")[0];
    imgEle.onmouseenter = function (ev1) {
        showCaption();
    }
    imgEle.onmouseleave = function (ev1) {
        hideCaption();
    }
}