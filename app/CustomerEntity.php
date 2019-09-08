<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
