Hello {{ $doctor->first_name }},
This is a approval email for signing up on SpeechAssistant.com! Also, it's the confirmation email that you have been approved by our site terms and conditions. 
Please Login::
 
Email: {{ $doctor->first_name }}
Login: {{route('login')}}
 
Site Url:
 
Website: {{route('home')}}
Dashboard: {{route('admin.dashboard')}}
 
Thank You,
{{ trans('panel.site_title') }}