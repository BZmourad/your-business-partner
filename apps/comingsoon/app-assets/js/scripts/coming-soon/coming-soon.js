$(document).ready(function () {
  var todayDate = new Date();
  var dd = todayDate.getDate();
  var mm = todayDate.getMonth();
  var yy = todayDate.getFullYear();

  if (mm >= 11) {
    mm = 1;
    yy += 1
  }
  else {
    mm += 2;
  }
  //var currentDate = (yy) + "/" + (mm) + "/" + dd;
  var currentDate = "2026/01/01";

  $('#clockImage').countdown(currentDate).on('update.countdown', function (event) {
    var $this = $(this).html(event.strftime(''
      + '<div class="clockCard p-2 mr-1 mb-3 bg-cyan bg-darken-4 box-shadow-2"> <span>%-w</span> <br> <p class="lead mb-0">Semaine%!w </p> </div>'
      + '<div class="clockCard p-2 mr-1 mb-3 bg-cyan bg-darken-4 box-shadow-2"> <span>%d</span> <br> <p class="lead mb-0">Jour%!d </p> </div>'
      + '<div class="clockCard p-2 mr-1 mb-3 bg-cyan bg-darken-4 box-shadow-2"> <span>%H</span> <br> <p class="lead mb-0">Heure%!H </p> </div>'
      + '<div class="clockCard p-2 mr-1 mb-3 bg-cyan bg-darken-4 box-shadow-2"> <span>%M</span> <br> <p class="lead mb-0">Minute%!M </h5> </div>'
      + '<div class="clockCard p-2 mb-3 bg-cyan bg-darken-4 box-shadow-2"> <span>%S</span> <br> <p class="lead mb-0"> Seconde%!S </p> </div>'))
  });

  $('#clockFlat').countdown(currentDate).on('update.countdown', function (event) {
    var $this = $(this).html(event.strftime(''
      + '<div class="clockCard p-1"> <span>%-w</span> <br> <p class="bg-amber clockFormat lead p-1 mt-1 black"> Semaine%!w </p> </div>'
      + '<div class="clockCard p-1"> <span>%d</span> <br> <p class="bg-amber clockFormat lead p-1 mt-1 black"> Jour%!d </p> </div>'
      + '<div class="clockCard p-1"> <span>%H</span> <br> <p class="bg-amber clockFormat lead p-1 mt-1 black"> Heure%!H </p> </div>'
      + '<div class="clockCard p-1"> <span>%M</span> <br> <p class="bg-amber clockFormat lead p-1 mt-1 black"> Minute%!M </p> </div>'
      + '<div class="clockCard p-1"> <span>%S</span> <br> <p class="bg-amber clockFormat lead p-1 mt-1 black"> Seconde%!S </p> </div>'))
  });

  $('#clockMinimal').countdown(currentDate).on('update.countdown', function (event) {
    var $this = $(this).html(event.strftime(''
      + '<div class="clockCard white p-2"> <span>%-w</span> <br> <p class="lead white"> Semaine%!w </p> </div>'
      + '<div class="clockCard white p-2"> <span>%d</span> <br> <p class="lead white"> Jour%!d </p> </div>'
      + '<div class="clockCard white p-2"> <span>%H</span> <br> <p class="lead white"> Heure%!H </p> </div>'
      + '<div class="clockCard white p-2"> <span>%M</span> <br> <p class="lead white"> Minute%!M </p> </div>'
      + '<div class="clockCard white p-2"> <span>%S</span> <br> <p class="lead white"> Seconde%!S </p> </div>'))
  });
  if ($('.comingsoonVideo').length > 0) {
    $('.comingsoonVideo').tubular({ videoId: 'iGpuQ0ioPrM' });
  }
});
