<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomerEntity;
use App\Brand;
use App\BrandEntity;
use App\DailyCost;
use App\BankSaving;
use App\Salary;

class RecordsController extends Controller
{
  private $customerModel;
  private $customerEntityModel;
  private $brandModel;
  private $brandEntityModel;
  private $dailyCostModel;
  private $bankSavingModel;
  private $salaryModel;

  public function __construct(){
    $this->customerModel = new Customer();
    $this->customerEntityModel = new CustomerEntity();
    $this->brandModel = new Brand();
    $this->brandEntityModel = new BrandEntity();
    $this->dailyCostModel = new DailyCost();
    $this->bankSavingModel = new BankSaving();
    $this->salaryModel = new Salary();
  }

  public function autocomplete(Request $request){
    $query = request()->get('query');

    $results = array();

    $queries = $this->customerModel->search_customer_records($query);

    // $html = view('common-template.autocomplete-item')->with(['records' => $queries])->render();

    return response()->json($queries);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('record.create');
  }

  public function create_sell_rod_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'payment_type' => 'required',
        'total_quantity' => 'required',
        'rate' => 'required',
        'price' => 'required',
    ]);

    $data = request()->all();

    $data = $this->validate_empty_field($data);

    $payment_type = $data['payment_type'];
    $check_new_customer = true;
    $source = 'rod';

    if(isset($data['current_user_id']) && !empty($data['current_user_id'])){
      $customer_id = $data['current_user_id'];
      $check_new_customer = false;
    } else {
      $customer_id = $this->process_customer_record_insertion($data);
    }

    $data = $this->process_customer_entity_data($check_new_customer, $source, $customer_id, $data);
    $customer_entity_id = $this->process_customer_entity_record_insertion($data);
    $customer_payment_entity_id = $this->process_customer_payment_entity_record_insertion($payment_type, $data);

    return response()->json(['success'=> 'true']);
  }

  public function create_sell_cement_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'payment_type' => 'required',
        'total_quantity' => 'required',
        'rate' => 'required',
        'price' => 'required',
    ]);

    $data = request()->all();

    $data = $this->validate_empty_field($data);

    $payment_type = $data['payment_type'];
    $check_new_customer = true;
    $source = 'cement';

    if(isset($data['current_user_id']) && !empty($data['current_user_id'])){
      $customer_id = $data['current_user_id'];
      $check_new_customer = false;
    } else {
      $customer_id = $this->process_customer_record_insertion($data);
    }
    // $data['customer_id'] = $customer_id;
    // $data['total_price'] = $this->total_price($data['total_quantity'], $data['rate']);
    // $data['source'] = 'cement';
    //
    // $payment_type = $data['payment_type'];
    // $data['payment_type'] = '';
    //
    // $data = $this->calculate_new_entity_credit_debit($data);
    //
    // $entity_id = $this->customerEntityModel->insert_customer_entity_record($data);
    $data = $this->process_customer_entity_data($check_new_customer, $source, $customer_id, $data);
    $customer_entity_id = $this->process_customer_entity_record_insertion($data);
    $customer_payment_entity_id = $this->process_customer_payment_entity_record_insertion($payment_type, $data);
    // $payment_data = $this->process_customer_payment_entity_data($payment_type, $data);
    // $payment_entity_id = $this->customerEntityModel->insert_customer_payment_entity_record($payment_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_customer_record_insertion($data){
    $customer_id = $this->customerModel->insert_customer_record($data);
    return $customer_id;
  }

  private function process_customer_entity_record_insertion($data){
    // $data['customer_id'] = $customer_id;
    // $data['total_price'] = $this->total_price($data['total_quantity'], $data['rate']);
    // $data['source'] = 'cement';
    //
    // $payment_type = $data['payment_type'];
    // $data['payment_type'] = '';
    //
    // $data = $this->calculate_new_entity_credit_debit($data);

    // $data = $this->process_customer_entity_data($customer_id, $data);
    $entity_id = $this->customerEntityModel->insert_customer_entity_record($data);

    return $entity_id;
  }

  private function validate_empty_field($data){
    $data['mobile'] = isset($data['mobile']) ? $data['mobile'] : '';
    $data['address'] = isset($data['address']) ? $data['address'] : '';
    $data['national_id'] = isset($data['national_id']) ? $data['national_id'] : '';
    $data['bank_name'] = isset($data['bank_name']) ? $data['bank_name'] : '';
    $data['bank_account_no'] = isset($data['bank_account_no']) ? $data['bank_account_no'] : '';

    return $data;
  }

  private function process_customer_payment_entity_record_insertion($payment_type, $data){
    $payment_data = $this->process_customer_payment_entity_data($payment_type, $data);
    $payment_entity_id = $this->customerEntityModel->insert_customer_payment_entity_record($payment_data);

    return $payment_entity_id;
  }

  private function process_customer_entity_data($check_new_customer, $source, $customer_id, $data){
    $data['customer_id'] = $customer_id;
    $data['total_price'] = $this->total_price($data['total_quantity'], $data['rate']);
    $data['source'] = $source;
    $data['payment_type'] = '';

    if($check_new_customer)
      $data = $this->calculate_new_entity_credit_debit($data);
    else
      $data = $this->calculate_existing_user_credit_debit($customer_id, $data);

    return $data;
  }

  private function process_customer_payment_entity_data($payment_type, $data){
    $payment_data = array();

    $payment_data['customer_id'] = $data['customer_id'];
    $payment_data['payment_type'] = $payment_type;
    $payment_data['credit'] = $data['price'];
    $payment_data['debit'] = $data['debit'] - $data['price'];

    return $payment_data;
  }

  private function total_price($total_quantity, $rate){
    return $total_quantity * $rate;
  }

  private function total_price_excluding_commission($total_quantity, $rate, $commission){
    $new_rate = $rate - $commission;
    return $total_quantity * $new_rate;
  }

  private function calculate_new_entity_credit_debit($data){
    $data['credit'] = $data['total_price'];
    $data['debit'] = $data['credit'];

    return $data;
  }

  private function calculate_existing_user_credit_debit($customer_id, $data){
    $customer_information = $this->customerModel->get_existing_customer_record($customer_id);

    $data['credit'] = $data['total_price'];
    $data['debit'] = intval($data['credit']) + intval($customer_information->debit);

    return $data;
  }


  public function create_buy_cement_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'due_no' => 'required',
        'commission' => 'required',
        'payment_type' => 'required',
        'total_quantity' => 'required',
        'rate' => 'required',
        'price' => 'required',
    ]);

    $data = request()->all();

    $payment_type = $data['payment_type'];
    $source = 'cement';

    $data = $this->process_brand_entity_data($source, $data);
    $brand_entity_id = $this->process_brand_entity_record_insertion($data);
    $brand_payment_entity_id = $this->process_brand_payment_entity_record_insertion($payment_type, $data);

    return response()->json(['success'=> 'true']);
  }

  public function create_buy_rod_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'due_no' => 'required',
        'commission' => 'required',
        'payment_type' => 'required',
        'total_quantity' => 'required',
        'rate' => 'required',
        'price' => 'required',
    ]);

    $data = request()->all();

    $payment_type = $data['payment_type'];
    $source = 'rod';

    $data = $this->process_brand_entity_data($source, $data);
    $brand_entity_id = $this->process_brand_entity_record_insertion($data);
    $brand_payment_entity_id = $this->process_brand_payment_entity_record_insertion($payment_type, $data);

    return response()->json(['success'=> 'true']);
  }

  private function process_brand_entity_data($source, $data){
    $data['total_price'] = $this->total_price_excluding_commission($data['total_quantity'], $data['rate'], $data['commission']);
    $data['source'] = $source;
    $data['payment_type'] = '';

    $data = $this->calculate_brand_credit_debit($data);

    return $data;
  }

  private function calculate_brand_credit_debit($data){
    $brand_information = $this->brandModel->get_existing_brand_record($data['brand']);

    $data['credit'] = $data['total_price'];

    if($brand_information === null)
      $data['debit'] = $data['credit'];
    else
      $data['debit'] = intval($data['credit']) + intval($brand_information->debit);

    return $data;
  }

  private function process_brand_entity_record_insertion($data){
    $entity_id = $this->brandEntityModel->insert_brand_entity_record($data);

    return $entity_id;
  }

  private function process_brand_payment_entity_record_insertion($payment_type, $data){
    $payment_data = $this->process_brand_payment_entity_data($payment_type, $data);
    $payment_entity_id = $this->brandEntityModel->insert_brand_payment_entity_record($payment_data);

    return $payment_entity_id;
  }

  private function process_brand_payment_entity_data($payment_type, $data){
    $payment_data = array();

    $payment_data['brand_id'] = $data['brand'];
    $payment_data['payment_type'] = $payment_type;
    $payment_data['credit'] = $data['price'];
    $payment_data['debit'] = $data['debit'] - $data['price'];

    return $payment_data;
  }

  public function create_customer_cost_entities(Request $request){
    $validatedData = $request->validate([
        'payment_type' => 'required',
        'amount' => 'required',
        'current_user_id' => 'required'
    ]);

    $data = request()->all();

    $cost_data = $this->process_customer_cost_payment_entity_data($data);

    $payment_entity_id = $this->customerEntityModel->insert_customer_payment_entity_record($cost_data);

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($cost_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_customer_cost_payment_entity_data($data){
    $customer_information = $this->customerModel->get_existing_customer_record($data['current_user_id']);

    $payment_data = array();

    $payment_data['customer_id'] = $data['current_user_id'];
    $payment_data['payment_type'] = $data['payment_type'];
    $payment_data['cost_type'] = $data['payment_type'];
    $payment_data['amount'] = $data['amount'];
    $payment_data['credit'] = $data['amount'];
    $payment_data['debit'] = intval($data['amount']) + intval($customer_information->debit);

    return $payment_data;
  }

  public function create_customer_due_collection_entities(Request $request){
    $validatedData = $request->validate([
        'payment_type' => 'required',
        'amount' => 'required',
        'current_user_id' => 'required'
    ]);

    $data = request()->all();

    $cost_data = $this->process_customer_due_collection_payment_entity_data($data);

    $payment_entity_id = $this->customerEntityModel->insert_customer_payment_entity_record($cost_data);

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($cost_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_customer_due_collection_payment_entity_data($data){
    $customer_information = $this->customerModel->get_existing_customer_record($data['current_user_id']);

    $payment_data = array();

    $payment_data['customer_id'] = $data['current_user_id'];
    $payment_data['payment_type'] = $data['payment_type'];
    $payment_data['cost_type'] = $data['payment_type'];
    $payment_data['amount'] = $data['amount'];
    $payment_data['credit'] = $data['amount'];
    $payment_data['debit'] = intval($customer_information->debit) - intval($data['amount']);

    return $payment_data;
  }

  public function create_company_cost_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'payment_type' => 'required',
        'amount' => 'required',
    ]);

    $data = request()->all();

    $cost_data = $this->process_company_cost_payment_entity_data($data);

    $payment_entity_id = $this->brandEntityModel->insert_brand_payment_entity_record($cost_data);

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($cost_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_company_cost_payment_entity_data($data){
    $brand_information = $this->brandModel->get_existing_brand_record($data['brand']);

    $payment_data = array();

    $payment_data['brand_id'] = $data['brand'];
    $payment_data['payment_type'] = $data['payment_type'];
    $payment_data['cost_type'] = $data['payment_type'];
    $payment_data['amount'] = $data['amount'];
    $payment_data['credit'] = $data['amount'];
    $payment_data['debit'] = intval($brand_information->debit) - intval($data['amount']);

    return $payment_data;
  }

  public function create_company_due_entities(Request $request){
    $validatedData = $request->validate([
        'brand' => 'required',
        'payment_type' => 'required',
        'amount' => 'required'
    ]);

    $data = request()->all();

    $cost_data = $this->process_company_due_payment_entity_data($data);

    $payment_entity_id = $this->brandEntityModel->insert_brand_payment_entity_record($cost_data);

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($cost_data);

    return response()->json(['success'=> 'true']);
  }

  private function process_company_due_payment_entity_data($data){
    $brand_information = $this->brandModel->get_existing_brand_record($data['brand']);

    $payment_data = array();

    $payment_data['brand_id'] = $data['brand'];
    $payment_data['payment_type'] = $data['payment_type'];
    $payment_data['cost_type'] = $data['payment_type'];
    $payment_data['amount'] = $data['amount'];
    $payment_data['credit'] = $data['amount'];
    $payment_data['debit'] = intval($brand_information->debit) - intval($data['amount']);

    return $payment_data;
  }

  public function create_bank_saving_entities(Request $request){
    $validatedData = $request->validate([
        'bank_account_number' => 'required',
        'amount' => 'required'
    ]);

    $data = request()->all();

    $id = $this->bankSavingModel->insert_bank_saving_record($data);

    return response()->json(['success'=> 'true']);
  }

  public function create_employee_salary_entities(Request $request){
    $validatedData = $request->validate([
        'name' => 'required',
        'amount' => 'required'
    ]);

    $data = request()->all();

    $id = $this->salaryModel->insert_salary_record($data);

    $data['cost_type'] = $data['comment'];

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($data);

    return response()->json(['success'=> 'true']);
  }

  public function create_other_cost_entities(Request $request){
    $validatedData = $request->validate([
        'amount' => 'required',
        'payment_type' => 'required'
    ]);

    $data = request()->all();

    $data['cost_type'] = $data['payment_type'];

    $daily_cost_id = $this->dailyCostModel->insert_daily_cost_record($data);

    return response()->json(['success'=> 'true']);
  }

}
