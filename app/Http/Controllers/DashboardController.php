<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vormkracht10\Analytics\Facades\Analytics;
use Vormkracht10\Analytics\Period;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function viewChart(Request $request)
    {
        // Lấy giá trị từ request, mặc định là '7day'
        $duration = $request->get('gia_tri', '7day');
        
        // Xác định khoảng thời gian
        $startDate = Carbon::now();
        switch ($duration) {
            case '30day':
                $startDate->subDays(30);
                break;
            default:
                $startDate->subDays(7);
                break;
        }
        $endDate = Carbon::now();

        // Lấy dữ liệu và trả về dưới dạng JSON
        $data = $this->getData($startDate, $endDate);
        // dd($data);die();
        return view('admin.trangchu', ['modifiedData' => $data]);
    }

    private function getData($startDate, $endDate)
    {
        // Lấy dữ liệu từ Google Analytics
        $analyticsData = Analytics::totalViewsByDate(Period::make($startDate, $endDate));
        $numberOfDays = $endDate->diffInDays($startDate) + 1;
        $data = [];
        $currentDate = clone $startDate;
        // Chuyển đổi ngày trong dữ liệu thành định dạng dd-mm-yyyy
        $dataDates = array_map(function($data) {
            return Carbon::createFromFormat('Ymd', $data['date'])->format('Y-m-d');
        }, $analyticsData);

        for ($i = 0; $i < $numberOfDays; $i++) {
            // Chuyển đổi ngày hiện tại thành định dạng dd-mm-yyyy
            $currentDateString = $currentDate->format('Y-m-d');

            // Kiểm tra nếu ngày hiện tại có trong dữ liệu
            if (in_array($currentDateString, $dataDates)) {
                // Lấy dữ liệu cho ngày hiện tại
                $dataItem = array_filter($analyticsData, function($item) use ($currentDateString) {
                    return Carbon::createFromFormat('Ymd', $item['date'])->format('Y-m-d') === $currentDateString;
                });

                $dataItem = array_shift($dataItem); // Lấy phần tử đầu tiên của mảng lọc

                $data[] = [
                    'date' => $currentDateString,
                    'screenPageViews' => $dataItem['screenPageViews'] ?? 0,
                ];
            } else {
                // Ngày không có dữ liệu
                $data[] = [
                    'date' => $currentDateString,
                    'screenPageViews' => 0,
                ];
            }

            $currentDate->addDay();
        }
        return $data;
        // return $analyticsData;
    }
}
