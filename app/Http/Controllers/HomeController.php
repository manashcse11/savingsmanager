<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

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
        $data['yearly_individual_bar'] = $this->yearlyIndividualBar($transaction->get_yearly_summary_report());
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
}
