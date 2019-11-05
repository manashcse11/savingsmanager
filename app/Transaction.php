<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'mature_date',  'deleted_at'];
    protected $table = 'savings_transactions';
    protected $appends = [
        'interest_before_tax'
        , 'interest_actual_amount'
        , 'total_amount'
        , 'dps_paid'
        , 'dps_due'
        , 'mature_after'
        , 'ar_mature_date'
        , 'ar_mature_after'
        , 'ar_interest_before_tax'
        , 'ar_interest_actual_amount'
        , 'ar_total_amount'
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
     * Scopes
     */
    public function scopeTransactionFilter($query, $filters, $prefix){
        foreach($filters as $field => $value){
            $field = $this->startsWithRemove( $field, $prefix );
            if($field && $value){
                $query->where($field, $value);
            }
        }
        return $query;
    }
    /**
     * User defined functions
     */
    public function get_transactions($type_id, $filters){
        return $this->where('type_id', $type_id)
        ->transactionFilter($filters, "filter_")
        ->with(['user', 'organization', 'status'])
        ->orderby('start_date')
        ->get();
    }

    public function startsWithRemove ($str, $prefix)
    {
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            return $str = substr($str, strlen($prefix));
        }
    }

    /**
     * Get the transaction's interest_before_tax
     *
     * @return string
     */
    public function getInterestBeforeTaxAttribute(){
        if($this->type->slug == "fdr"){
            return (($this->interest_rate * $this->amount) / 100) * $this->duration;
        }
        if($this->type->slug == "dps"){
            return (($this->interest_rate * $this->amount * 12 * $this->duration) / 100);
        }
    }

    /**
     * Get the transaction's interest_actual_amount
     *
     * @return string
     */
    public function getInterestActualAmountAttribute(){
        $tax = 10;
        return $this->interest_before_tax - ($this->interest_before_tax * $tax) / 100;
    }

    /**
     * Get the transaction's total_amount
     *
     * @return string
     */
     public function getTotalAmountAttribute(){
        if($this->type->slug == "fdr"){
            return $this->amount + $this->interest_actual_amount;
        }
        if($this->type->slug == "dps"){
            return $this->amount * 12 * $this->duration + $this->interest_actual_amount;
        }
    }

    /**
     * Get the transaction's dps_paid
     *
     * @return string
     */
     public function getDpsPaidAttribute(){
        $today = Carbon::now();
        $month_gone = $today->diffInMonths($this->start_date);
        return $this->amount * $month_gone;
    }

    /**
     * Get the transaction's dps_paid
     *
     * @return string
     */
     public function getDpsDueAttribute(){
        return ($this->amount * 12 * $this->duration) - $this->dps_paid;
    }

    /**
     * Get the transaction's mature_after
     *
     * @return string
     */
    public function getMatureAfterAttribute(){
        $today = Carbon::now();
        return $this->mature_date->diff($today)->format($this->date_difference_string_format());
    }

    /**
     * Get the transaction's ar_mature_date
     *
     * @return string
     */
     public function getArMatureDateAttribute(){
        return $this->mature_date->addYears($this->duration)->toFormattedDateString();
    }

    /**
     * Get the transaction's ar_mature_after
     *
     * @return string
     */
    public function getArMatureAfterAttribute(){
        $ar_mature_date = Carbon::parse($this->ar_mature_date);
        $today = Carbon::now();
        return $ar_mature_date->diff($today)->format($this->date_difference_string_format());
    }

    /**
     * Get the transaction's ar_interest_before_tax
     *
     * @return string
     */
     public function getArInterestBeforeTaxAttribute(){
        return $this->auto_renewal ? round((($this->interest_rate * $this->total_amount) / 100) * $this->duration) : "N/A";
    }

    /**
     * Get the transaction's ar_interest_actual_amount
     *
     * @return string
     */
     public function getArInterestActualAmountAttribute(){
        $tax = 10;
        return $this->auto_renewal ? $this->ar_interest_before_tax - ($this->ar_interest_before_tax * $tax) / 100 : "N/A";
    }

    /**
     * Get the transaction's ar_total_amount
     *
     * @return string
     */
     public function getArTotalAmountAttribute(){
        return $this->auto_renewal ? $this->total_amount + $this->ar_interest_actual_amount : "N/A";
    }

    public function date_difference_string_format(){
         return '%y ' . Str::plural('Year') . ' %m ' . Str::plural('Month') . ' %d ' . Str::plural('Day') . '';
    }
}
