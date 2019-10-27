<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'savings_transactions';
    protected $appends = [
        'interest_before_tax'
        , 'interest_actual_amount'
        , 'total_amount'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'type_id', 'organization_id', 'amount', 'start_date', 'mature_date', 'duration', 'status_id'];
    /**
     * Relationships
     */
    
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function type(){
        return $this->hasOne('App\Type', 'id', 'type_id');
    }

    public function organization(){
        return $this->hasOne('App\Organization', 'id', 'organization_id');
    }

    public function status(){
        return $this->hasOne('App\Status', 'id', 'status_id');
    }
    /**
     * User defined functions
     */
    public function get_transactions_by_type($type_id){
        return $this->where('type_id', $type_id)
        ->with(['user', 'organization', 'status'])
        ->orderby('start_date')
        ->get();
    }
    /**
     * Get the transaction's interest_before_tax
     *
     * @param  string  $value
     * @return string
     */
    public function getInterestBeforeTaxAttribute(){
        return (($this->interest_rate * $this->amount) / 100) * $this->duration;
    }

    /**
     * Get the transaction's interest_actual_amount
     *
     * @param  string  $value
     * @return string
     */
    public function getInterestActualAmountAttribute(){
        $tax = 10;
        return $this->interest_before_tax - ($this->interest_before_tax * $tax) / 100;
    }

    /**
     * Get the transaction's total_amount
     *
     * @param  string  $value
     * @return string
     */
     public function getTotalAmountAttribute(){
        return $this->amount + $this->interest_actual_amount;
    }
}
