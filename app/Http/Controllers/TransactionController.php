<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Template;

class TransactionController extends Controller {

  /**
   * Create a new controller instance.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $begin = date('Y-m-01');
    $end = date('Y-m-d', strtotime('+1 month', strtotime($begin)));
    // $transactions = Transaction::where('datetime', '>=', $begin)
    //   ->where('datetime', '<', $end)
    //   ->orderBy('datetime')
    //   ->get();

    // 1. Get latest balance
    // 2. Get all transactions since that balance
    // 3. Calculate balances needed for index

    // Date
    // Amount
    // Balance
    // Description
    return view('transaction.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('transaction.create');
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
      'datetime' => 'required',
    ]);

    $transaction = new Transaction();
    $transaction->user_id = Auth::id();
    $transaction->description = $data['description'];
    $transaction->amount = $data['amount'];
    $transaction->datetime = $data['datetime'];
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
    return view('transaction.generate')->with('years', $years);
  }

  public function run(Request $request) {
    $data = $request->validate([
      'year' => 'required',
      'month' => 'required',
    ]);
    $yearMonth = $data['year'] . '-' . $data['month'];

    $templates = Template::all();
    foreach ($templates as $template) {
      $transaction = new Transaction();
      $transaction->user_id = Auth::id();
      $transaction->description = $template->description;
      $transaction->amount = $template->amount;
      $transaction->datetime = $yearMonth . date('-d H:i:s', strtotime($template->datetime));
      $transaction->category_id = $template->category_id;
      $transaction->save();
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $item = Transaction::find($id);
    return view('template.edit')->with('item', $item);
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
      'datetime' => 'required',
    ]);

    $transaction = Transaction::find($id);
    $transaction->description = $data['description'];
    $transaction->amount = $data['amount'];
    $transaction->datetime = $data['datetime'];
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
