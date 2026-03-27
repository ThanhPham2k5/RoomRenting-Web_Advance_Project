<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class StatisticController extends Controller
{
    
    public function getFullYearStatistics(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);

        // Truy vấn database
        $data = Post::select(
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->pluck('total', 'month') // Chuyển về dạng [month => total]
            ->toArray();

        // Tạo mảng 12 tháng mặc định bằng 0
        $fullStats = [];
        $yearlyTotal = 0;

        for ($m = 1; $m <= 12; $m++) {
            $monthCount = $data[$m] ?? 0;
            $yearlyTotal += $monthCount;

            $fullStats[] = [
                'month' => $m,
                'total' => $monthCount
            ];
        }

        return response()->json([
            'year' => $year,
            'yearly_total' => $yearlyTotal, 
            'monthly_details' => $fullStats 
        ]);
    }

    
}
