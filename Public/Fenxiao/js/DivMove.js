var IsDrag = true;

function Drag(dv, HDiv) {

    if (typeof (dv) == typeof ("")) {
        dv = document.getElementById(dv);
    }

    if (typeof (HDiv) == typeof ("")) {
        dv = document.getElementById(HDiv);
    }

    if (dv.getAttribute("IsDrag") != "1") {
        dv.setAttribute("IsDrag", "1");
        drag(dv, HDiv);
    }
}

function drag(dv,HDiv) {

    if (typeof (dv) == typeof ("")) {
        dv = document.getElementById(dv);
    }

    if (typeof (HDiv) == typeof ("")) {
        dv = document.getElementById(HDiv);
    }

    HDiv.onmousedown = function () {

        var d = document;
        e = getEvent(); //e || window.event;
        var x =  e.offsetX || e.layerX;
        var y = e.offsetY || e.layerY;

        //设置捕获范围
        if (HDiv.setCapture) {
            HDiv.setCapture();
        } else if (window.captureEvents) {
            window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
        }

        d.onmousemove = function () {
            

            if (!IsDrag) return;

            var e = getEvent();//e || window.event;

           

            if (!e.pageX) e.pageX = e.clientX;
            if (!e.pageY) e.pageY = e.clientY;
            var tx = e.pageX - x;
            var ty = e.pageY - y;

            if (ty < 0) {
                ty = 0;
             
            }

            if (tx < 0) {
                tx = 0;
            }

           

            dv.style.left = tx + "px";
            dv.style.top = (ty + getScroll())*1 + "px";


            dv.style.filter = "ALPHA(opacity=60)";
        }

        d.onmouseup = function () {
            //取消捕获范围
            if (HDiv.releaseCapture) {
                HDiv.releaseCapture();

            } else if (window.captureEvents) {
                window.captureEvents(Event.MOUSEMOVE | Event.MOUSEUP);
            }

            //清除事件
            d.onmousemove = null;
            d.onmouseup = null;
            dv.style.filter = "ALPHA(opacity=100)";

        }
    }
}