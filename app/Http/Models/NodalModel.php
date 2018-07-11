<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class NodalModel extends Model 
{    
   
    public function getReqs($status){ 
       // DB::enableQueryLog();
        
            $selectdata = DB::table('rti_detail as rtd')
                            ->join('rti_master as rtm', 'rtd.Rti_Registration_No', '=', 'rtm.Rti_Registration_No')
                            ->where('rtd.Status_id', $status)
                            ->whereNull('rtd.Action_id')
                            ->select('rtd.*', 'rtm.*')
                            ->get();
            
            //dd(DB::getQueryLog()); die;
            return $selectdata;
        
    }
    
    public function getAssignedReqs($conditions){ 
    $comm_data = DB::table('rti_communication_log')->where($conditions)->select(array('Rti_registration_no', 'Reciever_id'))->distinct()->get();
    $selectdata = array();
    if(!empty($comm_data)){
        foreach($comm_data as $data_info){
          $selectdata[] = DB::table('rti_detail as rtd')
                          ->join('rti_master as rtm', 'rtd.Rti_Registration_No', '=', 'rtm.Rti_Registration_No')
                          ->where('rtd.Status_id', 2)
                          ->where('rtd.Assigned_authority', $data_info->Reciever_id)
                          ->where('rtd.Rti_registration_no', $data_info->Rti_registration_no)
                          ->where('rtd.Action_id', $conditions['Action_id'])
                          ->select('rtd.*', 'rtm.*')
                          ->get()->toArray();
              }

    }
    // dd(DB::getQueryLog()); die;
     return $selectdata;
    }
    
    public function getReqsByID($id){ 
          $selectdata = DB::table('rti_detail as rtd')
                            ->join('rti_master as rtm', 'rtd.Rti_Registration_No', '=', 'rtm.Rti_Registration_No')
                            ->where('rtd.Rti_Registration_No', $id)
                            ->select('rtd.*', 'rtm.*')
                            ->get();
          return $selectdata;
    }

    public function InsertData($table, $Details)
    {
      $Add=DB::table($table)->insert($Details);
      return true;
    }
}
