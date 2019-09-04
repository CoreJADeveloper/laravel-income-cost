<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
  /**
   *
   *
   * @return \Illuminate\Http\Response
   */
  public function render_custom_template(Request $request) {
    $section = $request->get('section');

    if($section == 'sell'){
      $html = view('record.section.sell.sell', compact('user'))->render();
    }
    if($section == 'buy'){
      $html = view('record.section.buy.buy', compact('user'))->render();
    }
    if($section == 'save-cost'){
      $html = view('record.section.save-cost.save-cost', compact('user'))->render();
    }

    return response()->json(['content'=> $html]);
  }
}
