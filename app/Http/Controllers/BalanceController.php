<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;

class BalanceController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $balances = Balance::all();
    $rows = [];
    foreach ($balances as $balance) {
      $rows[] = [
        'date' => $balance->date,
        'amount' => $balance->amount,
      ];
    }
    return view('balance')->with('rows', $rows);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('balance_create');
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
    return view('balance_edit')->with('item', $item);
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
