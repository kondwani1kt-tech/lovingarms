<?php

$phoneDigits = '+12144125533';

return [
    'company' => 'Loving Arms Home Care, SPC',
    'phone' => '(214) 412-5533',
    'phone_digits' => $phoneDigits,
    'email' => 'thandoclif@gmail.com',
    'service_area' => 'King & Pierce Counties, Washington',
    'response_time' => 'one business day',
    'social' => [
        'linkedin' => env('SOCIAL_LINKEDIN', ''),
        'facebook' => env('SOCIAL_FACEBOOK', ''),
        'instagram' => env('SOCIAL_INSTAGRAM', ''),
        'whatsapp' => env('SOCIAL_WHATSAPP', 'https://wa.me/'.ltrim($phoneDigits, '+')),
    ],
    'analytics_enabled' => (bool) env('ANALYTICS_ENABLED', false),
    'notify_to' => env('NOTIFY_EMAIL', 'thandoclif@gmail.com'),

    'supabase' => [
        'url' => rtrim((string) env('SUPABASE_URL', ''), '/'),
        'anon_key' => env('SUPABASE_ANON_KEY'),
        'service_key' => env('SUPABASE_SERVICE_ROLE_KEY'),
    ],

    'services' => [
        'personal-care' => [
            'title' => 'Personal Care',
            'short' => 'Respectful, hands-on help with the routines that make a house feel like home.',
            'lead' => 'When bathing, dressing or mobility becomes harder, patient support can help a person stay comfortable, safe and independent for longer.',
            'icon' => '♡',
            'includes' => [
                'Bathing and grooming assistance',
                'Dressing and toileting support',
                'Mobility and transfer help',
                'Gentle reminders and check-ins',
            ],
            'good_for' => [
                'Daily routines that have become difficult or tiring',
                'Families who want respectful, consistent support',
                'Care plans that change as needs change',
            ],
            'note' => 'Personal care is subject to assessment, staffing, applicable approvals and the agreed plan of care.',
        ],
        'companionship' => [
            'title' => 'Companionship',
            'short' => 'A familiar, caring presence for conversation, connection and everyday life.',
            'lead' => 'Social contact matters. Companionship support can help reduce isolation and bring steady encouragement into a person’s day.',
            'icon' => '☕',
            'includes' => [
                'Friendly conversation and shared activities',
                'Walks, games, reading and hobbies',
                'Meal companionship and reminders',
                'Supportive presence for families',
            ],
            'good_for' => [
                'Older adults living alone',
                'Family caregivers who need reassurance',
                'People who benefit from regular social connection',
            ],
            'note' => 'Companionship is non-medical support and is shaped around the person’s preferences and routines.',
        ],
        'daily-living-support' => [
            'title' => 'Daily Living Support',
            'short' => 'Practical help with meals, light housekeeping, errands and the small things that add up.',
            'lead' => 'A little practical help can make a big difference to safety, comfort and quality of life at home.',
            'icon' => '⌂',
            'includes' => [
                'Meal planning and preparation',
                'Light housekeeping and laundry',
                'Errands and appointment transportation questions',
                'Organization of daily routines',
            ],
            'good_for' => [
                'Household tasks that have become overwhelming',
                'Families supporting a loved one from a distance',
                'Short-term or ongoing practical support',
            ],
            'note' => 'Tasks are agreed in advance and matched to the care plan, staffing availability and applicable requirements.',
        ],
        'overnight-respite' => [
            'title' => 'Overnight & Respite',
            'short' => 'Flexible support that gives family caregivers a chance to rest.',
            'lead' => 'Caregiving is a full-time job. Respite and overnight support can help families rest while knowing their loved one is not alone.',
            'icon' => '☾',
            'includes' => [
                'Scheduled respite visits',
                'Overnight presence and check-ins',
                'Help with evening and morning routines',
                'Coordination with family caregivers',
            ],
            'good_for' => [
                'Family caregivers needing a break',
                'Short-term recovery or transition periods',
                'Families planning a sustainable care schedule',
            ],
            'note' => 'Overnight availability, duration and coverage are confirmed during the inquiry process.',
        ],
        'memory-support' => [
            'title' => 'Memory Support',
            'short' => 'Patient, respectful topics to discuss when memory changes affect daily life.',
            'lead' => 'Memory changes can affect routine, confidence and safety. We can talk through non-medical support options and next-step questions.',
            'icon' => '✿',
            'includes' => [
                'Consistent routines and familiar cues',
                'Companionship and supervision topics',
                'Family communication planning',
                'Referral questions when clinical care is needed',
            ],
            'good_for' => [
                'Families noticing forgetfulness or confusion',
                'Caregivers supporting a person with memory changes',
                'Families comparing care options',
            ],
            'note' => 'We do not provide medical diagnosis or clinical treatment. Clinical needs should be discussed with qualified health professionals.',
        ],
        'transitional-support' => [
            'title' => 'Transitional Support',
            'short' => 'A conversation starter for support after a hospital stay, rehab or change in routine.',
            'lead' => 'The days after a discharge or major change can be confusing. We can help families think through non-medical support questions.',
            'icon' => '＋',
            'includes' => [
                'Daily routine planning',
                'Medication reminder questions',
                'Home safety checklist discussion',
                'Coordination with family and providers',
            ],
            'good_for' => [
                'Families planning for a discharge',
                'Short-term changes in mobility or confidence',
                'Families who need a clear next step',
            ],
            'note' => 'We do not provide skilled nursing or medical treatment. We can help identify questions to ask qualified providers.',
        ],
        'family-support' => [
            'title' => 'Family Support',
            'short' => 'Clear communication and collaborative planning for the people around the person receiving care.',
            'lead' => 'Families often carry the hardest decisions. We aim to make the conversation clearer, calmer and more practical.',
            'icon' => '♥',
            'includes' => [
                'Care-planning conversations',
                'Regular communication about scheduling',
                'Help identifying next-step questions',
                'Privacy-respecting family updates',
            ],
            'good_for' => [
                'Adult children coordinating care',
                'Long-distance family caregivers',
                'Families comparing care options',
            ],
            'note' => 'Communication is agreed with the client or authorized representative and respects privacy preferences.',
        ],
        'care-coordination' => [
            'title' => 'Care Coordination',
            'short' => 'A thoughtful first conversation to understand needs and point families in the right direction.',
            'lead' => 'If you are not sure what kind of help is needed, start here. We will listen, ask practical questions and discuss appropriate next steps.',
            'icon' => '✦',
            'includes' => [
                'Needs and routine discussion',
                'Service-area and eligibility questions',
                'Payment and authorization questions',
                'Referrals when a need is outside our scope',
            ],
            'good_for' => [
                'Families at the very beginning',
                'People comparing home care options',
                'Facilities exploring staffing conversations',
            ],
            'note' => 'A conversation does not guarantee service availability, authorization or coverage.',
        ],
    ],

    'areas' => [
        'seattle' => ['name' => 'Seattle', 'county' => 'King County', 'nearby' => 'Ballard, West Seattle, North Seattle and surrounding neighborhoods'],
        'bellevue' => ['name' => 'Bellevue', 'county' => 'King County', 'nearby' => 'Redmond, Kirkland and the Eastside'],
        'renton' => ['name' => 'Renton', 'county' => 'King County', 'nearby' => 'South King County and nearby communities'],
        'kent' => ['name' => 'Kent', 'county' => 'King County', 'nearby' => 'South King County and surrounding areas'],
        'federal-way' => ['name' => 'Federal Way', 'county' => 'King County', 'nearby' => 'South King County and nearby neighborhoods'],
        'tacoma' => ['name' => 'Tacoma', 'county' => 'Pierce County', 'nearby' => 'Central and North Tacoma and surrounding areas'],
        'puyallup' => ['name' => 'Puyallup', 'county' => 'Pierce County', 'nearby' => 'Sumner, South Hill and nearby communities'],
        'lakewood' => ['name' => 'Lakewood', 'county' => 'Pierce County', 'nearby' => 'South Pierce County and surrounding areas'],
    ],

    'faqs' => [
        [
            'question' => 'What kind of help can we talk about?',
            'answer' => 'We discuss non-medical home care topics such as personal care, companionship, daily living support, respite planning and care coordination. Availability depends on assessment, staffing and applicable requirements.',
        ],
        [
            'question' => 'Are you currently licensed?',
            'answer' => 'Our licensing application has been submitted and is awaiting approval. We do not currently represent Loving Arms as licensed or approved to provide regulated home care services or to participate in Medicaid. Services begin only when all required approvals, registrations and authorizations are in place.',
        ],
        [
            'question' => 'How does home care start?',
            'answer' => 'Start with a conversation. We listen to the person’s routines, preferences and goals, discuss what support may fit, explain next-step requirements and confirm what can be provided before anything begins.',
        ],
        [
            'question' => 'What is the difference between non-medical home care and home health care?',
            'answer' => 'Non-medical home care focuses on assistance with everyday activities and companionship. Home health care is clinical care ordered by a health professional. If clinical care is needed, we can help identify questions to ask qualified providers.',
        ],
        [
            'question' => 'Do you accept Medicaid or insurance?',
            'answer' => 'Medicaid coverage and insurance benefits depend on eligibility, assessment, authorization and provider participation. We will not represent a service as covered until participation and authorization are confirmed.',
        ],
        [
            'question' => 'How much does care cost?',
            'answer' => 'Costs depend on the type of support, schedule and agreed plan. During an inquiry we can discuss the information needed for an estimate without asking you to send sensitive financial details through the website.',
        ],
        [
            'question' => 'Do I need a long-term contract?',
            'answer' => 'We will explain service terms, scheduling expectations and cancellation requirements before care begins. No agreement should be signed without a clear review of those terms.',
        ],
        [
            'question' => 'What happens if a caregiver is unavailable?',
            'answer' => 'Reliable communication matters. We will explain coverage expectations, backup plans and escalation contacts before services start so families know who to call and what to expect.',
        ],
        [
            'question' => 'How quickly can care begin?',
            'answer' => 'Timing depends on assessment, staffing, required approvals and the agreed plan. We will give you a realistic timeline during the inquiry process rather than promise availability we cannot confirm.',
        ],
        [
            'question' => 'Do you serve my city?',
            'answer' => 'We focus on King and Pierce Counties. Send your city or ZIP code in the inquiry form and we will confirm whether your location is within the service area we can discuss.',
        ],
        [
            'question' => 'Is the website monitored for emergencies?',
            'answer' => 'No. For emergencies, call 911. General inquiries are reviewed during business hours and we aim to respond within one business day.',
        ],
        [
            'question' => 'How do facilities start a staffing conversation?',
            'answer' => 'Use the facility staffing request form to share the facility type, roles needed, shifts and desired start date. We will confirm credentials, scope, orientation, supervision and contract terms before any assignment is accepted.',
        ],
    ],

    'standards' => [
        [
            'title' => 'Listen before recommending',
            'text' => 'We start with the person’s routines, preferences, goals and concerns — not a one-size-fits-all checklist.',
            'icon' => '01',
        ],
        [
            'title' => 'Plan with the family',
            'text' => 'Care conversations include the client or authorized representative and respect privacy, culture and personal choice.',
            'icon' => '02',
        ],
        [
            'title' => 'Match thoughtfully',
            'text' => 'Skills, personality, schedule and location all matter when discussing a caregiver match.',
            'icon' => '03',
        ],
        [
            'title' => 'Verify and prepare',
            'text' => 'Credential, reference and required background checks are part of the hiring process before assignments.',
            'icon' => '04',
        ],
        [
            'title' => 'Communicate clearly',
            'text' => 'Families receive agreed updates and a clear point of contact for scheduling or concerns.',
            'icon' => '05',
        ],
        [
            'title' => 'Review and adjust',
            'text' => 'Needs change. We plan for regular review and adjustment of the agreed support.',
            'icon' => '06',
        ],
    ],

    'career_roles' => [
        [
            'title' => 'Certified Nursing Assistant (CNA)',
            'text' => 'Hands-on support with daily routines, personal care and respectful companionship.',
            'icon' => '♡',
        ],
        [
            'title' => 'Home Care Aide / Caregiver',
            'text' => 'Practical, person-centered help that supports independence at home.',
            'icon' => '⌂',
        ],
        [
            'title' => 'Companion Caregiver',
            'text' => 'Steady conversation, shared activities and a reassuring presence.',
            'icon' => '☕',
        ],
        [
            'title' => 'Facility Staffing',
            'text' => 'CNA and caregiver coverage conversations for healthcare facilities.',
            'icon' => '✦',
        ],
    ],

    'reviews' => [],
];
