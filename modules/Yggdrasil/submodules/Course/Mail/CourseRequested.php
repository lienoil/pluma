<?php

namespace Course\Mail;

use Course\Models\Course;
use Course\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseRequested extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The course instance.
     *
     * @var \Course\Models\Course
     */
    protected $course;

    /**
     * The student instance.
     *
     * @var \Course\Models\User
     */
    protected $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course, User $student)
    {
        $this->course = $course;

        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("Course::emails.requests.requested", [
                'student' => $this->student,
            ]);
    }
}
