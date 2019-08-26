<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recurring;

class RecurringController extends Controller {

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
    $recurring = Recurring::all();
    return view('recurring')->with($recurring);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('recurring_form');
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
      'category' => 'required',
      'amount' => 'required',
      'datetime' => 'required',
      'interval_days' => 'required',
    ]);

    $recurring = new Recurring($data);
    $recurring->description = $data['description'];
    $recurring->category = $data['category'];
    $recurring->amount = $data['amount'];
    $recurring->datetime = $data['datetime'];
    $recurring->save();

    return redirect('/');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
      //
  }

}
