$(function(){
    //Afficher l'ancien pwd lors de l'event hover sur l'icone showlastpwd

    var txtlastPwd=$('.lastpwd');

    $('.show-last-pwd').hover(
        fnOver, function () {
            txtlastPwd.attr('type','text');
        },
        fnOut, function () {
            txtlastPwd.attr('type','password');
        }
    )
})