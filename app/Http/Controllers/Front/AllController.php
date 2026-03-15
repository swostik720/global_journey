<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Team;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Category;
use App\Models\Subscribe;
use App\Models\SiteSetting;
use App\Models\StudyAbroad;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\TestPreparation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Admin\ContactStoreRequest;
use App\Http\Requests\Front\EnquiryStoreRequest;
use App\Http\Requests\Front\SubscribeStoreRequest;
use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\InterviewPreparation;
use App\Models\EnrollNow;
use App\Models\Gallery;
use Illuminate\Support\Facades\Log;

class AllController extends Controller
{
    public function documentChecklist($countryId)
    {
        $country = Country::findOrFail($countryId);
        $checklist = \App\Models\DocumentChecklist::where('country_id', $countryId)->first();
        return view('frontend.study_abroad.document_checklist', compact('country', 'checklist'));
    }
    public function whyCountry($countryId)
    {
        $country = Country::findOrFail($countryId);
        $whyCountries = \App\Models\WhyCountry::where('country_id', $countryId)->get();
        return view('frontend.study_abroad.why_country', compact('country', 'whyCountries'));
    }

    public function collegeAndUniversity($countryId)
    {
        $country = Country::findOrFail($countryId);
        $colleges = \App\Models\CollegeAndUniversity::where('country_id', $countryId)->get();
        return view('frontend.study_abroad.college_and_university', compact('country', 'colleges'));
    }

    public function countryGuide($countryId)
    {
        $country = Country::findOrFail($countryId);
        $countryGuides = \App\Models\CountryGuide::where('country_id', $countryId)->get();
        return view('frontend.study_abroad.country_guide', compact('country', 'countryGuides'));
    }
    public function index()
    {
        $testimonials = Testimonial::active()
            ->select(['image', 'name', 'address', 'description', 'rating'])
            ->latest()
            ->get();
        $studyabroads = StudyAbroad::active()
            ->select(['id', 'image', 'title', 'slug', 'short_description'])
            ->latest()
            ->get();

        $blogs = Blog::active()
            ->select(['image', 'title', 'slug', 'user_id', 'blog_date', 'short_description'])
            ->latest()
            ->limit(6)
            ->get();

        return view('frontend.mainindex', compact('testimonials', 'studyabroads', 'blogs'));
    }
    public function aboutIndex()
    {
        $teams = Team::active()
            ->select(['image', 'name', 'slug', 'responsibility', 'fb_link', 'twitter_link', 'linkedin_link', 'instagram_link'])
            ->orderBy('rank', 'asc')
            ->get();
        return view('frontend.about.index', compact('teams'));
    }
    public function studyAbroadIndex()
    {
        $countries = Country::whereHas('studyabroads', function ($query) {
            $query->active();
        })
            ->active()
            ->orderBy('name', 'asc')    // Sort countries alphabetically by name
            ->latest()
            ->get();

        $studyabroads = StudyAbroad::active()->latest()->get();

        return view('frontend.study_abroad.index', compact('countries', 'studyabroads'));
    }
    public function studyAbroadDetails($slug, Request $request)
    {
        $study = StudyAbroad::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $country = $study->country;
        $checklist = null;
        $interviewPreparationSlug = null;
        $why_text = null;
        if ($country) {
            $checklist = \App\Models\DocumentChecklist::where('country_id', $country->id)
                ->first();
            $interviewPrep = \App\Models\InterviewPreparation::where('country_id', $country->id)
                ->where('status', true)
                ->first();
            if ($interviewPrep) {
                $interviewPreparationSlug = $interviewPrep->slug;
            }
            $why_text = $country->why_text ?? null;
        }

        return view('frontend.study_abroad.details', compact('study', 'country', 'checklist', 'interviewPreparationSlug', 'why_text'));
    }

    public function contactUsIndex()
    {
        $branches = Branch::active()
            ->select(['name', 'email', 'phone', 'contact_address', 'working_hours'])
            ->latest()
            ->get();

        return view('frontend.contact.index', compact('branches'));
    }

