<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;

class QueuedJobsController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $job = new SendEmail($user);

        dispatch($job);
    }
}
