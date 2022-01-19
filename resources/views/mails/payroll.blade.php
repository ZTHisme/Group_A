@component('mail::message')
# Your Payroll

We have attached your payroll detail.

@component('mail::button', ['url' => $url])
More Info
@endcomponent

Thanks,<br>
Employee Management System
@endcomponent