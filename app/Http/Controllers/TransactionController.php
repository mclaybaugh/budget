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
    return view('transaction');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('transaction_create');
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
    return view('transaction_generate');
  }

  public function run(Request $request) {
    $data = $request->validate([
      'datetime' => 'required',
    ]);
    $timestampMonth = strtotime($data('datetime'));

    $templates = Template::all();
    foreach ($templates as $template) {
      $transaction = new Transaction();
      $transaction->user_id = Auth::id();
      $transaction->description = $template->description;
      $transaction->amount = $template->amount;
      $transaction->datetime = self::dateInMonth(
        $timestampMonth,
        strtotime($template->datetime)
      );
      $transaction->category_id = $template->category_id;
      $transaction->save();
    }
  }

  static function dateInMonth($timestampMonth, $timestampDay) {
    return date('Y-m-', $timestampMonth) . date('d H:i:s', $timestampDay);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $item = Transaction::find($id);
    return view('template_edit')->with('item', $item);
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
