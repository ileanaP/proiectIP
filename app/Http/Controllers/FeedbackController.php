<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        $eventId = $request->get('eventId');

        $oneStar = $request->get('1');
        $twoStars = $request->get('2');
        $threeStars = $request->get('3');
        $fourStars = $request->get('4');
        $fiveStars = $request->get('5');

        $reason = $request->get('feedbackReason');

        if ($oneStar !== null) {
            $numberOfStars = 1;
        } elseif ($twoStars !== null) {
            $numberOfStars = 2;
        } elseif ($threeStars !== null) {
            $numberOfStars = 3;
        } elseif ($fourStars !== null) {
            $numberOfStars = 4;
        } elseif ($fiveStars != null) {
            $numberOfStars = 5;
        } else {
            return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'You have to fill at least one star!']);
        }

        $data = [
            'user_id' => $request->user()->id,
            'event_id' => $eventId,
            'comm' => $reason,
            'stars' => $numberOfStars
        ];

        DB::table('feedback')->insert($data);

        return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'Your message was saved! Thank you!']);
     }


}