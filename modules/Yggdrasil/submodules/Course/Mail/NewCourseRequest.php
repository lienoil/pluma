<?php

namespace Course\Mail;

use Course\Models\Course;
use Course\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCourseRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The course instance.
     *
     * @var \Course\Models\Course
     */
    public $course;

    /**
     * The student instance.
     *
     * @var \Course\Models\User
     */
    public $student;

    /**
     * Create a new message instance.
     *
     * @param \Course\Models\Course $course
     * @param \Course\Models\User   $student
     * @param string $subject
     */
    public function __construct(Course $course, User $student, $subject = "")
    {
        $this->course = $course;

        $this->student = $student;

        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dateRequested = $this->course
                              ->users()
                              ->where('users.id', $this->student->id)
                              ->first()
                              ->pivot
                              ->enrolled_at;
        $dateRequested = date(settings('pretty_date_format', 'F d, Y'), strtotime($dateRequested));

        return $this->subject($this->subject)
                    ->from(settings('site_email'))
                    ->view("Course::emails.requests.new-course-request")
                    ->with(compact('dateRequested'));
    }
}
