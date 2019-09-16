<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'salaries';

  protected $fillable = ['name', 'amount', 'comment'];

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
  public function insert_salary_record($data){
    $salary = new Salary([
      'name' => $data['name'],
      'amount' => $data['amount'],
      'comment' => $data['comment']
    ]);

    $salary->save();

    return $salary->id;
  }
}
