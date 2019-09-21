<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
    $brandRecords = Brand::leftJoin('brand_entities', function($join) {
        $join->on('brand_entities.brand_id', '=', 'brands.id')
             ->on('brand_entities.id', '=',
             DB::raw("(SELECT max(id) from brand_entities WHERE brand_entities.brand_id = brands.id)"));
        })->paginate(50);

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

  public function get_existing_brand_record($brand_id){
    $brand_information = DB::table('brands')
            ->join('brand_entities', 'brands.id', '=', 'brand_entities.brand_id')
            ->select('brands.id', 'brands.name', 'brand_entities.debit')
            ->where('brands.id', $brand_id)
            ->latest('brand_entities.id')
            ->first();
    return $brand_information;
  }

  public function get_brand_by_id($id){
    $brand = Brand::where('id', '=', $id)->first();
    return $brand;
  }
}
