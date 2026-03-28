<?php
namespace App\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;

class AllColumnFilter implements Filter{
    protected array $columns;

    public function __construct( array $columns){
        $this->columns = $columns;
    }

    public function __invoke(Builder $query, mixed $value, string $property){
        $query->where(function(Builder $query) use ($value){
            foreach($this->columns as $alias => $column){
                

                if(str_contains($column, '.')){
                    $this->applyRelationalSearch($query, $column, $value);
                }else{
                    $this->applyDirectSearch($query, $column, $value);
                }
            }
        });
    }    

    private function applyRelationalSearch(Builder $query, String $column, $value){
        //get the relation and attribute fron column, ex: account.user
        [$relation, $attribute] = explode('.', $column);

        $query->orWhereHas($relation, function (Builder $q) use ($attribute, $value) {
            $q->where($attribute, 'LIKE', "%{$value}%");
        });
    }

    private function applyDirectSearch(Builder $query, String $column, $value){
        // use where if it's the 'id' column
        if ($column === 'id' || Str::endsWith($column, '_id')) {
            $query->orWhere($column, $value);
        } else {
            $query->orWhere($column, 'LIKE', "%{$value}%");
        }
    }
}

?>