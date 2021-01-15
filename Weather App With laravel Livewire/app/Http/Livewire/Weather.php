<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Str;
use \Torann\GeoIP\Location;

class Weather extends Component
{
    public $city;
    public function render()
    {
        // session()->forget('city');
        $geoip = geoip()->getLocation('103.217.177.116');

        if(!session()->has('city')){
            session()->put('city',$geoip->city);
        }

        $data = Http::post('http://api.openweathermap.org/data/2.5/forecast?q='.session('city').'&appid=e458609984d4efd72b9d31134bdab8eb')->json();

        if($data['cod'] == 200 )
        {
            // WEEK NAME GET FROM DATE THROUGH CARBON
            $today = Carbon::now()->dayName;
            $second = Carbon::parse($data['list'][5]['dt_txt'])->format("D");
            $third= Carbon::parse($data['list'][13]['dt_txt'])->format("D");
            $fourth = Carbon::parse($data['list'][21]['dt_txt'])->format("D");
            $fifth = Carbon::parse($data['list'][29]['dt_txt'])->format("D");
            $six = Carbon::parse($data['list'][37]['dt_txt'])->format("D");
            $todayday = Carbon::parse($today)->format("D");

            // DAYS NAME ARRAY
            $days = [
                'todaydate'=> $todayday,
                'secondDay'=> $second,
                'thirdDay'=> $third,
                'fourthDay'=> $fourth,
                'fifthDay'=> $fifth,
                'sixthDay'=> $six,
            ];

            // WEATHER ICONS ARRAY
            $icons = [
                'main_icon'=> $data['list'][0]['weather'][0]['icon'],
                'secondicon'=> $data['list'][5]['weather'][0]['icon'],
                'thirdicon'=> $data['list'][13]['weather'][0]['icon'],
                'fourthicon'=> $data['list'][21]['weather'][0]['icon'],
                'fifthicon'=> $data['list'][29]['weather'][0]['icon'],
                'sixthicon'=> $data['list'][37]['weather'][0]['icon'],
            ];

            // ALL TEMERATURES
            $temps = [
                'current_temp'=> round((float)$data['list'][0]['main']['temp']-273.15),
                'feels_like'=> round((float)$data['list'][0]['main']['feels_like']-273.15),
                'humidity'=> $data['list'][0]['main']['humidity'],
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

            // CITY AND COUNTRY NAME AND ICON URL 
            $city_name =  [
                'city'=> $data['city']['name'],
                'country'=> $data['city']['country'],
                'image_icons_url'=> 'http://openweathermap.org/img/wn/',
                'today'=> $today,
            ];
            return view('livewire.weather',['data'=> $city_name,'alldays'=> $days , 'icons'=> $icons , 'temps'=> $temps]);
        }else{
            return view('livewire.weather',['data'=> 'nf']);
        }
    }

    public function submit()
    {
        $city = $this->city;
        session()->put('city',$city);
    }

}
