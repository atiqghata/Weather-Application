<x-header />
    <div class="row">     
        <div class="col-md-6 offset-md-3" style="padding:20px; border:2px solid; border-radius:10px; margin-top:70px;">
            <form action="weather" method="POST">
                @csrf
                <input type="text" placeholder="City" name="city" class="form-control" style="background-color:white;">
            </form>
            @if (session()->has('not_found'))
                <h5 style="text-align: center">{{ session()->get('not_found') }}</h5>
            @endif
            <div class="row" style="padding:20px;">
                <div class="col-md-6">
                    <h3>{{ $data['today'] }}</h3>
                    <h1><img src="{{ $data['image_icons_url'] }}{{ $icons['main_icon'] }}.png" style="width: 50px; height:50px;">
                    {{ $temps['current_temp'] }}°C</h1>
                    <h4>{{$temps['weather']}}</h4>
                </div>
                <div class="col-md-6">
                    <h1>{{ $data['city'] }},{{ $data['country'] }}</h1>
                    <h5>Temperature: {{ $temps['current_temp'] }}°C</h5>
                    <h5>Feels Like: {{ $temps['feels_like'] }}°C</h5>
                </div>
            </div>
            <div class="row" style="padding:10px; font-weight: bold">
                @foreach ($alldays as $day)
                    <div class="col-md-2">
                        {{ $day }}
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach ($icons as $icon)
                    <div class="col-md-2">
                        <img src="{{ $data['image_icons_url'] }}{{ $icon }}.png">
                    </div>
                @endforeach
            </div>
            <div class="row" style="padding:10px;">
                <div class="col-md-2">
                    {{ $temps['currentMaxtemp'] }}° {{ $temps['currentMintemp'] }}°
                </div>
                 <div class="col-md-2">
                    {{ $temps['secondMaxtemp'] }}° {{ $temps['secondMintemp'] }}°
                </div>
                 <div class="col-md-2">
                    {{ $temps['thirdMaxtemp'] }}° {{ $temps['thirdMintemp'] }}°
                </div>
                 <div class="col-md-2">
                    {{ $temps['fourthMaxtemp'] }}° {{ $temps['fourthMintemp'] }}°
                </div>
                <div class="col-md-2">
                    {{ $temps['fifthMaxtemp'] }}° {{ $temps['fifthMintemp'] }}°
                </div>
                <div class="col-md-2">
                    {{ $temps['sixthMaxtemp'] }}° {{ $temps['sixthMintemp'] }}°
                </div>
            </div>
        </div>
    </div>
