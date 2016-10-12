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
        width:100%; height: auto; padding-left: 32%;
    }

</style>
<div id="footer">
    <!-- Showing email for now -->
    <!-- changed to name 10/10/2016 William Kubenka-->
    <p>Provided by: {{Auth::user()->name}}</p>
</div>
<!-- This image path must be absolute. Dompdf does not support relative paths. -->
<img id="header" src="C:\Users\Will\Documents\swrd-team2-withBetterGui\public\images\sw_logo.jpg">
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
                    @if(isset($r->publicPhoneNumber))
                        {{ $r->publicPhoneNumber }} |
                    @endif
                    @if(isset($r->publicEmail))
                        {{ $r->publicEmail }} |
                    @endif
                    @if(isset($r->website))
                        {{ $r->website }}
                    @endif
                </td>
                <td></td>
            </tr>
            <tr>
                <td><i>Hours of Operation:</i></td>
                <td></td>
            </tr>
            @foreach($r->hours as $day)
                <tr>
                    <td>
                        <u>{{ $day->day }}</u> : {{ date('g:i A', strtotime($day->openTime)) }} - {{ date('g:i A', strtotime($day->closeTime)) }}
                    </td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><i>Description</i></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    @if(isset($r->description))
                        {{ $r->description }}
                    @endif
                </td>
            </tr>
                <tr>
                    <td><i>Comments</i></td>
                    <td></td>
                </tr>
            <tr>
                <td>
                    @if(isset($r->comments))
                        {{$r->comments}}
                    @endif
                </td>
                <td></td>
            </tr>
        </table>
        <hr/>
    </div><!-- /.container -->
    <br>
@endforeach