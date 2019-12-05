document.addEventListener('DOMContentLoaded', function onLoad() {

  document.querySelector('.js-logout').addEventListener('click', () => {
    event.preventDefault();
    if (confirm('Are you sure you want to log out?')) {
      document.getElementById('logout-form').submit();
    }
  })

  document.querySelector('.js-updateToday').addEventListener('click', () => {
    // prompt for current bank balance
    // show difference with current expected balance
    // add other transactions?
    // confirm add this correcting transaction?
    // done
  });
  
});