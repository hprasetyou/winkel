<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    protected $model;
    protected $tbName;
    public function __construct(){
        $objName = $this->decamelize(str_replace('Controller','',(new \ReflectionClass($this))->getShortName()));
        $this->tbName = \Illuminate\Support\Pluralizer::plural($objName,2);
        $this->model = 'App\\' . ucfirst($objName);
    }

    protected function prepareData(Request $request){
        $data = DB::table($this->tbName);
        return $data;
    }
    private function decamelize($string) {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
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
        $orderCol = $request->query('sortby')?$request->query('sortby'):'id';
        $orderDirection = $request->query('descending') == 'true'?'desc':'asc';
        $data = $this->prepareData($request)->orderBy($orderCol,$orderDirection)->paginate($perpage);
        return $data->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->prepareStoreData($request);
        $data->save();
        return $data->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Prepare data before submit
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    protected function prepareStoreData(Request $request, int $id = null){
        $data = json_decode($request->getContent(), true);
        if(!$id){
            $obj = new $this->model;
        }else{
            $obj = $this->model::findOrFail($id);
        }
        foreach ($data as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }

    protected function prepareShowData(Request $request, $id){
        return $this->model::find($id);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->prepareStoreData($request, (int)$id);
        $data->save();
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
