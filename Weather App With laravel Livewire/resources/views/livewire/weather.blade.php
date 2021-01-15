<div>
@livewire('header')
    <div class="row">     
        <div class="col-md-6 offset-md-3 mainbox">
            <form wire:submit.prevent="submit">
                @csrf
                <input type="text" placeholder="City" wire:model="city" class="form-control">
            </form>
            @if ($data == 'nf') 
                <h4 class="notfound">City Not Found</h4>
            @else    
            <div class="row padding">
                <div class="col-md-6">
                    <h3>{{ $data['today'] }}</h3>
                    <h1><img src="{{ $data['image_icons_url'] }}{{ $icons['main_icon'] }}.png" class="img_size">
                    {{ $temps['current_temp'] }}°C</h1>
                    <h4>{{$temps['weather']}}</h4>
                </div>
                <div class="col-md-6">
                    <h1>{{ $data['city'] }},{{ $data['country'] }}</h1>
                    <h6>Temperature: {{ $temps['current_temp'] }}°C</h6>
                    <h6>Feels Like: {{ $temps['feels_like'] }}°C</h6>
                    <h6>Humidity: {{ $temps['humidity'] }}%</h6>
                </div>
            </div>
            <div class="row days">
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
            <div class="row temp_padding">
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
            @endif
        </div>
    </div>
</div>
@livewireScripts