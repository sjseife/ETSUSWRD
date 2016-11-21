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
        th{
            border-top: solid 3px  #041E42!important;
            border-bottom: solid 3px  #041E42!important;
            border-left: solid 2px  #041E42!important;

        }
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
<?php
    $detect = new Mobile_Detect;
?>
    @if($resourcesSet != false)
        <?php if ( $detect->isMobile() ) { ?>
        <div class="text-center"><h3 class="page-header">Resource and Event Report</h3></div><br>
        <?php }
        else{ ?>
        <div class="text-center"><h1 class="page-header">Resource and Event Report</h1></div>
        <?php } ?>
            <div class="container">
                <a class="btn btn-small btn-danger pull-left" href="{{ URL::to('worklist/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
                <?php if ( $detect->isMobile() ) { ?>
                    <a class="btn btn-small btn-success pull-right" href="{{ URL::to('/worklist/mobileReport') }}" style="margin-bottom: 20px;">Download</a>
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
                                            <a href="{{ url('/events/removeReport/' . $event->id ) }}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->events->contains($event))
                                                    disabled
                                                @endif
                                                    ">Remove</a>
                                        </td>
                                    <?php }
                                    else{ ?>
                                        <td class="text-center col-small-3">
                                            <a href="{{ url('/events/removeReport/' . $event->id ) }}" role="button" class="btn-link btn-sm removeReport
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
                                        <a href="{{ url('/resources/removeReport/' . $resource->id ) }}" role="button" class="btn-link btn-sm removeReport
                                            @if(!Auth::user()->resources->contains($resource))
                                                disabled
                                            @endif
                                                ">Remove</a>
                                    </td>
                                    <?php }
                                    else{ ?>
                                    <td class="text-center col-small-3">
                                        <a href="{{ url('/resources/removeReport/'. $resource->id ) }}" role="button" class="btn-link btn-sm removeReport
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
                        <object data="data:application/pdf;base64,{{ base64_encode($file) }}" type="application/pdf" width="100%" height="700">
                        </object>
                    </div>
                <?php } ?>
            </div>
        </div>

    @else
        <div class="text-center"><h1 class="page-header">Resource and Event Report</h1></div>

        <br>
        <div class="container">
            <h3>
                Report is empty!<br><br>
                Try adding <a href="{{ url('/resources') }}">resources</a> or <a href="{{ url('/events') }}">events</a> to the report and come back...<br><br>
            </h3>
        </div>
    @endif
@endsection