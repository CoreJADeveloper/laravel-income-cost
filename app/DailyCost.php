<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyCost extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'daily_costs';

  protected $fillable = ['cost_type', 'amount', 'comment', 'entity_id'];

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
  public function insert_daily_cost_record($data){
    if(isset($data['comment'])){
      $dailyCost = new DailyCost([
        'cost_type' => $data['cost_type'],
        'amount' => $data['amount'],
        'comment' => $data['comment']
      ]);
    } else {
      $dailyCost = new DailyCost([
        'cost_type' => $data['cost_type'],
        'amount' => $data['amount']
      ]);
    }

    $dailyCost->save();

    return $dailyCost->id;
  }
}
