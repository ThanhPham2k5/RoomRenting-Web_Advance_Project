<?php
namespace App\Filter;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class DateFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        // between date (ex: 2026-04-01,2026-04-30)
        if (is_string($value) && str_contains($value, ',')) {
            [$from, $to] = explode(',', $value);
            
            return $query->whereBetween($property, [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay()
            ]);
        }

        // with operator (ex: >2026-04-23)
        if (preg_match('/^([<>]=?|=)(.*)$/', $value, $matches)) {
            $operator = $matches[1];
            $date = $matches[2];
            return $query->whereDate($property, $operator, $date);
        }

        // find exact
        return $query->whereDate($property, '=', $value);
    }
}
?>