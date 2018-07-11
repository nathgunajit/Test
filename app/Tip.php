<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $table = 'tips';
    protected $guarded = array();

    public function getData()
    {
        return static::orderBy('id', 'desc')->paginate(5);
    }

    public function AddData($input)
    {
        return static::create($input);
    }

    public function findData($id)
    {
        return static::find($id);
    }

    public function updateData($id, $input)
    {
        return static::where('id', $id)->update($input);
    }

    public function destroyData($id)
    {
        return static::where('id',$id)->delete();
    }
}