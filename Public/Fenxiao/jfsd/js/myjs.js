$(function(){
    //首页浮动特效
    $(window).scroll(function(){
        var i = $(window).scrollTop();
        var x=$(".index_main_top2").offset().top;
        if(i>=x){
            $('.index_xf').slideDown(800);
        }
        else{
            $('.index_xf').slideUp(800);
        }
    })

    //弹窗
    $('.zx1').height($(window).height());
    $('.tanchuang').click(function(){
        $('.zx1').fadeIn();
        $('.tcdiv1').fadeIn();
        $('.tcdiv1').css('margin-top',($(window).height()-$('.tcdiv1').height())/2);

    })
    $('.zx1,.gb').click(function(){
        $('.tcdiv1').hide();
        $('.zx1').hide();
    })

    //首页加载
    // $(window).scroll(function () {
    // 	if ($(window).scrollTop() == $(document).height() - $(window).height()) {
    // 	alert('要加载的内容');
    //
    // 	}
    // });

    //加减
    $('.z_szanniu').click(function(){
        var fuhao=$(this).text();
        var zs=$(this).siblings('.z_shu');
        var zsi=$(this).siblings('.z_shu').children('.z_shu_input');
        var shuzi1=parseInt(zsi.val());
        var num=parseInt(zs.attr('data-num'));
        var sum;
        if(fuhao=='+'){
            sum=shuzi1+num;
        }
        else{
            if(shuzi1<num){
            sum=0;
        }
        else{
            sum=shuzi1-num;
        }
        }
        zsi.val(sum);
    })
})
