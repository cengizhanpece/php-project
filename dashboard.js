let firstSection = document.getElementById("first-section-popup");
let addArticle = document.getElementById("add-article-popup");
let deleteArticle = document.getElementById("delete-article-popup");
let footerSection = document.getElementById("footer-section-popup");
let overlay = document.getElementById("overlay");

document.getElementById("first-section").addEventListener("click",function(){
    hideAndShow(firstSection);
});

document.getElementById("add-article").addEventListener("click", function () {
    hideAndShow(addArticle);
});

document.getElementById("delete-article").addEventListener("click", function () {
    hideAndShow(deleteArticle);
});

document.getElementById("footer-section").addEventListener("click", function () {
    hideAndShow(footerSection);
});

document.getElementById("overlay").addEventListener("click", function () {
    let popups = document.getElementsByClassName("popup");
    [].forEach.call(popups, function (element) {
        if(!element.hasAttribute("hidden"))
            element.setAttribute("hidden","");
    });
    overlay.setAttribute("hidden", "");
});

function hideAndShow(element){
    if(element.hasAttribute("hidden")){
        element.removeAttribute("hidden");
        overlay.removeAttribute("hidden");
    }
    else
    {
        element.setAttribute("hidden","");
        overlay.setAttribute("hidden", "");
    }
}

function deleteArticles(id, element){
    var data = new FormData();
    data.append("id", id);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteArticle.php", true);
    xhr.send(data);
    element.parentElement.remove();
}