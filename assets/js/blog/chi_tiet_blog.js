
var mucluc = document.getElementById("muc-luc-content-thu");
var input1 = document.getElementById("content-thu");
var contentmucluc = document.getElementById("content-mucluc");
var ml = document.getElementById("mucluc");
var title_mucluc = document.getElementById("tieudemucluc");

function click_show(e) {
    if (contentmucluc.style.display == 'none') {
        contentmucluc.style.display = 'block';
        ml.style.width = "100% ";
        mucluc.style.height = "auto ";
        mucluc.style.overflow = "hidden ";
        mucluc.style.setProperty('margin', 'auto', 'important');
        mucluc.style.setProperty('height', 'auto', 'important');
        mucluc.style.setProperty('min-height', '40px', 'important');
        mucluc.style.setProperty('padding', ' 0px 40px 25px  40px', 'important');
        //
        ml.style.height = "auto";
        ml.style.overflow = "hidden ";
        title_mucluc.style.lineHeight = "60px";
    } else {
        contentmucluc.style.display = 'none';
        ml.style.width = "255px ";
        mucluc.style.height = "50px ";
        mucluc.style.overflow = "hidden ";
        mucluc.style.setProperty('margin', 'auto', 'important');
        mucluc.style.setProperty('height', '40px', 'important');
        mucluc.style.setProperty('min-height', '40px', 'important');
        mucluc.style.setProperty('padding', '0 20px', 'important');
        //
        ml.style.height = "auto";
        ml.style.overflow = "hidden ";
        title_mucluc.style.lineHeight = "40px";
    }

}
if (mucluc != null && input1 != null) {
    var input2 = input1.getElementsByTagName("*");
    var h2 = input1.getElementsByTagName("H2").length;
    var h3 = input1.getElementsByTagName("H3").length;
    var h4 = input1.getElementsByTagName("H4").length;
    var h5 = input1.getElementsByTagName("H5").length;
    if (h2 > 0 || h3 > 0 || h4 > 0 || h5 > 0) {
        var tieudemucluc = document.getElementById("tieudemucluc");
        var strong = document.createElement("strong");
        strong.innerHTML = "Mục lục bài viết";
        mucluc.style.minHeight = "100px";
        mucluc.style.width = "100%";
        mucluc.style.fontSize = "16px";
        mucluc.style.color = "black";

        tieudemucluc.appendChild(strong);
    } else {
        mucluc.style.display = "none";
    }
    for (i = 0; i < input2.length; i++) {
        if (input2[i].tagName == 'H1' || input2[i].tagName == "IMG" || input2[i].tagName == 'H2' || input2[i].tagName == 'H3' || input2[i].tagName == 'H4' || input2[i].tagName == 'H5' || input2[i].tagName == 'H6') {
            var uri_ct = input2[i].textContent;
            if (input2[i].tagName == 'H1') {
                input2[i].setAttribute("id", uri_ct + i);
                var li = document.createElement("div");
                var href = document.createElement("a");
                if (input2[i].hasAttribute("img")) {}
                href.href = urlHref + "#" + uri_ct + i;
                href.innerHTML = uri_ct;
                href.className = "H1abc";
                li.appendChild(href);
                contentmucluc.appendChild(li);
            }
            if (input2[i].tagName == 'H2') {
                input2[i].setAttribute("id", uri_ct + i);
                var li = document.createElement("li");
                var href = document.createElement("a");
                href.href = urlHref + "#" + uri_ct + i;
                href.innerHTML = uri_ct;
                href.className = "H2abc";
                li.appendChild(href);
                contentmucluc.appendChild(li);
                input2[i].style.marginLeft = "20px";
            }
            if (input2[i].tagName == 'H3') {
                input2[i].setAttribute("id", uri_ct + i);
                var li = document.createElement("li");
                var href = document.createElement("a");
                href.href = urlHref + "#" + uri_ct + i;
                href.className = "H3abc";
                href.innerHTML = uri_ct;
                li.appendChild(href);
                contentmucluc.appendChild(li);
            }
            if (input2[i].tagName == 'H4') {
                input2[i].setAttribute("id", uri_ct + i);
                var li = document.createElement("li");
                var href = document.createElement("a");
                href.href = urlHref + "#" + uri_ct + i;
                href.className = "H4abc";
                href.innerHTML = uri_ct;
                li.appendChild(href);
                contentmucluc.appendChild(li);
            }
        }
        // if (input2[i].tagName == 'IMG') {
        //   input2[i].setAttribute("class", "view");
        // }
    }
}