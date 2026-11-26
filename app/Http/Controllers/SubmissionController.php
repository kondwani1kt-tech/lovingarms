<?php

namespace App\Http\Controllers;

use App\Mail\StaffNotification;
use App\Mail\SubmissionConfirmation;
use App\Models\Application;
use App\Models\Inquiry;
use App\Models\StaffingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubmissionController extends Controller
{
    private function isSpam(Request $r): bool
    {
        return $r->filled('website');
    }

    public function inquiry(Request $r)
    {
        if ($this->isSpam($r)) {
            return redirect()->route('contact')->with('success', 'Thank you. Our team will be in touch.');
        }

        $d = $r->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:40',
            'email' => 'required|email|max:190',
            'topic' => ['required', Rule::in(Inquiry::TOPICS)],
            'relationship' => ['nullable', Rule::in(array_keys(Inquiry::RELATIONSHIPS))],
            'zip' => ['nullable', 'string', 'max:10', 'regex:/^\d{5}(-\d{4})?$/'],
            'urgency' => ['nullable', Rule::in(array_keys(Inquiry::URGENCIES))],
            'source' => ['nullable', Rule::in(array_keys(Inquiry::SOURCES))],
            'preferred_contact' => ['nullable', Rule::in(array_keys(Inquiry::PREFERRED_CONTACT))],
            'message' => 'required|string|max:5000',
            'consent' => 'accepted',
        ]);

        unset($d['consent']);

        $i = Inquiry::create($d);

        $relationship = $i->relationship ? (Inquiry::RELATIONSHIPS[$i->relationship] ?? $i->relationship) : '-';
        $urgency = $i->urgency ? (Inquiry::URGENCIES[$i->urgency] ?? $i->urgency) : '-';
        $source = $i->source ? (Inquiry::SOURCES[$i->source] ?? $i->source) : '-';
        $preferredContact = $i->preferred_contact ? (Inquiry::PREFERRED_CONTACT[$i->preferred_contact] ?? $i->preferred_contact) : '-';

        StaffNotification::notify('New inquiry from '.$i->name, [
            'Name' => $i->name,
            'Phone' => $i->phone ?: '-',
            'Email' => $i->email,
            'Topic' => $i->topic,
            'Relationship' => $relationship,
            'ZIP' => $i->zip ?: '-',
            'Urgency' => $urgency,
            'How they found us' => $source,
            'Preferred contact' => $preferredContact,
            'Message' => $i->message,
        ], route('admin.records.show', ['type' => 'inquiries', 'id' => $i->id]));

        SubmissionConfirmation::sendTo(
            $i->email,
            $i->name,
            'We received your inquiry',
            'Thank you for contacting '.config('loving.company').'. We have received your inquiry and will be in touch.',
            [
                'Topic' => $i->topic,
                'Preferred contact' => $preferredContact,
                'Response time' => 'We aim to respond within '.config('loving.response_time').'.',
                'Questions' => 'Call '.config('loving.phone').' or email '.config('loving.email').'.',
            ],
            route('contact')
        );

        return redirect()->route('contact')->with('success', 'Thank you. Your inquiry has been received and our team will be in touch.');
    }

    public function application(Request $r)
    {
        if ($this->isSpam($r)) {
            return redirect()->route('careers')->with('success', 'Thank you for your interest.');
        }

        $d = $r->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:190',
            'phone' => 'required|string|max:40',
            'role_applied' => ['required', Rule::in(Application::ROLES)],
            'city' => 'nullable|string|max:120',
            'years_experience' => 'required|integer|min:0|max:60',
            'availability' => 'required|string|max:3000',
            'credentials' => 'required|string|max:3000',
            'references_info' => 'required|string|max:3000',
            'message' => 'nullable|string|max:3000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'consent' => 'accepted',
        ]);

        unset($d['consent']);

        $resumePath = null;
        if ($r->hasFile('resume')) {
            $resumePath = $r->file('resume')->store('applications', 'public') ?: null;
        }
        unset($d['resume']);
        $d['resume_path'] = $resumePath;

        $a = Application::create($d);

        $rows = [
            'Name' => $a->name,
            'Role' => $a->role_applied,
            'Phone' => $a->phone,
            'Email' => $a->email,
            'City' => $a->city ?: '-',
            'Years of experience' => $a->years_experience,
            'Availability' => $a->availability,
            'Credentials' => $a->credentials,
            'References' => $a->references_info,
        ];

        if ($a->message) {
            $rows['Message'] = $a->message;
        }
        if ($a->resume_path) {
            $rows['Resume'] = 'Resume uploaded';
        }

        StaffNotification::notify('New caregiver application: '.$a->name, $rows, route('admin.records.show', ['type' => 'applications', 'id' => $a->id]));

        SubmissionConfirmation::sendTo(
            $a->email,
            $a->name,
            'We received your application',
            'Thank you for your interest in joining '.config('loving.company').'. We have received your application.',
            [
                'Role' => $a->role_applied,
                'Next step' => 'Our team will review your interest and share next steps if a suitable opportunity is available.',
                'Response time' => 'We aim to respond within '.config('loving.response_time').'.',
                'Questions' => 'Call '.config('loving.phone').' or email '.config('loving.email').'.',
            ],
            route('careers')
        );

        return redirect()->route('careers')->with('success', 'Thank you for your interest in joining Loving Arms. We will share next steps if a suitable opportunity is available.');
    }

    public function staffing(Request $r)
    {
        if ($this->isSpam($r)) {
            return redirect()->route('staffing')->with('success', 'Thank you. Our team will be in touch.');
        }

        $d = $r->validate([
            'facility_name' => 'required|string|max:190',
            'facility_type' => ['required', Rule::in(StaffingRequest::FACILITY_TYPES)],
            'contact_name' => 'required|string|max:150',
            'email' => 'required|email|max:190',
            'phone' => 'required|string|max:40',
            'roles_needed' => 'required|string|max:190',
            'shifts_needed' => 'required|string|max:3000',
            'start_date' => 'nullable|date|after_or_equal:today',
            'message' => 'nullable|string|max:3000',
            'consent' => 'accepted',
        ]);

        unset($d['consent']);

        $s = StaffingRequest::create($d);

        $rows = [
            'Facility' => $s->facility_name,
            'Type' => $s->facility_type,
            'Contact' => $s->contact_name,
            'Phone' => $s->phone,
            'Email' => $s->email,
            'Roles needed' => $s->roles_needed,
            'Shifts needed' => $s->shifts_needed,
            'Desired start' => $s->start_date ?: '-',
        ];

        if ($s->message) {
            $rows['Message'] = $s->message;
        }

        StaffNotification::notify('New facility staffing request: '.$s->facility_name, $rows, route('admin.records.show', ['type' => 'staffing', 'id' => $s->id]));

        SubmissionConfirmation::sendTo(
            $s->email,
            $s->contact_name,
            'We received your staffing request',
            'Thank you for contacting '.config('loving.company').'. We have received your facility staffing request.',
            [
                'Facility' => $s->facility_name,
                'Roles needed' => $s->roles_needed,
                'Desired start' => $s->start_date ?: 'To be confirmed',
                'Response time' => 'We aim to respond within '.config('loving.response_time').'.',
                'Questions' => 'Call '.config('loving.phone').' or email '.config('loving.email').'.',
            ],
            route('staffing')
        );

        return redirect()->route('staffing')->with('success', 'Thank you. Your staffing request has been received and our team will contact you to confirm requirements.');
    }
}
