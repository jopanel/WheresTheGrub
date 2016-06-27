$(document).ready(function(){

    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(40.435833800555567, -78.44189453125),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 11
        };   
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    };

    $('.searchbar-search').focus();
    $('.searchbar-search').keypress(function(){
        $('.searchbar-submit').fadeIn('fast');
    })

    $('#btn-more-filters').on('click',function(){
        $('.more-filters').fadeIn('fast');
        $('#btn-more-filters').css('display','none');
        $('#btn-less-filters').removeClass('hide');
    })

    $('#btn-less-filters').on('click',function(){
        $('.more-filters').fadeOut('fast');
        $('#btn-less-filters').addClass('hide');
        $('#btn-more-filters').css('display','inline-block');
    })

})