    public function storeContact(ContactStoreRequest $request): RedirectResponse
    {
        $ipAddress = $request->ip();
        $key = 'contact-form:' . $ipAddress;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        DB::beginTransaction();
        try {
            // Get branch from cookie
            $branchId = $request->cookie('selected_branch');

            // Merge branch_id into validated data
            $contactData = $request->validated();
            $contactData['branch_id'] = $branchId;

            // Save contact
            $contact = Contact::create($contactData);

            // Rate limiting
            RateLimiter::hit($key, 60 * 3); // Block for 3 minutes after 3 attempts

            // Determine recipient email
            $site_setting = SiteSetting::first();
            $branch = Branch::find($branchId);
            $recipientEmail = $branch ? $branch->email : ($site_setting->email ?? 'contact@globaljourneyedu.com.np');

            // Prepare email data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'email1' => $recipientEmail,
                'subject' => 'Contact Form',
                'phone' => $request->phone,
                'contact_message' => $request->contact_message,
                'address' => $request->address,
                'interested_country' => $request->interested_country,
                'last_qualification' => $request->last_qualification,
                'test_preparation' => $request->test_preparation,
                'branch' => $branch,
            ];

            // Send email
            try {
                Mail::send('admin.emails.contact_form_submitted', $data, function ($message) use ($data) {
                    $message->to($data['email1'])
                        ->subject($data['subject'])
                        ->replyTo($data['email']);
                });

                Log::info("Contact form email sent successfully to {$data['email1']}");
            } catch (\Swift_TransportException $e) {
                Log::error("SMTP Error sending email to {$data['email1']}: " . $e->getMessage());
            } catch (\Exception $e) {
                Log::error("Unexpected error sending email to {$data['email1']}: " . $e->getMessage());
            }

            DB::commit();

            return redirect()->back()->with('success', 'Your request has been sent successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Contact form save error: " . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }

    public function storeEnrollNow(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'phone'               => 'required|string|max:20',
            'test_preparation_id' => 'required|exists:test_preparations,id',
        ]);

        // Rate limiting
        $ipAddress = $request->ip();
        $key = 'enrollNow-form:' . $ipAddress;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        DB::beginTransaction();
        try {
            $branchId = $request->cookie('selected_branch');

            // Save enrollment with branch_id
            $enrollNow = EnrollNow::create([
                'name'                => $request->name,
                'email'               => $request->email,
                'phone'               => $request->phone,
                'test_preparation_id' => $request->test_preparation_id,
                'branch_id'           => $branchId,
            ]);

            // Record attempt for rate limiter
            RateLimiter::hit($key, 60 * 3); // block for 3 minutes

            // Determine recipient email
            $siteSetting = SiteSetting::first();
            $branch = Branch::find($branchId);
            $recipientEmail = $branch ? $branch->email : ($siteSetting->email ?? 'contact@globaljourneyedu.com.np');

            // Prepare email data
            $data = [
                'name'             => $request->name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'test_preparation' => optional($enrollNow->testPreparation)->title,
                'branch'        => $branch,
            ];

            // Send email
            try {
                Mail::send('admin.emails.enrollnow_form_submitted', $data, function ($message) use ($data, $recipientEmail) {
                    $message->to($recipientEmail)
                        ->subject('New Enrollment Submission')
                        ->replyTo($data['email']);
                });

                Log::info("EnrollNow email sent successfully to {$recipientEmail}");
            } catch (\Swift_TransportException $e) {
                Log::error("SMTP Error sending EnrollNow email to {$recipientEmail}: " . $e->getMessage());
            } catch (\Exception $e) {
                Log::error("Unexpected error sending EnrollNow email to {$recipientEmail}: " . $e->getMessage());
            }

            DB::commit();

            return redirect()->back()->with('success', 'Your enrollment request has been submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('EnrollNow submission failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your enrollment. Please try again.');
        }
    }

    public function testPreparationIndex()
    {
        $testpreparations = TestPreparation::active()
            ->select(['image', 'title', 'slug', 'short_description'])
            ->latest()
            ->get();
        return view('frontend.test_preparation.index', compact('testpreparations'));
    }
    public function testPreparationDetails($slug, Request $request)
    {
        $testpreparation = TestPreparation::where('slug', $slug)
            ->active()
            ->firstOrFail();

        return view('frontend.test_preparation.details', compact('testpreparation'));
    }
    public function blogIndex()
    {
        $blogs = Blog::active()
            ->select(['image', 'title', 'slug', 'user_id', 'blog_date', 'short_description', 'category_id', 'faqs'])
            ->latest()
            ->paginate(3);
        return view('frontend.blogs.index', compact('blogs'));
    }
    public function blogDetails($slug, Request $request)
    {
        $blog = Blog::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $categories = Category::active()
            ->select(['id', 'name'])
            ->withCount('blogs')
            ->having('blogs_count', '>', 0)
            ->get();
        $relatedPosts = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->active()
            ->latest()
            ->limit(4)
            ->get();
        $previousBlog = Blog::where('id', '<', $blog->id)
            ->active()
            ->latest('id')
            ->first();

        $nextBlog = Blog::where('id', '>', $blog->id)
            ->active()
            ->first();

        return view('frontend.blogs.details', compact('blog', 'categories', 'relatedPosts', 'previousBlog', 'nextBlog'));
    }
    public function storeSubscribe(SubscribeStoreRequest $request): RedirectResponse
    {
        $ipAddress = $request->ip();
        $key = 'subscribe-form:' . $ipAddress;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        DB::beginTransaction();
        try {
            $subscribe = Subscribe::create($request->validated());


            RateLimiter::hit($key, 60 * 3); // Block for 3 minutes after 3 attempts

            DB::commit();

            return redirect()->back()->with('success', 'You have been subscribed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }
    public function enquiryUsIndex()
    {
        $branches = Branch::active()
            ->select(['name', 'email', 'phone', 'contact_address', 'working_hours'])
            ->latest()
            ->get();

        $studyabroads = StudyAbroad::active()->latest()->get();

        return view('frontend.enquiry.index', compact('branches', 'studyabroads'));
    }
    public function storeEnquiry(EnquiryStoreRequest $request): RedirectResponse
    {
        $ipAddress = $request->ip();
        $key = 'enquiry-form:' . $ipAddress;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        DB::beginTransaction();
        try {
            $branchId = $request->cookie('selected_branch');

            // Save enquiry with branch_id
            $enquiry = Enquiry::create(array_merge($request->validated(), [
                'branch_id' => $branchId,
            ]));

            // Record attempt for rate limiter
            RateLimiter::hit($key, 60 * 3); // block for 3 minutes

            // Determine recipient email
            $siteSetting = SiteSetting::first();
            $branch = Branch::find($branchId);
            $recipientEmail = $branch ? $branch->email : ($siteSetting->email ?? 'contact@globaljourneyedu.com.np');

            // Prepare email data
            $data = [
                'name'           => $request->name,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'enquiry_message' => $request->enquiry_message,
                'branch'          => $branch,
                'subject'        => 'Enquiry Form',
                'email1'         => $recipientEmail,
            ];

            // Send email
            try {
                Mail::send('admin.emails.enquiry_form_submitted', $data, function ($message) use ($data) {
                    $message->to($data['email1'])
                        ->subject($data['subject'])
                        ->replyTo($data['email']);
                });

                Log::info("Enquiry email sent successfully to {$data['email1']}");
            } catch (\Swift_TransportException $e) {
                Log::error("SMTP Error sending Enquiry email to {$data['email1']}: " . $e->getMessage());
            } catch (\Exception $e) {
                Log::error("Unexpected error sending Enquiry email to {$data['email1']}: " . $e->getMessage());
            }

            DB::commit();

            return redirect()->back()->with('success', 'Your enquiry has been submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Enquiry form save error: " . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your enquiry. Please try again.');
        }
    }

    public function interviewPreparationIndex()
    {
        $interviewPreparations = InterviewPreparation::where('status', true)
            ->select(['id', 'title', 'slug', 'description', 'image'])
            ->latest()
            ->get();
        return view('frontend.interview_preparation.index', compact('interviewPreparations'));
    }

    public function interviewPreparationDetails($slug)
    {
        $interviewPreparation = InterviewPreparation::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();
        return view('frontend.interview_preparation.details', compact('interviewPreparation'));
    }

    public function galleryIndex()
    {
        $galleries = Gallery::with('galleryCategory')->latest()->paginate(9);
        return view('frontend.gallery.index', compact('galleries'));
    }

    public function galleryDetails($id)
    {
        $gallery = Gallery::with('galleryCategory')->findOrFail($id);
        return view('frontend.gallery.details', compact('gallery'));
    }
}
