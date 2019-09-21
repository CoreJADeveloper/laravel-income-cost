<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CustomerEntity extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'customer_entities';

  protected $fillable = ['customer_id', 'total_quantity', 'rate', 'price', 'ms_rod',
                        'payment_type', 'total_price', 'commission', 'source',
                        'comment', 'credit', 'debit'];

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
  public function insert_customer_entity_record($data){
    $customerEntity = new CustomerEntity([
      'customer_id' => $data['customer_id'],
      'total_quantity' => $data['total_quantity'],
      'rate' => $data['rate'],
      'price' => $data['price'],
      'payment_type' => $data['payment_type'],
      'total_price' => $data['total_price'],
      'source' => $data['source'],
      'credit' => $data['credit'],
      'debit' => $data['debit']
    ]);

    $customerEntity->save();

    return $customerEntity->id;
  }

  /**
   * Get all brands from storage.
   *
   * @param Array
   *
   */
  public function insert_customer_payment_entity_record($data){
    $customerEntity = new CustomerEntity([
      'customer_id' => $data['customer_id'],
      'payment_type' => $data['payment_type'],
      'credit' => $data['credit'],
      'debit' => $data['debit']
    ]);

    $customerEntity->save();

    return $customerEntity->id;
  }

  public function get_existing_customer_records($customer_id){
    $customer_records = DB::table('customer_entities')
            ->join('customers', 'customer_entities.customer_id', '=', 'customers.id')
            ->select('customer_entities.*', 'customers.name',
            'customers.mobile', 'customers.address')
            ->where('customer_entities.customer_id', $customer_id)
            ->paginate(50);
    return $customer_records;
  }
}
