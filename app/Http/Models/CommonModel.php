<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class CommonModel extends Model 
{    
    public function SelectData($table, $where, $select)
    {
       // DB::enableQueryLog();
        if(empty($where)){
         $selectdata = DB::table($table)->select($select)->get();
        }else{
         $selectdata = DB::table($table)->where($where)->select($select)->get();
        }
       // dd(DB::getQueryLog()); die; 
      return $selectdata;
    }
   
    public function checkCredentials($table, $condition){ 
        $countdata = DB::table($table)->where($condition)->count();
        
        if($countdata>=1){
            $selectdata = DB::table('admin_login as adl')
                            ->join('role_master as rlm', 'adl.role_id', '=', 'rlm.role_id')
                            ->where('adl.login_id', $condition['login_id'])
                            ->where('adl.password', $condition['password'])
                            ->select('adl.*', 'rlm.role_name')
                            ->get();
                    //print_r($selectdata); die;
            return $selectdata;
        }else{
            return false;
        }
    }
    
    public function InsertData($table, $Details)
    {
      $Add=DB::table($table)->insert($Details);
      return true;
    }
    
    public function OtpGet($table, $condition, $update_data){
        
        $selectdata = $this->getCount($table, $condition);
        
        if($selectdata>=1){
            $this->UpdateData($table, $condition, $update_data);
            return true;
        }else{
            return false;
        }
    }
    public function getCount($table, $condition){
       $count_data = DB::table($table)->where($condition)->count();
       return $count_data; 
    }
    
    public function getAllCount(){
        $status = array(1,2);
        $count_data = array();
        foreach($status as $val){
            if($val==1){
                $count_data['f_app'] =   $this->getCount('rti_detail', array('Status_id'=>1));
            }
            if($val==2){
                $count_data['new'] =   $this->getCount('rti_detail', array('Status_id'=>2));
            }
        }
        return $count_data;
    }

    public function deleteData($table, $condi){
        DB::table($table)->where($condi)->update(['Password'=>'']);
        return true;
    }
    
    public  function UpdateData($table, $where, $update_data){
        //DB::enableQueryLog();
          
      DB::table($table)
            ->where($where)
            ->update($update_data);
      //dd(DB::getQueryLog()); die; 
            return true;
    }
    
}
