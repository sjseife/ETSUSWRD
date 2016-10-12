@extends('layouts.general')

@section('content')

    <style>
        .table-nonfluid {
            width: 40% !important;
        }
        .btn-link {
            color: red !important;
        }
    </style>

    @if($resourcesSet != false)
        <h1 class="text-center">Resource and Event Report</h1>
        <div class="container">
            <div class="container">
                <a class="btn btn-small btn-danger pull-left" href="{{ URL::to('worklist/emptyReport') }}" style="margin-bottom: 20px;">Empty Report</a>
                <a class="btn btn-small btn-info pull-right" target="_blank" href="{{ URL::to('worklist/generatePDF') }}" style="margin-bottom: 20px;">External Preview</a>
            </div>
            <div>
                <table align="left" class="table table-striped table-nonfluid table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="ReportTable">
                    <thead>
                    <tr>
                        <!-- class all for always show, lower data priority numbers stay longer-->
                        <th class="all">Resource Name</th>
                        <th class="all">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resources as $key => $resource)
                        <?php
                        $link = false;
                        ?>
                        <tr>
                            <td>{{ $resource->name }}</td>
                            <td class="text-center col-small-3">
                                <a href="removeReport/{{$resource->id}}" role="button" class="btn-link btn-sm removeReport
                                    @if(!Auth::user()->resources->contains($resource))
                                        disabled
                                    @endif
                                        ">Remove from Report</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container text-right">
                    <object data="/report.pdf" type="application/pdf" width="60%" height="700">
                    </object>
                </div>
            </div>
        </div>
    @else
        <h1 class="text-center">Resource Report</h1>
        <br>
        <div class="container">
            <h3>
                Report is empty!<br><br>
                Try adding <a href="/resources">resources</a> to the report and come back...<br><br>
            </h3>
        </div>
    @endif
@endsection