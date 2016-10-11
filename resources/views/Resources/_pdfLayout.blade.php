<style>
    @page{
        margin-top: 180px;
        margin-bottom: 10px;
    }
    #header {
        position: fixed; display: block; margin-top: -150px;
        width:25%; height: auto; padding-left: 38%; opacity: 0.5;
    }
    dl {
        width: 800px
    }
    dt {
        float: left; width: 450px; overflow: hidden; white-space: nowrap
    }
    dt span:after {
        content: " ............................................................" }
    dd span:before {
        content: "........................................................................... " }
    dd {
        top: 38px;
        position: absolute; padding-left: 249px; width: 415px; overflow: hidden; text-align: right;
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
    <p>Provided by: {{Auth::user()->email}}</p>
</div>
<!-- This image path must be absolute. Dompdf does not support relative paths. -->
<img id="header" src="C:\Users\Dustin\Documents\swrd-team2\public\images\sw_logo.jpg">
<div id="resources">
    @foreach($resources as $r)
        <div class="container" style="page-break-inside: avoid">
            <p>
                <dl>
                <b>{{$r->Name}}</b><br/>
                {{$r->StreetAddress}}
                @if($r->StreetAddress2 != null)
                    {{$r->StreetAddress2}}
                @endif
                , {{$r->City}}, {{$r->State}} {{$r->Zipcode}}<br>
                @foreach($r->contacts as $c)
                    <dt><span>{{$c->firstName}} {{$c->lastName}}</span></dt><dd><span>{{$c->phoneNumber}}</span></dd>
                    @break <!-- only listing one contact per resource because the dd element is using absolute positioning -->
                @endforeach
                Hours: {{ Carbon\Carbon::parse($r->OpeningHours)->format('g:i A') }} - {{ Carbon\Carbon::parse($r->ClosingHours)->format('g:i A') }}<br/>
                @if(isset($r->Comments))
                    {{$r->Comments}}
                @endif
                </dl>
            </p>
        <hr/>
        </div><!-- /.container -->
        <br>
    @endforeach
</div>