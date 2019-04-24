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
var id = 0;
function fadeIn(ele, OpaGap, timeGap, opacity, target){
    var val = opacity;

    (function () {
        setOpacity(ele, val);
        val += OpaGap;
        if(val <= target){
            id = setTimeout(arguments.callee, timeGap);
        }
    })();
}
function fadeOut(ele, OpaGap, timeGap, opacity, target) {
    var val = opacity;

    (function () {
        setOpacity(ele, val);
        val -= OpaGap;
        if(val >= target){
            id = setTimeout(arguments.callee, timeGap);
        }
    })();
}

function showCaption(){
    clearTimeout(id);
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    if(titleEle.style.opacity === "0.8")
        return;
    fadeIn(titleEle, 0.004, 5, parseFloat(titleEle.style.opacity?titleEle.style.opacity:"0"), 0.8);
}
function hideCaption(){
    clearTimeout(id);
    var titleEle = document.getElementById("featured").getElementsByTagName("figcaption")[0];
    if(titleEle.style.opacity === "0")
        return;
    fadeOut(titleEle, 0.004, 5, parseFloat(titleEle.style.opacity), 0);
}
window.onload = function (ev) {
    var thumbnails = document.getElementById("thumbnails");
    var thumbnailImgs = thumbnails.getElementsByTagName("img");
    for(var i = 0; i < thumbnailImgs.length; i++){
        thumbnailImgs[i].onclick = function (ev1) { changeMediumImage(this); };
    }
    var imgEle = document.getElementById("featured");
    imgEle.onmouseenter = function (ev1) {
        showCaption();
    };
    imgEle.onmouseleave = function (ev1) {
        hideCaption();
    };
}