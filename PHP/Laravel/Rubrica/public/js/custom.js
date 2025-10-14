let windowWidth = $(window).width();
let windowHeight = $(window).height();
let menuNavDivWidthPerc = 1;
//  let menuNavDivLeftPerc = (1 - menuNavDivWidthPerc) / 2
let menuNavDivTopPerc = 0.05;
let menuNavItemWidthPerc = 0.1;

$('.menuNavDiv').width(windowWidth * menuNavDivWidthPerc);
//  $('.menuNavDiv').css('margin-left',windowWidth * menuNavDivLeftPerc);
$('.menuNavDiv').css('margin-top',windowHeight * menuNavDivTopPerc);
$('.menuNavItem').width($('.menuNavDiv').width() * menuNavItemWidthPerc);
