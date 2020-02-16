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

  const isTransactionView = document.querySelector('.view-transactionMonth');
  if (isTransactionView) {
    let todaysRow = getTodayLastRow();
    todaysRow.classList.remove('depth-2');
    todaysRow.classList.add('bg-primary900');
  }
  // const updateToday = document.querySelector('.js-updateToday');
  // if (updateToday) {
  //   updateToday.addEventListener('click', function () {
  //     // show expected, prompt for current bank balance
  //     // show difference with current expected balance
  //     // confirm add this correcting transaction?
  //     // done
  //     let todaysBalance = getTodaysBalance();
  //     console.log(todaysBalance);
  //   });
  // }
  // function getTodaysBalance() {
  //   let todaysRow = getTodayLastRow();
  //   return todaysRow.querySelector('.transactionBalance').innerText;
  // }

});

// get date as Y-m-d
function getDateYmd() {
  let d = new Date();
  return d.getFullYear() + '-' + ("0"+(d.getMonth()+1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2);
}

function getTodayLastRow() {
  let today = getDateYmd();
  let days = document.querySelectorAll('.transactionDate');
  let row;
  for (let day of days) {
    let date = day.innerText;
    if (date === today) {
      row = day.parentElement;
      while (row.nextElementSibling.firstElementChild.innerText === '') {
        row = row.nextElementSibling;
      }
      return row;
    }
  }
}