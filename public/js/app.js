document.addEventListener('DOMContentLoaded', function () {

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

  var isTransactionView = document.querySelector('.view-transactionMonth');
  if (isTransactionView) {
    var d = new Date();
    var today = d.getFullYear() + '-' + ("0"+(d.getMonth()+1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2);
    var days = document.querySelectorAll('table tbody td:first-of-type');
    for (var day of days) {
      var date = day.innerText;
      if (date === today) {
        day.parentElement.classList.add('bg-primary900');
        break;
      }
    }
  }
});