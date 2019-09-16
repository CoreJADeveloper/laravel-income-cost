<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSaving extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'bank_savings';

  protected $fillable = ['bank_account_number', 'amount', 'comment'];

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
  public function insert_bank_saving_record($data){
    $bankSaving = new BankSaving([
      'bank_account_number' => $data['bank_account_number'],
      'amount' => $data['amount'],
      'comment' => $data['comment']
    ]);

    $bankSaving->save();

    return $bankSaving->id;
  }
}
