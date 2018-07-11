<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Pio_model extends Model 
{    
   
    public function getPIOReqs($condition){ 
    //echo "<pre>"; print_r($condition); die;
        //DB::enableQueryLog();
        
            $selectdata = DB::table('rti_detail as rtd')
                            ->join('rti_master as rtm', 'rtd.Rti_Registration_No', '=', 'rtm.Rti_Registration_No')
                            ->where('rtd.Status_id', $condition['Status_id'])
                            ->where('rtd.Assigned_authority', $condition['Assigned_authority'])
                            ->select('rtd.*', 'rtm.*')
                            ->get();
            
           // dd(DB::getQueryLog()); die;
           // print_r($selectdata); die;
            return $selectdata;
        
    }
  
}
