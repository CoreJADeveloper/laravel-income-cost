<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'customers';

  protected $fillable = ['name', 'mobile', 'national_id', 'address', 'bank_name', 'bank_account_no'];

  /**
   * The primary key associated with the table.
   *
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = true;

  /**
   * Get all brands from storage.
   *
   * @param Array
   *
   */
  public function insert_customer_record($data){
    $customer = new Customer([
        'name' => $data['customer_name'],
        'mobile' => $data['mobile'],
        'national_id' => $data['national_id'],
        'address' => $data['address'],
        'bank_name' => $data['bank_name'],
        'bank_account_number' => $data['bank_account_no'],
    ]);

    $customer->save();

    return $customer->id;
  }

  public function search_customer_records($query){
    $queries = DB::table('customers')
            ->select('id as value', 'name as label', 'mobile', 'address')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->take(20)->get()->toArray();
    return $queries;
  }

  public function get_existing_customer_record($customer_id){
    $customer_information = DB::table('customers')
            ->join('customer_entities', 'customers.id', '=', 'customer_entities.customer_id')
            ->select('customers.id', 'customers.name', 'customers.mobile',
            'customers.national_id', 'customers.address', 'customer_entities.debit')
            ->where('customers.id', $customer_id)
            ->latest('customer_entities.id')
            ->first();
    return $customer_information;
  }
}
