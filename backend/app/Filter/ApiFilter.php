<?php

namespace App\Filter;

use Illuminate\Http\Request;
class ApiFilter {
    protected $safeParms = [];
    protected $columnMap = [];
    protected $operatorMap = [];

    public function transform(Request $request, $query){
        // $eloQuery = [];
        foreach($this->safeParms as $parm => $operators){
            $queryParm = $request->query($parm);
            
            if(isset($queryParm)){
                $column = $this->columnMap[$parm] ?? $parm;
            
                foreach($operators as $operator){
                    if(isset($queryParm[$operator])){
                        if($operator === 'like')
                            $query->where($column, 'LIKE', '%'.$queryParm[$operator].'%');
                        elseif($operator === 'in'){
                            $values = explode(',', $queryParm[$operator]);
                            $query->whereIn($column, $values);
                        }
                        else{
                            $query->where($column, $this->operatorMap[$operator], $queryParm[$operator]);
                        }
                    }
                }
            }
        }

        return $query;
    }
}
?>