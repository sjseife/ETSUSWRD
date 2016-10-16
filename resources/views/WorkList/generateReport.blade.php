@extends('layouts.general')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <style>
        .table-nonfluid {
            width: 40% !important;
        }
        .btn-link {
            color: red !important;
        }
    </style>
<?php
    $detect = new Mobile_Detect;
?>
    @if($resourcesSet != false)
        <h1 class="text-center">Resource and Event Report</h1>
            <div class="container">
                <a class="btn btn-small btn-danger pull-left" href="{{ URL::to('worklist/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
                <?php if ( $detect->isMobile() ) { ?>
                    <a class="btn btn-small btn-success pull-right" target="_blank" href="{{ URL::to('/report.pdf') }}" style="margin-bottom: 20px;">Download</a>
                <?php }
                else{ ?>
                <a class="btn btn-small btn-info pull-right" target="_blank" href="{{ URL::to('worklist/generatePDF') }}" style="margin-bottom: 20px;">External Preview</a>
                <?php } ?>
            </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <table align="left" class="table table-striped table-bordered" id="ReportTable">
                        @if(!$events->isEmpty())
                            <thead>
                            <tr>
                                <!-- class all for always show, lower data priority numbers stay longer-->
                                <th class="all">Event Name</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $key => $event)
                                <tr>
                                    <td>{{ $event->name }}</td>
                                    <?php
                                    if ( $detect->isMobile() ) { ?>
                                        <td class="text-center col-small-3">
                                            <a href="/events/removeReport/{{$event->id}}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->events->contains($event))
                                                    disabled
                                                @endif
                                                    ">Remove</a>
                                        </td>
                                    <?php }
                                    else{ ?>
                                        <td class="text-center col-small-3">
                                            <a href="/events/removeReport/{{$event->id}}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->events->contains($event))
                                                    disabled
                                                @endif
                                                    ">Remove from Report</a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                        @if(!$resources->isEmpty())
                            <thead>
                            <tr>
                                <!-- class all for always show, lower data priority numbers stay longer-->
                                <th class="all">Resource Name</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resources as $key => $resource)
                                <tr>
                                    <td>{{ $resource->name }}</td>
                                    <?php
                                    if ( $detect->isMobile() ) { ?>
                                    <td class="text-center col-small-3">
                                        <a href="/resources/removeReport/{{$resource->id}}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->resources->contains($resource))
                                                disabled
                                            @endif
                                                ">Remove</a>
                                    </td>
                                    <?php }
                                    else{ ?>
                                    <td class="text-center col-small-3">
                                        <a href="/resources/removeReport/{{$resource->id}}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->resources->contains($resource))
                                                disabled
                                            @endif
                                                ">Remove from Report</a>
                                    </td>
                                    <?php } ?>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
                <?php if ( !$detect->isMobile() ) { ?>
                    <div class="col-md-7">
                        <object data="/report.pdf" type="application/pdf" width="100%" height="700">
                        </object>
                    </div>
                <?php } ?>
            </div>
        </div>

    @else
        <h1 class="text-center">Resource and Event Report</h1>
        <br>
        <div class="container">
            <h3>
                Report is empty!<br><br>
                Try adding <a href="/resources">resources</a> or <a href="/events">events</a> to the report and come back...<br><br>
            </h3>
        </div>
    @endif
@endsection