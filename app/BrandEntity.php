<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

  public function get_existing_brand_records($brand_id){
    $brand_records = DB::table('brand_entities')
            ->join('brands', 'brand_entities.brand_id', '=', 'brands.id')
            ->select('brand_entities.*', 'brands.name')
            ->where('brand_entities.brand_id', $brand_id)
            ->paginate(50);
    return $brand_records;
  }
}
