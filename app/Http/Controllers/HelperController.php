<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Customer;

class HelperController extends Controller
{
  private $brandModel;
  private $customerModel;

  public function __construct(){
    $this->brandModel = new Brand();
    $this->customerModel = new Customer();
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
      $records = $this->brandModel->get_all_cement_brands();
      $html = view('record.section.sell.cement', compact('records'))->render();
    }
    if($section == 'sell-rod'){
      $records = $this->brandModel->get_all_rod_brands();
      $html = view('record.section.sell.rod', compact('records'))->render();
    }
    if($section == 'buy-cement'){
      $records = $this->brandModel->get_all_cement_brands();
      $html = view('record.section.buy.cement', compact('records'))->render();
    }
    if($section == 'buy-rod'){
      $records = $this->brandModel->get_all_rod_brands();
      $html = view('record.section.buy.rod', compact('records'))->render();
    }

    if($section == 'customer-cost'){
      $html = view('record.section.save-cost.customer-cost')->render();
    }

    if($section == 'customer-due'){
      $html = view('record.section.save-cost.customer-due-collection')->render();
    }

    if($section == 'company-cost'){
      $records = $this->brandModel->get_all_rod_brands();
      $html = view('record.section.save-cost.company-cost', compact('records'))->render();
    }

    if($section == 'company-due'){
      $records = $this->brandModel->get_all_rod_brands();
      $html = view('record.section.save-cost.company-due', compact('records'))->render();
    }

    if($section == 'bank-saving'){
      $html = view('record.section.save-cost.bank-saving')->render();
    }

    if($section == 'employee-salary'){
      $html = view('record.section.save-cost.employee-salary')->render();
    }

    if($section == 'other-cost'){
      $html = view('record.section.save-cost.other-cost')->render();
    }

    if($section == 'insert_customer_information'){
      $html = view('common-template.insert-user')->render();
    }

    return response()->json(['content'=> $html]);
  }

  public function render_existing_customer_template(Request $request){
    $user_id = $request->get('user_id');

    $customer_information = $this->customerModel->get_existing_customer_record($user_id);

    $html = view('common-template.existing-user')->with(['record' => $customer_information])->render();

    return response()->json(['content'=> $html]);
  }

  public function render_existing_brand_template(Request $request){
    $brand_id = $request->get('brand_id');

    $brand_information = $this->brandModel->get_existing_brand_record($brand_id);

    $html = view('common-template.existing-brand')->with(['record' => $brand_information])->render();

    return response()->json(['content'=> $html]);
  }
}
