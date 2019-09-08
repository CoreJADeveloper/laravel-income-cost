<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
