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
    <p>Provided by: {{Auth::user()->email}}</p>
</div>
<!-- This image path must be absolute. Dompdf does not support relative paths. -->
<img id="header" src="C:\Users\Dustin\Documents\swrd-team2\public\images\sw_logo.jpg">
    @foreach($resources as $r)
        <div style="page-break-inside: avoid">
                <table width="100%">
                <tr>
                    <td>
                <b>{{$r->Name}}</b><br>
                {{$r->StreetAddress}}
                @if($r->StreetAddress2 != null)
                    {{$r->StreetAddress2}}
                @endif
                , {{$r->City}}, {{$r->State}} {{$r->Zipcode}}<br>
                    </td>
                    <td></td>
                    </tr>
                @if($r->contacts->count() > 0)
                    <tr>
                        <td><i>Contact(s):</i></td>
                        <td></td>
                    </tr>
                @endif
                @foreach($r->contacts as $c)
                    <tr>
                    <td align="left">
                        <u>{{$c->firstName}} {{$c->lastName}}</u>
                        </td>
                    <td align="right">
                        {{$c->phoneNumber}}
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td>
                Hours: {{ Carbon\Carbon::parse($r->OpeningHours)->format('g:i A') }} - {{ Carbon\Carbon::parse($r->ClosingHours)->format('g:i A') }}<br/>
                        </td>
                        <td></td>
                        </tr>
                <tr>
                    <td>
                @if(isset($r->Comments))
                    {{$r->Comments}}
                @endif
                    </td>
                    <td></td>
                </tr>
                </table>
        <hr/>
        </div><!-- /.container -->
        <br>
    @endforeach