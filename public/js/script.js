$('#div1').click(function () {
    let div2 = $('#div2');
    if(div2.hasClass('show')){
        div2.slideToggle();
        div2.removeClass('show');
    }else{
        div2.slideToggle();
        div2.addClass('show');
    }
})

