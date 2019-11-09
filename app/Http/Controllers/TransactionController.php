<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\Template;
use App\Balance;
use App\Category;

class TransactionController extends Controller {

  /**
   * Create a new controller instance.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Calculates balance at a given date.
   *
   * Assumes that given date is after latest balance. TODO fix that?
   */
  private static function balanceAtTimestamp($startTime) {
    $latestBalance = Balance::orderby('datetime', 'DESC')->first();
    if (strtotime($latestBalance->datetime) > $startTime) {
      return FALSE;
    }
    $recentTransactions = Transaction::where('datetime', '>=', $latestBalance->datetime)
      ->where('datetime', '<', date('Y-m-d H:i:s', $startTime))
      ->orderBy('datetime')
      ->get();
    $balance = $latestBalance->amount;
    foreach ($recentTransactions as $transaction) {
      $balance += $transaction->amount;
    }
    return $balance;
  }

  public function getMonthBudgetRows($beginningOfMonth, $beginningBalance) {
    $day = $beginningOfMonth;
    $nextMonth = strtotime('+1 month', $beginningOfMonth);
    if ($beginningBalance !== FALSE) {
      $balance = $beginningBalance;
    }
    $rows = [];
    while ($day < $nextMonth) {
      $nextDay = strtotime('+1 day', $day);
      $dayTransactions = Transaction::where('datetime', '>=', date('Y-m-d H:i:s', $day))
        ->where('datetime', '<', date('Y-m-d H:i:s', $nextDay))
        ->orderBy('datetime')
        ->get();
      if (count($dayTransactions) < 1) {
        if ($beginningBalance !== FALSE) {
          $balanceValue = number_format($balance);
        } else {
          $balanceValue = '#';
        }
        $rows[] = [
          'date' => date('j', $day),
          'amount' => '-',
          'balance' => $balanceValue,
          'description' => '-',
          'edit_link' => route('transaction.create'),
        ];
      } else {
        $i = 0;
        foreach ($dayTransactions as $transaction) {
          if ($beginningBalance !== FALSE) {
            $balance += $transaction->amount;
            $balanceValue = number_format($balance);
          } else {
            $balanceValue = '#';
          }
          $date = $i === 0 ? date('j', strtotime($transaction->datetime)) : '';
          $rows[] = [
            'date' => $date,
            'amount' => number_format($transaction->amount),
            'balance' => $balanceValue,
            'description' => $transaction->description,
            'edit_link' => route('transaction.edit', $transaction->id),
          ];
          $i++;
        }
      }
      $day = $nextDay;
    }
    return $rows;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return redirect('/transaction/month/' . date('Y/m'));
  }

  public function month($year, $month) {
    $beginningOfMonth = strtotime($year . '-' . $month . '-01');
    $nextMonth = strtotime('+1 month', $beginningOfMonth);
    $prevMonth = strtotime('-1 month', $beginningOfMonth);
    $beginningBalance = self::balanceAtTimestamp($beginningOfMonth);
    $message = '';
    if ($beginningBalance == false) {
      $message = 'Please set a beginning balance before this month.';
    }
    $rows = $this->getMonthBudgetRows($beginningOfMonth, $beginningBalance);

    // Nav links.
    $prevHref = '/transaction/month/' . date('Y/m', $prevMonth);
    $prevText = date('< M y', $prevMonth);
    $nextHref = '/transaction/month/' . date('Y/m', $nextMonth);
    $nextText = date('M y >', $nextMonth);

    return view('transaction.month', [
      'title' => date('F Y', $beginningOfMonth),
      'rows' => $rows,
      'prevHref' => $prevHref,
      'prevText' => $prevText,
      'nextHref' => $nextHref,
      'nextText' => $nextText,
      'message' => $message,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $categories = Category::getArray();
    return view('transaction.create', [
      'categories' => $categories,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $data = $request->validate([
      'description' => 'required|max:100',
      'category_id' => 'required',
      'amount' => 'required',
      'date' => 'required',
      'time' => 'required',
    ]);

    $transaction = new Transaction();
    $transaction->user_id = Auth::id();
    $transaction->description = $data['description'];
    $transaction->amount = $data['amount'];
    $transaction->datetime = $data['date'] . ' ' . $data['time'] . ':00';
    $transaction->category_id = $data['category_id'];
    $transaction->save();

    return redirect(route('transaction.index'));
  }

  public function generate() {
    $year = date('Y');
    $nextYear = $year + 1;
    $years = [
      $year => $year,
      $nextYear => $nextYear,
    ];
    $months = [
      '01' => 'January',
      '02' => 'February',
      '03' => 'March',
      '04' => 'April',
      '05' => 'May',
      '06' => 'June',
      '07' => 'July',
      '08' => 'August',
      '09' => 'September',
      '10' => 'October',
      '11' => 'November',
      '12' => 'December',
    ];
    return view('transaction.generate', [
      'years' => $years,
      'months' => $months,
    ]);
  }

  public function run(Request $request) {
    $data = $request->validate([
      'year' => 'required',
      'month' => 'required',
    ]);
    $yearMonth = $data['year'] . '-' . $data['month'];

    $templates = Template::all();
    $income = Category::where('name', 'Income')->first();
    foreach ($templates as $template) {
      $transaction = new Transaction();
      $transaction->user_id = Auth::id();
      $transaction->description = $template->description;
      $transaction->amount = $template->category_id === $income->id
        ? $template->amount
        : -$template->amount;
      $transaction->datetime = $yearMonth . date('-d H:i:s', strtotime($template->datetime));
      $transaction->category_id = $template->category_id;
      $transaction->save();
    }
    return redirect(route('transaction.index'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $item = Transaction::find($id);
    $datetime = strtotime($item->datetime);
    $item->date = date('Y-m-d', $datetime);
    $item->time = date('H:i', $datetime);
    $categories = Category::getArray();
    return view('transaction.edit', [
      'item' => $item,
      'categories' => $categories,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $data = $request->validate([
      'description' => 'required|max:100',
      'category_id' => 'required',
      'amount' => 'required',
      'date' => 'required',
      'time' => 'required',
    ]);

    $transaction = Transaction::find($id);
    $transaction->description = $data['description'];
    $transaction->amount = $data['amount'];
    $transaction->datetime = $data['date'] . ' ' . $data['time'] . ':00';
    $transaction->category_id = $data['category_id'];
    $transaction->save();

    return redirect(route('transaction.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $template = Transaction::find($id);
    $template->delete();

    return redirect(route('transaction.index'));
  }

}
