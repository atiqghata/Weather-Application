<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $country = $request->input("city","karachi");
        $city = htmlspecialchars($country);
        session()->put('city',$city);
        $data = Http::post('http://api.openweathermap.org/data/2.5/forecast?q='.session('city').'&appid=e458609984d4efd72b9d31134bdab8eb')->json();

        if($data['message'] === 0 ){
            $today = Carbon::now()->dayName;
            $second = Carbon::parse($data['list'][5]['dt_txt'])->dayName;
            $third= Carbon::parse($data['list'][13]['dt_txt'])->dayName;
            $fourth = Carbon::parse($data['list'][21]['dt_txt'])->dayName;
            $fifth = Carbon::parse($data['list'][29]['dt_txt'])->dayName;
            $six = Carbon::parse($data['list'][37]['dt_txt'])->dayName;

            $todayday = Str::substr($today,0,3);
            $secondDay = Str::substr($second,0,3);
            $thirdDay = Str::substr($third,0,3);
            $fourDay = Str::substr($fourth,0,3);
            $fiveDay = Str::substr($fifth,0,3);
            $sixDay = Str::substr($six,0,3);

            $days = [
                // 'today'=> $today,
                'todaydate'=> $todayday,
                'secondDay'=> $secondDay,
                'thirdDay'=> $thirdDay,
                'fourthDay'=> $fourDay,
                'fifthDay'=> $fiveDay,
                'sixthDay'=> $sixDay,
            ];

            $icons = [
                'main_icon'=> $data['list'][0]['weather'][0]['icon'],
                'secondicon'=> $data['list'][5]['weather'][0]['icon'],
                'thirdicon'=> $data['list'][13]['weather'][0]['icon'],
                'fourthicon'=> $data['list'][21]['weather'][0]['icon'],
                'fifthicon'=> $data['list'][29]['weather'][0]['icon'],
                'sixthicon'=> $data['list'][37]['weather'][0]['icon'],
            ];

            $temps = [
                'current_temp'=> round((float)$data['list'][0]['main']['temp']-273.15),
                'feels_like'=> round((float)$data['list'][0]['main']['feels_like']-273.15),
                'currentMaxtemp'=> round((float)$data['list'][0]['main']['temp_max']-273.15),
                'currentMintemp'=> round((float)$data['list'][0]['main']['temp_min']-273.15),
                'secondMaxtemp'=> round($data['list'][5]['main']['temp_max']-273.15),
                'secondMintemp'=> round($data['list'][5]['main']['temp_min']-273.15),
                'thirdMaxtemp'=> round($data['list'][13]['main']['temp_max']-273.15),
                'thirdMintemp'=> round($data['list'][13]['main']['temp_min']-273.15),
                'fourthMaxtemp'=> round($data['list'][21]['main']['temp_max']-273.15),
                'fourthMintemp'=> round($data['list'][21]['main']['temp_min']-273.15),
                'fifthMaxtemp'=> round($data['list'][29]['main']['temp_max']-273.15),
                'fifthMintemp'=> round($data['list'][29]['main']['temp_min']-273.15),
                'sixthMaxtemp'=> round($data['list'][37]['main']['temp_max']-273.15),
                'sixthMintemp'=> round($data['list'][37]['main']['temp_min']-273.15),
                'weather'=> $data['list'][0]['weather'][0]['main'],
            ];

            $city_name =  [
                'city'=> $data['city']['name'],
                'country'=> $data['city']['country'],
                'image_icons_url'=> 'http://openweathermap.org/img/wn/',
                'today'=> $today,
            ];

            return view('weather',['data'=>$city_name,'alldays'=> $days , 'icons'=> $icons , 'temps'=> $temps]);
        }else{
            session()->forget('city');
            session()->put('city','karachi');
            return back()->with('not_found','City Not Found');
        }
    }
}
