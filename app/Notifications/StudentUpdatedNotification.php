<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class StudentUpdatedNotification extends Notification
{
    use Queueable;

    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Student: ' . $this->student->stud_first_name. ' has been updated.',
            'student_id' => $this->student->id,
        ];
    }
}
