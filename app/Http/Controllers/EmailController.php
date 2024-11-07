<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function sendEmail(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        
        $email = new Email;
        $email->name = $request->name;
        $email->email = $request->email;
        $email->subject = $request->subject;
        $email->message = $request->message;
        $email->save();

        return redirect()->back()->with("success", "Email sent successfully.");
    }

    public function emailList() {
        $data['headerTitle'] = 'Email List';
        $data['emails'] = Email::latest()->get();

        return view('backend.admin.emails.index', $data);
    }

    public function delete($id) {
        $email = Email::find($id);
    
        if (!empty($email)) {
            $email->delete();
            
            return redirect('email/list')->with("success", "Email successfully deleted.");
        } else {
            abort(404);
        }
    }


}
