@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Resources</h1>
    <div id="successOrFailure"></div>
    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
        <!-- create a new resource (uses the create method found at GET /resource/create -->
        <a class="btn btn-md btn-primary pull-right" href="{{ URL::to('resources/create') }}" style="margin-bottom: 20px;">Create New Resource</a>
        @endif
        <br>
        <br>
        <div>
            <table style="display:none;" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="ResourceTable">
                <thead>

                    <tr>
                        <!-- class all for always show, lower data priority numbers stay longer-->
                        <th class="all" >Name</th> {{--0--}}
                        <th data-priority="1">County</th> {{--1--}}
                        <th data-priority="1">Category</th> {{--2--}}
                        <th data-priority="2">Hours of Operation</th> {{--3--}}
                        <th data-priority="2">Phone</th> {{--4--}}
                        <th data-priority="2">Email</th> {{--5--}}
                        <th data-priority="2">Website</th> {{--6--}}
                        <th data-priority="3">Street Address</th> {{--7--}}
                        <th data-priority="2">City</th> {{--8--}}
                        <th data-priority="1">State</th> {{--9--}}
                        <th data-priority="2">Zip Code</th> {{--10--}}
                        <th data-priority="3">Provider</th> {{--11--}}
                        <th data-priority="3">Description</th> {{--12--}}
                        <th data-priority="3">Comments</th> {{--13--}}
                        <th class="all">Action</th> {{--14--}}
                        <th data-priority="4">View Report:</th>{{--15--}}
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($resources as $key => $resource)
                    <?php
                        $link = false;
                    ?>
                    <tr>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->county }}</td>
                        <td>
                            @foreach ($resource->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td>
                            <ul>
                                <?php
                                    $tempDay = array();
                                    $tempNextDay = '';
                                    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                                    $tempOpen = '';
                                    $tempClose = '';
                                    $dayArr = array();
                                    $openTimeArr = array();
                                    $closeTimeArr = array();
                                ?>
                                @foreach($resource->hours as $day)

                                    <?php

                                        if (empty($tempDay))
                                            {
                                                $tempDay[] = $day->day;
                                                $key = array_search($day->day, $days); // returns key of matching day in array
                                                if($key < 6)
                                                    $tempNextDay = $days[$key + 1];
                                                $tempOpen = $day->openTime;
                                                $tempClose = $day->closeTime;
                                            }
                                        elseif(($tempOpen == $day->openTime) && ($tempClose == $day->closeTime) && ($tempNextDay == $day->day))
                                            {
                                                $tempDay[] = $day->day;
                                                $key = array_search($tempNextDay, $days); // returns key of matching day in array
                                                if($key < 6)
                                                    $tempNextDay = $days[$key + 1];
                                            }
                                        else
                                            {
                                                $dayArr[] = $tempDay;
                                                unset($tempDay);
                                                $tempDay[] = $day->day;
                                                $openTimeArr[] = $tempOpen;
                                                $closeTimeArr[] = $tempClose;
                                                $tempOpen = $day->openTime;
                                                $tempClose = $day->closeTime;
                                                $key = array_search($day->day, $days); // returns key of matching day in array
                                                if($key < 6)
                                                    $tempNextDay = $days[$key + 1];
                                            }

                                ?>
                                @endforeach

                            <?php
                                $dayArr[] = $tempDay;
                                $openTimeArr[] = $tempOpen;
                                $closeTimeArr[] = $tempClose;
                                foreach($dayArr as $key => $item)
                                    {
                                        if(empty($item))
                                            {
                                                echo '';
                                            }
                                        elseif (count($item) < 2)
                                            {
                                                echo '<li>' . $item[0] . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</li>';
                                            }
                                        else
                                            {
                                                echo '<li>' . $item[0] . ' - ' . end($item) . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</li>';
                                            }
                                    }
                            ?>
                           </ul>
                        </td>
                        <td><?php
                                    $tempPhoneNumber = $resource->publicPhoneNumber;
                                    $tempPhoneNumber = preg_replace("/[^0-9,x]/", "", $tempPhoneNumber );
                                        if(strlen($tempPhoneNumber) > 10)
                                        {
                                            $tempPhoneNumber = preg_replace("/^[1]/", "", $tempPhoneNumber );
                                        }
                                    $tempPhoneNumber = '(' . substr($tempPhoneNumber,0, 3) . ') '
                                                        . substr($tempPhoneNumber, 3, 3) . '-'
                                                        . substr($tempPhoneNumber, 6, 4) . ' '
                                                        . substr($tempPhoneNumber, 10, (strlen($tempPhoneNumber) - 10));
                                    echo $tempPhoneNumber;

                            ?></td>
                        <td>{{ $resource->publicEmail }}</td>
                        <td>{{ $resource->website }}</td>
                        <td>{{ $resource->streetAddress }} <br> {{ $resource->streetAddress2 }}</td>
                        <td>{{ $resource->city }}</td>
                        <td>{{ $resource->state }}</td>
                        <td>{{ $resource->zipCode }}</td>
                       <td>{{ $resource->provider->name }}</td>
                        <td>{{ $resource->description }}</td>
                        <td>{{ $resource->comments }}</td>
                        <td class="text-center col-md-3">


                            <!-- show the resource (uses the show method found at GET /resource/view/{id} -->
                            {{--<a class="btn btn-sm btn-success" href="{{ URL::to('resources/' . $resource->id) }}">View</a>--}}
                            <button type="button" class="btn btn-sm btn-primary addReport
                                    @if(Auth::user()->resources->contains($resource))
                                    disabled
                                    @endif
                                    " name="{{$resource->id}}">Add to Report</button>
                           {{-- <a class="btn btn-sm btn-primary" href="{{ URL::to('resources/addAjax/'. $resource->id) }}">Add to Report</a>--}}

                        </td>
                        <td class="text-center col-md-3">
                            <a class="btn btn-sm btn-success" href="{{ URL::to('resources/' . $resource->id) }}">View</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@stop

@push('scripts')
<script>
    $(document).ready(function() {

        //Apply DataTables
        $('#ResourceTable').dataTable( {
            initComplete: function () {
                this.api().columns([1,8,9,10,11]).every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            });

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
                this.api().columns([0]).every( function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $(this).val();
                                column //Only the name column
                                        .search(val ? '^' + $(this).val() : val, true, false)
                                        .draw();
                            });
                    var letter = 'A';
                    for(y = 0; y < 26; y ++)
                    {
                        letter = String.fromCharCode('A'.charCodeAt() + y);
                        select.append('<option value="' + letter + '">' + letter + '</option>');
                    }
                });
                this.api().columns([2]).every( function() {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $(this).val();
                                column //Only the name column
                                        .search(val ? $(this).val() : val, true, false)
                                        .draw();
                            });
                    var categories = <?php echo json_encode($categories); ?>;
                    for(y = 0; y < categories.length; y++)
                    {
                        select.append('<option value="' + categories[y] + '">' + categories[y] + '</option>');
                    }
                });

            },
            "fnDrawCallback":function(){
                $(this).show();
            }
        } );


    } );
    //Ajax for add to report button
    $('.addReport').each(function() {
        var button = $(this);
        $(this).click(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: 'resources/add/' + $(this).attr("name"),
                dataType: 'json',
                success: function (data) {
                    //alerts users to successful button pushing.
                     html = '<div class="alert alert-success">Added to Report!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                     $('#successOrFailure').html(html);
                    button.attr("disabled","disabled");

                },
                error: function (data) {
                    if (data.status === 401) //redirect if not authenticated user.
                     $(location).prop('pathname', 'auth/login');
                     if (data.status === 422) {
                         //process validation errors here.
                     var errors = data.responseJSON; //this will get the errors response data.
                     //show them somewhere in the modal
                     errorsHtml = '<div class="alert alert-danger"><ul>';

                     $.each(errors, function (key, value) {
                     errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                     });
                     errorsHtml += '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';

                     $('#successOrFailure').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                     } else {
                     html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                     'Please try again later.</li></ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                     $('#successOrFailure').html(html);
                     }
                }
            });
        });
    });

</script>

@endpush