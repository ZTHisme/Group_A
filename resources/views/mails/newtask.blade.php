@component('mail::message')
# New Task for You!

You have been assigned a new task by {{ $schedule->assignor->name }}.

@component('mail::button', ['url' => 'http://localhost:8000/projects/schedules/' . $schedule->id . '/showschedule'])
View Task
@endcomponent

Thanks,<br>
Employee Management System
@endcomponent
