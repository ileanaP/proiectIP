<?php

namespace App\Http\Controllers;

use App\Feedback;
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

        if ($reason == null) {
            return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'Te rugam sa ne spui cateva cuvinte despre eveniment!']);
        }

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
            return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'Te rugam sa alegi un numar de stelute!']);
        }

        $data = [
            'user_id' => $request->user()->id,
            'event_id' => $eventId,
            'comm' => $reason,
            'stars' => $numberOfStars,
            'created_at' => date('Y-m-d h:i:s'),
        ];

        $alreadyGaveFeedback = Feedback::where(['event_id' => $eventId, 'user_id' => $request->user()->id])->count();

        if ($alreadyGaveFeedback != 0) {
            return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'Deja ai dat feedback pentru acest eveniment! Multumim!']);

        }

        DB::table('feedback')->insert($data);

        return redirect()->route('eventpage', ['id' => $eventId, 'feedbackMessage' => 'Mesajul tau a fost salvat! Multumim!']);
     }


}