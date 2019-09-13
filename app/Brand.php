<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'brands';

  protected $fillable = ['name', 'type', 'active'];

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
   * Get all cement brands from storage.
   *
   * @return Mixed
   */
  public function get_all_cement_brands(){
    $brandRecords = Brand::where('type', 'cement')->get();

    return $brandRecords;
  }

  /**
   * Get all rod brands from storage.
   *
   * @return Mixed
   */
  public function get_all_rod_brands(){
    $brandRecords = Brand::where('type', 'rod')->get();

    return $brandRecords;
  }

  /**
   * Get all brands from storage.
   *
   * @return Mixed
   */
  public function get_all_brands(){
    $brandRecords = Brand::all();

    return $brandRecords;
  }

  /**
   * Get all brands from storage.
   *
   * @param Array
   *
   */
  public function insert_brand_record($data){
    $brand = new Brand([
        'name' => $data['company_name'],
        'type' => $data['company_type'],
        'active' => $data['active']
    ]);

    $brand->save();
  }
}
