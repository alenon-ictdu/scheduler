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

.cd-schedule .events .events-group > ul {
    height: 1098px;
    display: block;
    overflow: visible;
    padding: 0;
}

.user-pic {
    margin-top: 15px;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 1.65rem 1rem;
    clear: both;
    font-weight: 400;
    color: black;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    font-size: 12px;
}

</style>
@stop

@section('breadcrumb')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Section : {{ $faculty->firstname. ' ' .$faculty->middlename. ' ' .$faculty->lastname }}</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Section {{ $faculty->firstname. ' ' .$faculty->middlename. ' ' .$faculty->lastname }}</li>
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
                    @foreach($schedule as $row)
                        @if($row->day == 'Monday')
                        <li class="single-event" data-start="{{ $row->start }}" data-end="{{ $row->end }}" data-content="event-abs-circuit" data-event="event-{{ $ctr }}">
                            <p>
                                <em class="event-name">{{ $row->subject_description }}</em>
                                <small style="color: white;">{{ $row->section_year. ' ' .$row->section_name }}</small>
                            </p>

                        </li>
                        <?php $ctr++; ?>
                        @if($ctr > 4) <?php $ctr = 1; ?> @endif
                        @endif
                    @endforeach
                    <?php $ctr = 1; ?>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Tuesday</span></div>

                <ul>
                    @foreach($schedule as $row)
                        @if($row->day == 'Tuesday')
                        <li class="single-event" data-start="{{ $row->start }}" data-end="{{ $row->end }}" data-content="event-abs-circuit" data-event="event-{{ $ctr }}">
                            <p>
                                <em class="event-name">{{ $row->subject_description }}</em>
                                <small style="color: white;">{{ $row->section_year. ' ' .$row->section_name }}</small>
                            </p>

                        </li>
                        <?php $ctr++; ?>
                        @if($ctr > 4) <?php $ctr = 1; ?> @endif
                        @endif
                    @endforeach
                    <?php $ctr = 1; ?>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Wednesday</span></div>

                <ul>
                    @foreach($schedule as $row)
                        @if($row->day == 'Wednesday')
                        <li class="single-event" data-start="{{ $row->start }}" data-end="{{ $row->end }}" data-content="event-abs-circuit" data-event="event-{{ $ctr }}">
                            <p>
                                <em class="event-name">{{ $row->subject_description }}</em>
                                <small style="color: white;">{{ $row->section_year. ' ' .$row->section_name }}</small>
                            </p>

                        </li>
                        <?php $ctr++; ?>
                        @if($ctr > 4) <?php $ctr = 1; ?> @endif
                        @endif
                    @endforeach
                    <?php $ctr = 1; ?>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Thursday</span></div>

                <ul>
                    @foreach($schedule as $row)
                        @if($row->day == 'Thursday')
                        <li class="single-event" data-start="{{ $row->start }}" data-end="{{ $row->end }}" data-content="event-abs-circuit" data-event="event-{{ $ctr }}">
                            <p>
                                <em class="event-name">{{ $row->subject_description }}</em>
                                <small style="color: white;">{{ $row->section_year. ' ' .$row->section_name }}</small>
                            </p>

                        </li>
                        <?php $ctr++; ?>
                        @if($ctr > 4) <?php $ctr = 1; ?> @endif
                        @endif
                    @endforeach
                    <?php $ctr = 1; ?>
                </ul>
            </li>

            <li class="events-group">
                <div class="top-info"><span>Friday</span></div>

                <ul>
                    @foreach($schedule as $row)
                        @if($row->day == 'Friday')
                        <li class="single-event" data-start="{{ $row->start }}" data-end="{{ $row->end }}" data-content="event-abs-circuit" data-event="event-{{ $ctr }}">
                            <p>
                                <em class="event-name">{{ $row->subject_description }}</em>
                                <small style="color: white;">{{ $row->section_year. ' ' .$row->section_name }}</small>
                            </p>

                        </li>
                        <?php $ctr++; ?>
                        @if($ctr > 4) <?php $ctr = 1; ?> @endif
                        @endif
                    @endforeach

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
<script>
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}', '');
    @endif
</script>
@stop