<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerEntity;

class RecordsController extends Controller
{
  private $customerModel;
  private $customerEntityModel;

  public function __construct(){
    $this->customerModel = new Customer();
    $this->customerEntityModel = new CustomerEntity();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('record.create');
  }

  public function create_sell_cement_entities(Request $request){
    $data = request()->all();
    $customer_id = $this->customerModel->insert_customer_record($data);
    $data['customer_id'] = $customer_id;
    $data['total_price'] = $this->total_price($data['total_quantity'], $data['rate']);
    $data['source'] = 'cement';

    $payment_type = $data['payment_type'];
    $data['payment_type'] = '';

    $data = $this->calculate_new_user_credit_debit($data);

    $entity_id = $this->customerEntityModel->insert_customer_entity_record($data);
    $payment_data = $this->process_payment_entity_data($payment_type, $data);
    $payment_entity_id = $this->customerEntityModel->insert_customer_payment_entity_record($payment_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_payment_entity_data($payment_type, $data){
    $payment_data['customer_id'] = $data['customer_id'];
    $payment_data['payment_type'] = $payment_type;
    $payment_data['credit'] = $data['price'];
    $payment_data['debit'] = $data['debit'] - $data['price'];

    return $payment_data;
  }

  private function total_price($total_quantity, $rate){
    return $total_quantity * $rate;
  }

  private function calculate_new_user_credit_debit($data){
    $data['credit'] = $data['total_price'];
    $data['debit'] = $data['credit'];

    return $data;
  }
}
