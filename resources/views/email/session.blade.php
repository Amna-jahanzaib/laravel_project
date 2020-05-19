<div>
Congratulations <i>{{ $session->patient->name }}</i>,
<p>This is reminder that your appointment {{ $session->appointment->id }} session {{ $session->id }} with {{ $session->doctor->first_name }} has been created on {{ \Carbon\Carbon::parse( $session->time )->toDayDateTimeString()}}! Please make payment to process further.</p>

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

