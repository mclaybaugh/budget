<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Template;
use App\TransactionRow;
use App\Category;

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
    $queries = [];
    $cats = Category::all();
    foreach ($cats as $cat) {
      $queries[$cat->name] = Template::where('user_id', Auth::id())
        ->where('category_id', $cat->id)
        ->orderBy('datetime')->get();
    }

    // Process data for view.
    foreach ($queries as $cat => $results) {
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
      }
    }

    return view('template')->with('data', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $cats = $this->categoryArray();
    return view('template_create')->with('categories', $cats);
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

    $template = new Template();
    $template->user_id = Auth::id();
    $template->description = $data['description'];
    $template->amount = $data['amount'];
    $template->datetime = $data['datetime'];
    $template->category_id = $data['category_id'];
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
    $cats = $this->categoryArray();
    return view('template_edit')
      ->with('item', $item)
      ->with('categories', $cats);
  }

  private function categoryArray() {
    $records = Category::all();
    $cats = [];
    foreach ($records as $cat) {
      $cats[$cat->id] = $cat->name;
    }
    return $cats;
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

    $template = Template::find($id);
    $template->description = $data['description'];
    $template->category_id = $data['category_id'];
    $template->amount = $data['amount'];
    $template->datetime = $data['datetime'];
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
