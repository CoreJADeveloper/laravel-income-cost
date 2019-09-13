<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandEntity extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'brand_entities';

  protected $fillable = ['brand_id', 'due_no', 'total_quantity', 'rate', 'price',
                        'payment_type', 'total_price', 'commission', 'source', 'ms_rod',
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
  public function insert_brand_entity_record($data){
    $brandEntity = new BrandEntity([
      'brand_id' => $data['brand'],
      'due_no' => $data['due_no'],
      'total_quantity' => $data['total_quantity'],
      'rate' => $data['rate'],
      'price' => $data['price'],
      'payment_type' => $data['payment_type'],
      'total_price' => $data['total_price'],
      'commission' => $data['commission'],
      'source' => $data['source'],
      'credit' => $data['credit'],
      'debit' => $data['debit']
    ]);

    $brandEntity->save();

    return $brandEntity->id;
  }

  /**
   * Get all brands from storage.
   *
   * @param Array
   *
   */
  public function insert_brand_payment_entity_record($data){
    $brandEntity = new BrandEntity([
      'brand_id' => $data['brand_id'],
      'payment_type' => $data['payment_type'],
      'credit' => $data['credit'],
      'debit' => $data['debit']
    ]);

    $brandEntity->save();

    return $brandEntity->id;
  }
}
