@extends('layouts.app')

@section('content')
@include('layouts.nav')
<main>
<div class="container">
    <h1>Dashboard</h1>
    <div class="row no-m-b">
        <div class="col s12">
            @if(Auth::user()->credits->sum('credits') == 0)
                <div class="news-dashboard">
                    <div class="card-header alert-message-credits">
                                <h1>
                                    WARNING You have only 0 credits left
                                <i class="fa fa-exclamation-triangle right"></i>
                                </h1>
                    </div>
                </div>
            @endif
        </div>
        <div class="col m12 l12 hide-on-small-only">
            <div class="news-dashboard">
                <div class="card-header" onclick="event.stopPropagation();">
                    <div class="select-wrapper dashboard-select graph-select">
                        <select class="dashboard-select graph-select initialized" data-select-id="227b884c-1520-9c96-2b26-c48bc58f5c38">
                            <option value="year">Files this year</option>
                            <option value="month">Files this month</option>
                            <option value="week">Files this week</option>
                        </select>
                    </div>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                    <div class="year-chart chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="year-charts" height="696" width="1902" style="display: block; height: 348px; width: 951px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="month-chart hide chart-wrapper">
                        <canvas id="month-charts" height="0" width="0" class="chartjs-render-monitor" style="display: block; height: 0px; width: 0px;"></canvas>
                    </div>
                    <div class="week-chart hide chart-wrapper">
                        <canvas id="week-charts" height="0" width="0" class="chartjs-render-monitor" style="display: block; height: 0px; width: 0px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Today</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $todaysFilesCount }} files
                </span>
                    <span class="period">Yesterday
                    <small>
                        {{ $yesterdaysFilesCount }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">Previous year
                    <small>
                        {{ $previousYearsFilesCount }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>This week</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisWeeksFilesCount }} files
                </span>
                    <span class="period">Previous week
                    <small>
                        {{ $previousWeeksFilesCount  }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">Previous year
                    <small>
                        {{ $previousYearsFilesCount }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>This month</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisMonthsFilesCount }} files
                    <small>{{$thisWeeksCreditsCount}} Credits</small>
                </span>
                    <span class="period">Previous month
                    <small>
                        {{ $previousMonthsFilesCount }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                    <span class="period">Previous year
                    <small>
                        {{ $previousYearsFilesCount }} files
                        <i class="fa-solid fa-arrow-right right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
        <div class="col s6 m3 l3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>This year</h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                <span class="credits-title countup" data-from="25" data-to="7800" data-speed="1000">
                    {{ $thisYearsFilesCount }} files
                    <small>{{ $thisYearsCreditsCount }}  Credits</small>
                </span>
                    <span class="period">Previous year
                    <small>
                        {{ $previousYearsFilesCount }} files
                        <i class="fa fa-line-chart right"></i>
                    </small>
                </span>
                    <span class="period">Two years ago
                    <small>
                        {{$twoYearsAgoFilesCount}} files
                        <i class="fa fa-line-chart right"></i>
                    </small>
                </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Last vehicles tuned<i class="fa fa-clock-o right"></i></h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content">
                    <table>
                        <tbody>
                            @foreach($twoFiles as $file)
                                <tr>
                                    <td>
                                        <img src="{{ $file->vehicle()->Brand_image_URL }}" alt=" logo" class="logo-id">
                                    </td>
                                    <td>
                                        <a class="car-info" href="{{route('file', $file->id)}}">
                                            {{$file->vehicle()->Name}} 
                                        </a>
                                        <span class="car-name">
                                            {{ $file->engine }} {{ $file->vehicle()->TORQUE_standard }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach                               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        <div class="col s6 m3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Modèle<i class="fa fa-fire right"></i></h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content height-table center">
                    <h1>Mercedes</h1>
                    <h3>Sprinter</h3>
                </div>
            </div>
        </div>
        
        <div class="col s6 m3">
            <div class="news-dashboard">
                <div class="card-header">
                    <h1>Marque<i class="fa fa-fire right"></i></h1>
                </div>
                <div class="divider-light"></div>
                <div class="card-content height-table center">
                    <img class="responsive-img logo-brand-dashboard" src="https://www.shiftech.eu/media/manufacturers/5f98ae3c7c4f9f03b4033f72a4d20dd6.png">
                </div>
            </div>
        </div>
    </div>
    <div class="row"></div>
</div>
</main>
@endsection
