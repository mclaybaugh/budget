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

  const isUpdateToday = document.querySelector('.js-updateToday');
  if (isUpdateToday) {
    let balance = parseFloat(document.querySelector('.balance').innerText);
    let actualInput = document.querySelector('[name="actual_balance"]');
    let differenceEl = document.querySelector('.difference');
    let linkEl = document.querySelector('.updateLink');
    const href = linkEl.href;
    actualInput.addEventListener('keyup', function() {
      let balanceBig = balance * 100;
      if (event.target.value) {
        let actualBig = parseFloat(event.target.value) * 100;
        let diff = Math.round(actualBig - balanceBig) / 100;
        differenceEl.innerText = diff;
        linkEl.href = `${href}?description=Updated Today&category_id=5&amount=${diff}&time=23:59`;
      } else {
        differenceEl.innerText = '';
        linkEl.href = href;
      }
    })
  }

  if (document.querySelector('form')) {
    (new URL(window.location.href)).searchParams.forEach((x, y) => {
      let el = document.getElementById(y)
      if (el) {
        el.value = x;
      }
    })
  }
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