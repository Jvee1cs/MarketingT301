<x-mail::message>
    # Hi {{ $student->stud_first_name }} {{ $student->stud_last_name }},

    Balik ka na Baby :(
    This is a test email.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>