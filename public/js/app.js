document.addEventListener('DOMContentLoaded', function () {

  const logout = document.querySelector('.js-logout');
  if (logout) {
    logout.addEventListener('click', function () {
      event.preventDefault();
      if (confirm('Are you sure you want to log out?')) {
        document.getElementById('logout-form').submit();
      }
    });
  }

  const updateToday = document.querySelector('.js-updateToday');
  if (updateToday) {
    updateToday.addEventListener('click', function () {
      // prompt for current bank balance
      // show difference with current expected balance
      // add other transactions?
      // confirm add this correcting transaction?
      // done
    });
  }

  const isTransactionView = document.querySelector('.view-transactionMonth');
  if (isTransactionView) {
    let d = new Date();
    const today = d.getFullYear() + '-' + ("0"+(d.getMonth()+1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2);
    let days = document.querySelectorAll('table tbody td:first-of-type');
    for (let day of days) {
      let date = day.innerText;
      if (date === today) {
        day.parentElement.classList.add('bg-primary900');
        break;
      }
    }
  }
});