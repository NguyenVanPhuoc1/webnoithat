<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class ChartController extends Controller
{
    //
    public function viewChart(Request $request){
        $giatri = $request->get('gia_tri');
        $endDate = Carbon::now();
        $modifiedData = "";
        switch($giatri){
            case '7day':
                $startDate = Carbon::now()->subDays(7);
                $modifiedData = $this->getData($startDate, $endDate);
                break;
            case '30day':
                $startDate = Carbon::now()->subDays(30);
                $modifiedData = $this->getData($startDate, $endDate);
                break;
            // case '1year':
            //     $modifiedData = $this-> ttThang();
            //     break;
            default:
                $startDate = Carbon::now()->subDays(7);
                $modifiedData = $this->getData($startDate, $endDate);
                break;
            }
        return view('admin.trangchu',compact('modifiedData'));
    }

    public function getData($startDate, $endDate){
        
        $analyticsData = Analytics::fetchVisitorsAndPageViewsByDate(Period::create($startDate, $endDate));
        // dd($analyticsData);die();
        $allDates = [];
        $numberOfDays = $endDate->diffInDays($startDate) + 1;
        $currentDate = clone $endDate; 

        for ($i = 1; $i <= $numberOfDays; $i++) {
            $data[] = [
                'date' => $currentDate->toDateString(),
                'activeUsers' => 0,
                'screenPageViews' => 0,
            ];

            // Check if there is data from Google Analytics for that day, override default values
            if (isset($analyticsData[$i - 1])) {
                $data[$i - 1]['activeUsers'] = $analyticsData[$i - 1]['activeUsers'];
                $data[$i - 1]['screenPageViews'] = $analyticsData[$i - 1]['screenPageViews'];
            }

            $currentDate->subDay();
        }
        // var_dump($data);
        return $data;

    }
    // public function ttThang()
    // {
    //     $date = now();
    //     $year = $date->year;
    //     $monthlyData = [];

    //     for ($month = 1; $month <= 12; $month++) {
    //         $startDate = Carbon::create($year, $month, 1)->startOfMonth();
    //         $endDate = $startDate->copy()->endOfMonth();
    //         // dd(Period::create($startDate, $endDate));
    //         $analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
    //         // dd($analyticsData);
    //         $monthlyData[$month] = $analyticsData;
    //         // dd($month);
    //     }
    //     return $analyticsData;
    // }
}
