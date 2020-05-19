<div>
Congratulations <i>{{ $appointment->patient->name }}</i>,
<p>This is an approval email that your appointment {{ $appointment->id }} with {{ $appointment->doctor->first_name }} has been accepted on {{ \Carbon\Carbon::parse( $appointment->start_date.$appointment->start_time )->toDayDateTimeString()}}! Also, it's the confirmation email that your appointment has been approved by doctor.</p>

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

