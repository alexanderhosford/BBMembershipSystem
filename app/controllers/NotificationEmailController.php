<?php

use BB\Notifications\Notification;
use BB\Repo\UserRepository;
use BB\Validators\EmailNotificationValidator;

class NotificationEmailController extends \BaseController {


    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EmailNotificationValidator
     */
    private $emailNotificationValidator;
    /**
     * @var Notification
     */
    private $notifications;

    /**
     * @param UserRepository             $userRepository
     * @param EmailNotificationValidator $emailNotificationValidator
     */
    public function __construct(UserRepository $userRepository, EmailNotificationValidator $emailNotificationValidator, Notification $notifications)
    {
        $this->userRepository = $userRepository;
        $this->emailNotificationValidator = $emailNotificationValidator;
        $this->notifications = $notifications;
    }

    public function create()
    {
        return View::make('notificationemail.create');
    }

    public function store()
    {
        $input = Input::only('subject', 'message', 'send_to_all');

        $this->emailNotificationValidator->validate($input);

        if ($input['send_to_all']) {
            $users = $this->userRepository->getActive();
            foreach ($users as $user) {
                $notification = new \BB\Mailer\UserMailer($user);
                $notification->sendNotificationEmail($input['subject'], nl2br($input['message']));
            }
        } else {
            $notification = new \BB\Mailer\UserMailer(Auth::user());
            $notification->sendNotificationEmail($input['subject'], nl2br($input['message']));
        }

        $this->notifications->success("Email Queued to Send");
        return Redirect::route('notificationemail.create');
    }
} 