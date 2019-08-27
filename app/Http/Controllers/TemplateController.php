<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller {

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
    $data['income'] = $this->byCategory('income');
    $data['fixed'] = $this->byCategory(
      'utility',
      'insurance',
      'loan',
      'creditcard'
    );
    $data['variable'] = $this->byCategory('variable');

    return view('template')->with('data', $data);
  }

  private function byCategory() {
    $data = Template::where('user_id', Auth::id());
    $num = func_num_args();
    $args = func_get_args();
    for ($i = 0; $i < $num; $i++) {
      if ($i == 0) {
        $data = $data->where('category', $args[$i]);
      } else {
        $data = $data->orWhere('category', $args[$i]);
      }
    }
    $data->orderBy('datetime');
    return $data->get();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('template_form');
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

    $recurring = new Template();
    $recurring->user_id = Auth::id();
    $recurring->description = $data['description'];
    $recurring->category = $data['category'];
    $recurring->amount = $data['amount'];
    $recurring->datetime = $data['datetime'];
    $recurring->interval_days = $data['interval_days'];
    $recurring->save();

    return redirect('/template');
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
