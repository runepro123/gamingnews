<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailConfiguration;

class MailConfigurationController extends Controller
{
    public function showMailConfigurationForm() {
        $data['headerTitle'] = 'Mail Configuration';
        $data['mailConfiguration'] = MailConfiguration::first();

        return view('backend.admin.settings.mail-configuration', $data);
    }

    public function updateMailConfiguration(Request $request) {
        $this->validate($request, [
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
            'support_email' => 'required'
        ]);

        $mailConfiguration = MailConfiguration::first();

        $mailConfiguration->mail_host = $request->mail_host;
        $mailConfiguration->mail_port = $request->mail_port;
        $mailConfiguration->mail_username = $request->mail_username;
        $mailConfiguration->mail_password = $request->mail_password;
        $mailConfiguration->mail_encryption = $request->mail_encryption;
        $mailConfiguration->mail_from_address = $request->mail_from_address;
        $mailConfiguration->support_email = $request->support_email;
        $mailConfiguration->save();

        return redirect()->back()->with('success', 'Mail configuration updated.');
    }
}
