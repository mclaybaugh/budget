<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Template;
use App\TransactionRow;

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
    // Get data from mysql.
    $query['income'] = $this->byCategory('income');
    $query['fixed'] = $this->byCategory(
      'utility',
      'insurance',
      'loan',
      'creditcard'
    );
    $query['variable'] = $this->byCategory('variable');

    // Process data for view.
    foreach ($query as $cat => $results) {
      $data[$cat] = [];
      foreach ($results as $record) {
        $timestamp = strtotime($record->datetime);
        $row = new TransactionRow(
          $record->description,
          $timestamp,
          $record->amount,
          route('template.edit', $record->id)
        );
        $data[$cat][] = $row;

        $interval = $record->interval_days;
        if ($interval > 0) {
          $newDate = $timestamp + $interval * 24 * 3600;
          while (date('m', $newDate) === date('m', $timestamp)) {
            $newRow = new TransactionRow(
              $record->description,
              $newDate,
              $record->amount,
              $row->edit_link
            );
            $data[$cat][] = $newRow;
            $newDate = $newDate + $interval * 24 * 3600;
          }
        }
      }
    }

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
    return view('template_create');
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

    $template = new Template();
    $template->user_id = Auth::id();
    $template->description = $data['description'];
    $template->category = $data['category'];
    $template->amount = $data['amount'];
    $template->datetime = $data['datetime'];
    $template->interval_days = $data['interval_days'];
    $template->save();

    return redirect(route('template.index'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $item = Template::find($id);
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
      'category' => 'required',
      'amount' => 'required',
      'datetime' => 'required',
      'interval_days' => 'required',
    ]);

    $template = Template::find($id);
    $template->description = $data['description'];
    $template->category = $data['category'];
    $template->amount = $data['amount'];
    $template->datetime = $data['datetime'];
    $template->interval_days = $data['interval_days'];
    $template->save();

    return redirect(route('template.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $template = Template::find($id);
    $template->delete();

    return redirect(route('template.index'));
  }

}
