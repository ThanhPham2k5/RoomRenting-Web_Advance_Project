<?php

namespace App\Sort;

use App\Models\Posts\Post;
use Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;

class PostRelatedSort implements Sort
{
    protected $column;

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        // Sử dụng Subquery để lấy giá trị từ bảng posts mà không cần Join
        $query->orderBy(
            Post::select($this->column)
                ->whereColumn('posts.id', 'favorites.post_id')
                ->limit(1),
            $direction
        );
    }
}

?>