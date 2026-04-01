<?php

namespace App\Http\Controllers;

use App\Helpers\VietnamAddress;
use App\Http\Controllers\Controller;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use VietnamAddressDatabase\VietnamAddressDatabase;

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

    public function getRevenueStatistic(Request $request){
        $year = $request->input('year', Carbon::now()->year);
        $withTaxes = $request->input('with_taxes', false);
        $compareYear = $request->input('compare_year', null);

        if($compareYear){ // if there's a compare year, we need to get its data as well
            $compareData = $this->getRechargeBillDataByYear($compareYear, $withTaxes);

            $compareYearlyTotal = 0;
            for ($m = 1; $m <= 12; $m++) {
                $monthRevenue = $compareData[$m] ?? 0;
                $compareYearlyTotal += $monthRevenue;
            }
        }

        $data = $this->getRechargeBillDataByYear($year, $withTaxes);

        $fullStats = [];
        $yearlyTotal = 0;
        for ($m = 1; $m <= 12; $m++) {
            $monthRevenue = $data[$m] ?? 0;
            $yearlyTotal += $monthRevenue;
            $fullStats[] = [
                'month' => $m,
                'totalRevenue' => $monthRevenue
            ];
        }

        return response()->json([
            'year' => $year,
            'yearlyRevenue' => $yearlyTotal,
            'compareYear' => $compareYear,
            'compareYearlyRevenue' => $compareYear ? $compareYearlyTotal : null,
            'revenueDifference' => $compareYear ? round(((($yearlyTotal - $compareYearlyTotal) / $compareYearlyTotal) * 100), 2) : null, // give percentage difference if compareYear exists
            'monthlyRevenueDetails' => $fullStats 
        ]);
    }
    
    private function getRechargeBillDataByYear($year, $withTaxes = false){
        if ($withTaxes) {
            return RechargeBill::select(
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('SUM(total_money) as totalRevenue') // include VAT
            )
            ->where('status', 'completed') // only count completed bills
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->pluck('totalRevenue', 'month')
            ->toArray();
        } else {
            return RechargeBill::select(
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('SUM(money) as totalRevenue')
            )
            ->where('status', 'completed') // only count completed bills
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->pluck('totalRevenue', 'month') // chỉ lấy 2 cột này
            ->toArray();
        }
    }
}
