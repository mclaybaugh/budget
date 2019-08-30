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
    return view('home');
  }

}
