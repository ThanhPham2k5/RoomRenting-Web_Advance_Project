<?php
namespace App\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;

class AllColumnFilter implements Filter
{
    protected array $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    public function __invoke(Builder $query, mixed $value, string $property)
    {
        // Spatie có thể trả về mảng nếu URL có dấu phẩy (VD: filter[search]=abc,xyz)
        // Nên ta ép kiểu về mảng để xử lý cho an toàn
        $searchTerms = is_array($value) ? $value : [$value];

        $query->where(function(Builder $query) use ($searchTerms) {
            foreach($this->columns as $alias => $column) {
                
                foreach ($searchTerms as $term) {
                    if (str_contains($column, '.')) {
                        $this->applyRelationalSearch($query, $column, $term);
                    } else {
                        $this->applyDirectSearch($query, $column, $term);
                    }
                }
                
            }
        });
    }    

    private function applyRelationalSearch(Builder $query, string $column, $value)
    {
        // VD: $column = 'user.account.username'
        $parts = explode('.', $column);
        
        // array_pop sẽ bốc phần tử cuối cùng ra làm Tên Cột (VD: 'username')
        $attribute = array_pop($parts); 
        
        // implode những phần còn lại thành Chuỗi Relation (VD: 'user.account')
        $relation = implode('.', $parts); 

        // Sức mạnh của Laravel: Truyền thẳng 'user.account' vào orWhereHas
        $query->orWhereHas($relation, function (Builder $q) use ($attribute, $value) {
            // Tái sử dụng logic kiểm tra ID của bạn luôn cho nhất quán
            if ($attribute === 'id' || Str::endsWith($attribute, '_id')) {
                $q->where($attribute, $value);
            } else {
                $q->where($attribute, 'LIKE', "%{$value}%");
            }
        });
    }

    private function applyDirectSearch(Builder $query, string $column, $value)
    {
        // use where if it's the 'id' column
        if ($column === 'id' || Str::endsWith($column, '_id')) {
            $query->orWhere($column, $value);
        } else {
            $query->orWhere($column, 'LIKE', "%{$value}%");
        }
    }
}