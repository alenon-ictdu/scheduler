@extends('layouts.app2')

@section('styles')
{{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('scheduler/css/reset.css') }}"> <!-- CSS reset -->
<link rel="stylesheet" href="{{ asset('scheduler/css/style.css') }}"> <!-- Resource style -->
<style>
.cd-schedule .timeline li:nth-of-type(2n) span {
    display: block;
}

.cd-schedule .events .single-event p {
    padding: 1.2em;
}
</style>
@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Subjects</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subjects</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@stop

@section('content')
<div class="card" style="height: 1300px;">
<div class="cd-schedule loading">
    <div class="timeline">
        <ul>
            <li><span>07:00 AM</span></li>
            <li><span>07:30 AM</span></li>
            <li><span>08:00 AM</span></li>
            <li><span>08:30 AM</span></li>
            <li><span>09:00 AM</span></li>
            <li><span>09:30 AM</span></li>
            <li><span>10:00 AM</span></li>
            <li><span>10:30 AM</span></li>
            <li><span>11:00 AM</span></li>
            <li><span>11:30 AM</span></li>
            <li><span>12:00 PM</span></li>
            <li><span>12:30 PM</span></li>
            <li><span>01:00 PM</span></li>
            <li><span>01:30 PM</span></li>
            <li><span>02:00 PM</span></li>
            <li><span>02:30 PM</span></li>
            <li><span>03:00 PM</span></li>
            <li><span>03:30 PM</span></li>
            <li><span>04:00 PM</span></li>
            <li><span>04:30 PM</span></li>
            <li><span>05:00 PM</span></li>
            <li><span>05:30 PM</span></li>
            <li><span>06:00 PM</span></li>
        </ul>
    </div> <!-- .timeline -->

    <div class="events">
        <ul>
            <li class="events-group">
                <div class="top-info"><span>Monday</span></div>

                <ul>
                    <li class="single-event" data-start="09:30" data-end="10:30" data-content="event-abs-circuit" data-event="event-1">
                        <p>
                            <em class="event-name">Abs Circuit</em>
                            <small>09:30 - 10:30</small>
                        </p>

                    </li>

                    <li class="single-event" data-start="11:00" data-end="12:30" data-content="event-rowing-workout" data-event="event-2">
                        <a href="#0">
                            <em class="event-name">Rowing Workout</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="14:00" data-end="15:15"  data-content="event-yoga-1" data-event="event-3">
                        <a href="#0">
                            <em class="event-name">Yoga Level 1</em>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Tuesday</span></div>

                <ul>
                    <li class="single-event" data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2">
                        <a href="#0">
                            <em class="event-name">Rowing Workout</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="11:30" data-end="13:00"  data-content="event-restorative-yoga" data-event="event-4">
                        <a href="#0">
                            <em class="event-name">Restorative Yoga</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="13:30" data-end="15:00" data-content="event-abs-circuit" data-event="event-1">
                        <a href="#0">
                            <em class="event-name">Abs Circuit</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3">
                        <a href="#0">
                            <em class="event-name">Yoga Level 1</em>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Wednesday</span></div>

                <ul>
                    <li class="single-event" data-start="09:00" data-end="10:15" data-content="event-restorative-yoga" data-event="event-4">
                        <a href="#0">
                            <em class="event-name">Restorative Yoga</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="10:45" data-end="11:45" data-content="event-yoga-1" data-event="event-3">
                        <a href="#0">
                            <em class="event-name">Yoga Level 1</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="12:00" data-end="13:45"  data-content="event-rowing-workout" data-event="event-2">
                        <a href="#0">
                            <em class="event-name">Rowing Workout</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="13:45" data-end="15:00" data-content="event-yoga-1" data-event="event-3">
                        <a href="#0">
                            <em class="event-name">Yoga Level 1</em>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Thursday</span></div>

                <ul>
                    <li class="single-event" data-start="09:30" data-end="10:30" data-content="event-abs-circuit" data-event="event-1">
                        <a href="#0">
                            <em class="event-name">Abs Circuit</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="12:00" data-end="13:45" data-content="event-restorative-yoga" data-event="event-4">
                        <a href="#0">
                            <em class="event-name">Restorative Yoga</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="15:30" data-end="16:30" data-content="event-abs-circuit" data-event="event-1">
                        <a href="#0">
                            <em class="event-name">Abs Circuit</em>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Friday</span></div>

                <ul>
                    <li class="single-event" data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2">
                        <a href="#0">
                            <em class="event-name">Rowing Workout</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="12:30" data-end="14:00" data-content="event-abs-circuit" data-event="event-1">
                        <a href="#0">
                            <em class="event-name">Abs Circuit</em>
                        </a>
                    </li>

                    <li class="single-event" data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3">
                        <a href="#0">
                            <em class="event-name">Yoga Level 1</em>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- <div class="event-modal">
        <header class="header">
            <div class="content">
                <span class="event-date"></span>
                <h3 class="event-name"></h3>
            </div>
    
            <div class="header-bg"></div>
        </header>
    
        <div class="body">
            <div class="event-info"></div>
            <div class="body-bg"></div>
        </div>
    
        <a href="#0" class="close">Close</a>
    </div> -->

    <div class="cover-layer"></div>
</div>
</div>

@stop

@section('scripts')
<script src="{{ asset('scheduler/js/modernizr.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> --}}
{{-- <script>
    if( !window.jQuery ) document.write('<script src="{{ asset('scheduler/js/jquery-3.0.0.min.js') }}"><\/script>');
</script> --}}
<script src="{{ asset('scheduler/js/main.js') }}"></script> <!-- Resource jQuery -->
@stop