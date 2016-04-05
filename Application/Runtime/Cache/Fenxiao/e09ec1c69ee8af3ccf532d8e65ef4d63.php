<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">

    <head>
        <meta charset="UTF-8">
        <title>拆红包动</title>
            <meta name="viewport" content="target-densitydpi=device-dpi, width=640px, user-scalable=no">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html {
                color: #fff;
                font-size: 26px;
            }

            .container {
                text-align: center;
                width: 100%;
                margin: 0 auto;
                background-color: rgba(0, 0, 0, 0.8);
                height: 100%;
                position: absolute;
            }

            .hongbao {
                height: 810px;
                background: #A5423A;
                width: 540px;
                left: 0;
                border-radius: 18px;
                margin: 0 auto;
                position: relative;
                top: 50%;
                margin-top: -405px;
            }

            .topcontent {
                height: 504px;
                border: 1px solid #BD503A;
                background-color: #BD503A;
                border-radius: 18px 18px 50% 50% / 18px 18px 15% 15%;
                box-shadow: 0px 4px 0px -1px rgba(0, 0, 0, 0.2);
            }

            .avatar {
                position: relative;
            }

            .avatar span {
                position: absolute;
                top: 32px;
                right: 27px;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
                font-size: 2em;
                font-weight: bolder;
            }

            #close {
                color: rgba(0, 0, 0, 0.5);
            }

            .avatar img {
                /*border: 1px solid #BD503A;*/
                border-radius: 60%;
                overflow: hidden;
                margin-top: 10%;
            }

            .topcontent h2 {
                margin: 27px 0;
            }

            .text {
                color: #999;
            }

            .description {
                margin: 27px 0;
                font-size: 28px;
                font-weight: bold;
            }

            #chai {
                width: 180px;
                height: 180px;
                border: 1px solid #FFA73A;
                background-color: #FFA73A;
                border-radius: 50%;
                color: #fff;
                font-size: 36px;
                display: inline-block;
                margin-top: -50px;
                box-shadow: 0px 7px 0px 0px rgba(0, 0, 0, 0.2);
            }

            #chai span {
                margin-top: 63px;
                display: inline-block;
            }

            .rotate {
                -webkit-animation: anim .6s infinite alternate;
                -ms-animation: anim .6s infinite alternate;
                animation: anim .6s infinite alternate;
            }

            @-webkit-keyframes anim {
                from {
                    -webkit-transform: rotateY(180deg);
                }
                to {
                    -webkit-transform: rotateY(360deg);
                }
            }

            @-ms-keyframes anim {
                from {
                    -ms-transform: rotateY(180deg);
                }
                to {
                    -ms-transform: rotateY(360deg);
                }
            }

            @keyframes anim {
                from {
                    transform: rotateY(180deg);
                }
                to {
                    transform: rotateY(360deg);
                }
            }
        </style>
        <script src="/Public/Fenxiao/jfsd/js/jquery-1.9.1.min.js"></script>
    </head>

    <body>
        <div class="container" id="container">
            <div class="hongbao">
                <div class="topcontent">
                    <div class="avatar">
                        <img src="/Public/Fenxiao/jfsd/images/logo.png" alt="" width="144" height="144">
                        <span id="close">+</span>
                    </div>
                    <h2>中华聚宝</h2>
                    <span class="text">给你发了一个红包</span>
                    <div class="description">恭喜发财 大吉大利</div>
                </div>
                <div class="chai" id="chai">
                    <span>拆红包</span>
                </div>
            </div>
        </div>
        <script>
            var oChai = document.getElementById("chai");
            var oClose = document.getElementById("close");
            var oContainer = document.getElementById("container");
            var fag = true;
            oChai.onclick = function() {
                if (fag) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            oChai.setAttribute("class", "rotate");
                            fag = false;
                        },
                        success: function(rep) {
                            fag = true;
                            oChai.setAttribute("class", "");
                            if (rep.status) {
                                alert(rep.info);
                                location.href = rep.url;
                            } else {
                                alert(rep.info);
                            }
                        },
                        error: function() {
                            fag = true;
                            oChai.setAttribute("class", "");
                            alert('网络异常...');
                        }
                    })
                }
            }
            oClose.onclick = function() {
                history.go(-1)
                // oContainer.style.display = "none";
            }
        </script>
    </body>

</html>