<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller {

    public function add(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:30',
            'age' => 'required|integer',
            'phone' => 'required|integer',
            'question' => 'string'
        ]);

        $feedback = new Feedback;

        $feedback->name = $request->name;
        $feedback->age = $request->age;
        $feedback->phone = $request->phone;
        $feedback->question = $request->question;

        $feedback->sended = false;
        $feedback->send_date = null;

        $feedback->save();

        return response()->json(['ok' => true]);
    }
}