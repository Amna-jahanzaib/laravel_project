<div>
Congratulations <i>{{ $payment->patient->name }}</i>,
<p>Your payment has been processed successfully and your session {{$payment->session_id}} booking is confirmed for the payment made on {{ \Carbon\Carbon::parse( $payment->created_at )->toDayDateTimeString()}}.</p>

<p><u>Please Login:</u></p>
 
<div>
<p><b>Login:</b>&nbsp;<a href="{{route('login')}}">Login</a></p>
</div>
 
<p><u>Site Url:</u></p>
 
<div>
<p><b>Website:</b>&nbsp;<a href="{{route('home')}}">SpeechAssistant</a> </p>
<p><b>Dashboard:</b>&nbsp;<a href="{{route('patient.dashboard')}}">Patient Dashboard</a></p>
</div>
 
Thank You,
<br/>
<i>Speech Assistant Team</i>
</div>

