<?php

namespace App\Http\Controllers;

use App\Helpers\VietnamAddress;
use App\Http\Controllers\Controller;
use App\Models\Posts\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use VietnamAddressDatabase\VietnamAddressDatabase;

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
            ->pluck('total', 'month') // chỉ lấy 2 cột này
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
            'yearlyTotal' => $yearlyTotal, 
            'monthlyDetails' => $fullStats 
        ]);
    }

    public function getWardStatistic(Request $request){
        $provinceCode = $request->input('province', '79'); // Default TPHCM
        $provinceName = VietnamAddressDatabase::getProvinceByCode($provinceCode)['name'];
        $wards = VietnamAddressDatabase::getWardsByProvinceCode($provinceCode); 
        $wardNames = array_column($wards, 'name');

        // get the data for general purposes
        $dbData = Post::select(
            'ward', 
            DB::raw('COUNT(*) as total')
        )
        ->whereIn('ward', $wardNames)
        ->where('province', $provinceName)
        ->groupBy('ward')
        ->pluck('total', 'ward')
        ->toArray();

        $allStats = [];
        foreach ($wardNames as $name) {
            $allStats[] = [
                'ward' => $name,
                'total' => $dbData[$name] ?? 0
            ];
        }

        //sort
        usort($allStats, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        // get top 10 and others
        $top10 = array_slice($allStats, 0, 10);

        $others = array_slice($allStats, 10);

        // count othersTotal
        $othersTotal = array_sum(array_column($others, 'total'));

        $wardDetails = $top10;
        
        // Luôn hiện mục "Khác" (hoặc chỉ hiện nếu tỉnh có > 10 quận)
        if (count($allStats) > 10) {
            $wardDetails[] = [
                'ward' => 'Khác',
                'total' => $othersTotal
            ];
        }

        return response()->json([
            'city' => $provinceName,
            'total' => array_sum($dbData), // Tổng thực tế của cả tỉnh
            'wardDetails' => $wardDetails
        ]);
    }

    public function getRoomTypeStatistic(Request $request){
        
        $data = Post::select(
            DB::raw('COUNT(*) as total'),
            'room_type'
        )
            ->groupBy('room_type')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get()
            ->pluck('total', 'room_type')
            ->toArray();

        $roomStats = [];

        $roomStats = [];
        foreach ($data as $roomType => $total) {
            $roomStats[] = [
                'roomType' => $roomType,
                'total' => $total ?? 0
            ];
        }
        

        return response()->json([
            'roomTypeTotal' => array_sum($data), 
            'roomTypeDetails' => $roomStats 
        ]);
    }

    
}
