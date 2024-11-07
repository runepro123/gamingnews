<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactConfiguration;

class ContactConfigurationController extends Controller
{
    public function showContactConfigurationForm() {
        $data['headerTitle'] = 'Contact Configuration';
        
        $data['contactConfiguration'] = ContactConfiguration::first();

        return view('backend.admin.settings.contact-configuration', $data);
    }

    public function updateContactConfiguration(Request $request) {
        $request->validate([
            'address' => 'required',
            'house_no' => 'required',
            'contact_number' => 'required',
            'contact_schedule' => 'required',
            'support_email' => 'required|email',
            'support_message' => 'required',
        ]);

        $contactConfiguration = ContactConfiguration::first();
        if (!$contactConfiguration) {
            $contactConfiguration = new ContactConfiguration();
        }

        $contactConfiguration->address = $request->address;
        $contactConfiguration->house_no = $request->house_no;
        $contactConfiguration->contact_number = $request->contact_number;
        $contactConfiguration->contact_schedule = $request->contact_schedule;
        $contactConfiguration->support_email = $request->support_email;
        $contactConfiguration->support_message = $request->support_message;
        $contactConfiguration->save();

        return redirect()->back()->with("success", "Contact configuration data successfully updated.");
    }
}
