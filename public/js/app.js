document.addEventListener('DOMContentLoaded', function onLoad() {

  var logout = document.querySelector('.js-logout');
  if (logout) {
    logout.addEventListener('click', function () {
      event.preventDefault();
      if (confirm('Are you sure you want to log out?')) {
        document.getElementById('logout-form').submit();
      }
    });
  }

  var updateToday = document.querySelector('.js-updateToday');
  if (updateToday) {
    updateToday.addEventListener('click', function () {
      // prompt for current bank balance
      // show difference with current expected balance
      // add other transactions?
      // confirm add this correcting transaction?
      // done
    });
  }
  
});