<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        $oneStar = $request->get('1');
        $twoStars = $request->get('2');
        $threeStars = $request->get('3');
        $fourStars = $request->get('4');
        $fiveStars = $request->get('5');

        //todo - make stars mandatory
        if ($oneStar !== null) {
            $numberOfStars = 1;
        } elseif ($twoStars !== null) {
            $numberOfStars = 2;
        } elseif ($threeStars !== null) {
            $numberOfStars = 3;
        } elseif ($fourStars !== null) {
            $numberOfStars = 4;
        } else {
            $numberOfStars = 5;
        }

        $reason = $request->get('feedbackReason');

        $data = [
            'user_id' => $request->user()->id,
            'event_id' => $request->get('eventId'),
            'comm' => $reason,
            'stars' => $numberOfStars
        ];

        DB::table('feedback')->insert($data);

        return view('pages.eventPage');
     }


}