<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'savings_transactions';
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
    public function get_transactions_by_type($type_id){
        return $this->where('type_id', $type_id)
        ->with(['user', 'organization', 'status'])
        ->orderby('start_date')
        ->get();
    }
}
