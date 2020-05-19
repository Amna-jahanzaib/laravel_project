<div>
Hello <i>{{ $appointment->patient->name }}</i>,
<p>It is hereby you are informed that your appointment {{ $appointment->id }} with {{ $appointment->doctor->first_name }} has been declined on {{ \Carbon\Carbon::parse( $appointment->start_date.$appointment->start_time )->toDayDateTimeString()}}! This email is sent to you in regards that your appointment has been rejected because doctor has declined your appointment request. Please select some other appointment with some other doctor or on some other time.</p>

 
<p><u>Site Url:</u></p>
 
<div>
<p><b>Website:</b>&nbsp;<a href="{{route('home')}}">SpeechAssistant</a> </p>
</div>
 
Thank You,
<br/>
<i>Speech Assistant Team</i>
</div>

