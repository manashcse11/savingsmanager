<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Type;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction = new Transaction();
        $yearly_summary = $transaction->get_yearly_summary_report();
        $data['yearly_individual_bar'] = $this->yearlyIndividualBar($yearly_summary);
        $data['type_percentage_pie'] = $this->typePercentageCurrentYearPie($yearly_summary);
        return view('home', $data);
    }

    public function yearlyIndividualBar($records){
        if($records){
            $title = array("Year");
            $i = 0;
            foreach ($records as $yr_key => $yr_val) {
                $item = array($yr_key);
                foreach($yr_val['users'] as $tr){
                    if($i == 0){
                        array_push($title, strtok($tr['owner'], " "));
                    }
                    array_push($item, $tr['individual_total']);
                }
                if($i == 0){
                    $data[] = $title;
                }
                $data[] = $item;
                $i++;
            }
            return json_encode($data);
        }
    }

    public function typePercentageCurrentYearPie($records){
        if($records){
            $current_year = $records[Carbon::now()->format('Y')];
            $types = Type::orderby('name')->get();   
            $data[] = array("Type", "Amount");         
            $total = array();
            foreach($types as $type){
                $total[$type->slug] = 0;
            }
            foreach ($current_year['users'] as $list) {
                foreach($types as $type){
                    $total[$type->slug] += $list[$type->slug];
                }
            }
            foreach($total as $key => $val){                
                $data[] = array(strtoupper($key), $val);
            }
            return json_encode($data);
        }
    }
}
