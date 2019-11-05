<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Schema;

class ResourceController extends Controller
{
    protected $model;
    protected $tbName;
    protected $with;

    public function __construct(){
        $objName = $this->decamelize(str_replace('Controller','',(new \ReflectionClass($this))->getShortName()));
        $this->tbName = \Illuminate\Support\Pluralizer::plural($objName,2);
        $this->model = 'App\\' . str_replace('_', '', ucwords($objName, '_'));
    }

    final protected function getColumns(){
        return Schema::getColumnListing($this->tbName);
    }

    protected function prepareData(Request $request){
        $data = DB::table($this->tbName);
        if($this->with){
            $data = $this->model::with($this->with);
        }
        return $data;
    }
    private function decamelize($string) {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }

    protected function search($data,$q){
        return $data->where('name', 'like', '%'. $q .'%');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $perpage = $request->query('perpage')?$request->query('perpage'):15;
        $orderCol = $request->query('sortby')?$request->query('sortby')[0]:'id';
        $orderDirection = $request->query('sortDesc')[0] == 'true'?'desc':'asc';
        $data = $this->prepareData($request);
        if($request->query('q')){
            $data = $this->search($data,$request->query('q'));
        }else{
            $data = $this->filterData($request, $data);
        }
        $data = $data->orderBy($orderCol,$orderDirection)->paginate($perpage);
        return $data->toJson(JSON_PRETTY_PRINT);
    }

    protected function filterData(Request  $request, $data){
        $columns = $this->getColumns();
        $filter = $request->query('filter');
        $filterValue = $request->query('filterValue');
        $filterOperator = $request->query('filterOperator');
        if($request->query('filter')){
            foreach ($filter as $key => $col) {
                if(in_array($col,$columns)){
                    $q = $filterValue[$key];
                    $operator = $filterOperator[$key];
                    if($operator == 'like'){
                        $q = '%'. $q .'%';
                    }
                    $data = $data->where($col, $operator, $q);
                }elseif(in_array($col,$this->with)){
                    $q = $filterValue[$key];
                    $operator = $filterOperator[$key];
                    if($operator == 'like'){
                        $q = '%'. $q .'%';
                    }
                    $data = $data->whereHas($col, function ($query) use ($operator, $q){
                        $query->where('name', $operator, $q);
                    });
                }
            }
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->save($request);
        return $this->show($request, $data->id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->save($request, (int)$id);
        return $this->show($request, $data->id);
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function save(Request $request, $id = null)
    {
        $data = $this->prepareStoreData($request, $id);
        $data->save();
        return $data;
    }  

    /**
     * Prepare data before submit
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    protected function prepareStoreData(Request $request, int $id = null){
        $data = json_decode($request->getContent(), true);
        $columns = $this->getColumns();
        if(!$id){
            $obj = new $this->model;
        }else{
            $obj = $this->model::findOrFail($id);
        }
        foreach ($data as $key => $value) {
            if(in_array($key,$columns)){
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    protected function prepareShowData(Request $request, $id){
        $data = $this->model;
        if($this->with){
            $data = $data::with($this->with);
        }
        return $data::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = $this->prepareShowData($request, $id);
        return $data->toJson(JSON_PRETTY_PRINT);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return response()
        ->json(['affectedRows'=>$id]);
    }
}
