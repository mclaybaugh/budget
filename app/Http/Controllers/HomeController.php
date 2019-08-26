<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recurring;

class HomeController extends Controller {

  /**
   * Create a new controller instance.
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   *   Homepage.
   */
  public function index() {
    // $cats = [
    //   'income',
    //   'utilities',
    //   'loans',
    //   'creditcards',
    //   'variable',
    // ];
    // foreach ($cats as $cat) {
    //   $recurring[$cat] = byCategory($cat);
    // }
    // return view('home')->with($recurring);
    return view('home');
  }

  private function byCategory($cat) {
    return Recurring::where('user_id', Auth::id())
      ->where('category', $cat)
      ->orderBy('datetime');
  }

}
