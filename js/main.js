$(document).ready(function () {

  $('.sidenav').sidenav({
    draggable: true,
  });

  $('.parallax').parallax();
  $('.carousel').carousel();
  $('.modal').modal();
  setInterval(function() {
    $('.carousel').carousel('next');
  }, 5000);

  $('.forDesktop').floatingActionButton();

  $('.forMobile').floatingActionButton({
    toolbarEnabled: true
  });

});