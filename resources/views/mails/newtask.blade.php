@component('mail::message')
# New Task for You!

We have been assigned a new task by {{ $schedule->assignor->name }}.

@component('mail::button', ['url' => 'http://localhost:8000/projects/schedules/' . $schedule->id])
View Task
@endcomponent

Thanks,<br>
Employee Management System
@endcomponent
