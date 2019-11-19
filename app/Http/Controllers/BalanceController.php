<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Balance;

class BalanceController extends Controller {

  /**
   * Create a new controller instance.
   */
  public function __construct() {
    $this->middleware('auth');
    $this->middleware('verified');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $balances = Balance::where('user_id', Auth::id())
      ->get();

    $records = [];
    foreach ($balances as $balance) {
      $records[] = [
        'date' => date('Y-m-d', strtotime($balance->datetime)),
        'amount' => '$' . number_format($balance->amount),
        'edit_link' => route('balance.edit', $balance->id),
      ];
    }
    return view('balance.index')->with('records', $records);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('balance.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $data = $request->validate([
      'date' => 'required|max:100',
      'time' => 'required',
      'amount' => 'required',
    ]);

    $balance = new Balance();
    $balance->user_id = Auth::id();
    $balance->amount = $data['amount'];
    $balance->datetime = $data['date'] . ' ' . $data['time'] . ':00';
    $balance->save();

    return redirect(route('balance.index'));
  }

  // /**
  //  * Display the specified resource.
  //  *
  //  * @param  int  $id
  //  * @return \Illuminate\Http\Response
  //  */
  // public function show($id) {
  //   //
  // }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $item = Balance::find($id);
    $datetime = strtotime($item->datetime);
    $item->date = date('Y-m-d', $datetime);
    $item->time = date('H:i', $datetime);
    return view('balance.edit')->with('item', $item);
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
      'amount' => 'required',
      'date' => 'required',
      'time' => 'required',
    ]);

    $balance = Balance::find($id);
    $balance->amount = $data['amount'];
    $balance->datetime = $data['date'] . ' ' . $data['time'] . ':00';
    $balance->save();

    return redirect(route('balance.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $balance = Balance::find($id);
    $balance->delete();

    return redirect(route('balance.index'));
  }

}
