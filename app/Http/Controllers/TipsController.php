<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tip;

class TipsController extends HomeController
{
    public function __construct()
    {
        parent::__construct();

        $this->Tip = new Tip;

        $this->moduleTitleS = 'Tips';
        $this->moduleTitleP = 'Tips';

        view()->share('moduleTitleP',$this->moduleTitleP);
        view()->share('moduleTitleS',$this->moduleTitleS);
    }
    
    public function index()
    {
        $data = $this->Tip->getData();
        
        return view($this->moduleTitleP.'.index',compact('data'))
                         ->with('i',0);
    }
    
    public function create()
    {
        return view($this->moduleTitleP.'.create');
    }
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'tips' => 'required',
        ]);

        $input = array_except($request->all(),array('_token'));

        $this->Tip->AddData($input);

        \Session::put('success','Tip Store Successfully!!');

        return redirect()->route('tips.index');
    }

    public function edit($id)
    {
        $data = $this->Tip->findData($id);

        return view($this->moduleTitleP.'.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'tips' => 'required',
        ]);

        $input = array_except($request->all(),array('_token', '_method'));

        $this->Tip->updateData($id, $input);

        \Session::put('success','Tip Updated Successfully!!');

        return redirect()->route('tips.index');
    }
    
    public function destroy($id)
    {
        $this->Tip->destroyData($id);

        \Session::put('success','Post Delete Successfully!!');

        return redirect()->route('tips.index');
    }
}	