<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class HelperController extends Controller
{
  private $brandModel;

  public function __construct(){
    $this->brandModel = new Brand();
  }

  /**
   *
   *
   * @return \Illuminate\Http\Response
   */
  public function render_custom_template(Request $request) {
    $section = $request->get('section');

    if($section == 'sell'){
      $html = view('record.section.sell.sell')->render();
    }
    if($section == 'buy'){
      $html = view('record.section.buy.buy')->render();
    }
    if($section == 'save-cost'){
      $html = view('record.section.save-cost.save-cost')->render();
    }
    if($section == 'sell-cement'){
      $records = $this->brandModel->get_all_brands();
      $html = view('record.section.sell.cement', compact('records'))->render();
    }

    if($section == 'insert_customer_information'){
      $html = view('common-template.insert-user')->render();
    }

    return response()->json(['content'=> $html]);
  }
}
