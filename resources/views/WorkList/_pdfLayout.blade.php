<style>
    @page{
        margin-top: 180px;
        margin-bottom: 10px;
    }
    #header {
        position: fixed; display: block; margin-top: -150px;
        width:25%; height: auto; padding-left: 38%; opacity: 0.5;
    }
    hr{
        opacity: 0.05;
    }
    * {
        box-sizing: border-box;
    }
    #footer {
        position: fixed; display: block; margin-top: 890px;
        width:100%; height: auto; text-align: center;
    }

</style>
<div id="footer">
    <p>Provided by: {{Auth::user()->name}} | {{Auth::user()->email}}</p>
</div>
<!-- This image path must be absolute. Dompdf does not support relative paths. -->
<img id="header" src="C:\Users\Dustin\Documents\swrd-team2\public\images\sw_logo.jpg">
@if(!$events->isEmpty())
    <h2 style="text-align: center">Events</h2>
    <hr>
    @foreach($events as $e)
        <div style="page-break-inside: avoid">
            <table width="100%">
                <tr>
                    <td>
                        <b>{{$e->name}}</b><br />
                        {{$e->streetAddress}}
                        @if($e->streetAddress2 != null)
                            {{$e->sreetAddress2}}
                        @endif
                        , {{$e->city}}, {{$e->state}} {{$e->zipCode}}<br>
                    </td>
                    <td align="right">
                        @if(isset($e->publicPhoneNumber))
                            <?php
                            $tempPhoneNumber = $e->publicPhoneNumber;
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
                            ?>
                        @endif
                    </td>
                </tr>
                @if(isset($e->publicEmail) || isset($e->website))
                <tr>
                    <td>
                        @if(isset($e->publicEmail) && isset($e->website))
                            {{ $e->publicEmail }} | {{ $e->website }}
                        @else
                            @if(isset($e->publicEmail))
                                {{ $e->publicEmail }}
                            @endif
                            @if(isset($e->website))
                                {{ $e->website }}
                            @endif
                        @endif
                    </td>
                    <td></td>
                </tr>
                @endif
                @if($e->description != "")
                    <tr>
                        <td><i>Description</i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            {{ $e->description }}
                        </td>
                        <td></td>
                    </tr>
                @endif
                @if($e->comments != "")
                    <tr>
                        <td><i>Comments</i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            {{$e->comments}}
                        </td>
                        <td></td>
                    </tr>
                @endif
            </table>
            <hr/>
        </div><!-- /.container -->
        <br>
    @endforeach
@endif
@if(!$resources->isEmpty())
    <h2 style="text-align: center">Resources</h2>
    <hr>
    @foreach($resources as $r)
        <div style="page-break-inside: avoid">
            <table width="100%">
                <tr>
                    <td>
                        <b>{{$r->name}}</b><br />
                        {{$r->streetAddress}}
                        @if($r->streetAddress2 != null)
                            {{$r->sreetAddress2}}
                        @endif
                        , {{$r->city}}, {{$r->state}} {{$r->zipCode}}<br />
                        @if(isset($r->publicEmail))
                            {{ $r->publicEmail }} |
                        @endif
                        @if(isset($r->website))
                            {{ $r->website }}
                        @endif
                    </td>
                    <td align="right">
                        @if(isset($r->publicPhoneNumber))
                            <?php
                            $tempPhoneNumber = $r->publicPhoneNumber;
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
                            ?>
                        @endif
                    </td>
                </tr>
                @if(!$r->hours->isEmpty())
                    <tr>
                        <td><i>Hours of Operation:</i></td>
                        <td></td>
                    </tr>
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
                    <tr>
                        <td>
                    @foreach($r->hours as $day)
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
                                    echo '<u>' . $item[0] . '</u>: ' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '<br>';
                                }
                                else
                                {
                                    echo '<u>' . $item[0] . ' - ' . end($item) . '</u>: ' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '<br>';
                                }
                            }
                        ?>
                            </td>
                            <td></td>
                        </tr>
                @endif
                @if($r->description != "")
                    <tr>
                        <td><i>Description</i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            {{ $r->description }}
                        </td>
                        <td></td>
                    </tr>
                @endif
                @if($r->comments != "")
                    <tr>
                        <td><i>Comments</i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            {{$r->comments}}
                        </td>
                        <td></td>
                    </tr>
                @endif
            </table>
            <hr/>
        </div><!-- /.container -->
        <br>
    @endforeach
@endif