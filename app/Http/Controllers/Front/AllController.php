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

class AllController extends Controller
{
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

        return view('frontend.study_abroad.details', compact('study'));
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
            $contact = Contact::create($request->validated());

            RateLimiter::hit($key, 60 * 3); // Block for 3 minutes after 3 attempts

            $site_setting = SiteSetting::first();
            $recipientEmail = 'contact@globaljourneyedu.com.np';
            if ($site_setting && !empty($site_setting->email)) {
                $recipientEmail = $site_setting->email;
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'email1' => $recipientEmail,
                'subject' => 'Contact Form',
                'phone' => $request->phone,
                'contact_message' => $request->contact_message,
            ];

            Mail::send('admin.emails.contact_form_submitted', $data, function ($message) use ($data) {
                $message->to($data['email1'])->subject($data['subject'])->replyTo($data['email']);
            });

            DB::commit();

            return redirect()->back()->with('success', 'Your request has been sent successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
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
            ->select(['image', 'title', 'slug', 'user_id', 'blog_date', 'short_description'])
            ->latest()
            ->paginate(6);
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
            $enquiry = Enquiry::create($request->validated());

            RateLimiter::hit($key, 60 * 3); // Block for 3 minutes after 3 attempts

            $site_setting = SiteSetting::first();
            $recipientEmail = 'contact@globaljourneyedu.com.np';
            if ($site_setting && !empty($site_setting->email)) {
                $recipientEmail = $site_setting->email;
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'email1' => $recipientEmail,
                'subject' => 'Enquiry Form',
                'phone' => $request->phone,
                'address' => $request->address,
                'enquiry_message' => $request->enquiry_message,
            ];

            Mail::send('admin.emails.enquiry_form_submitted', $data, function ($message) use ($data) {
                $message->to($data['email1'])->subject($data['subject'])->replyTo($data['email']);
            });

            DB::commit();

            return redirect()->back()->with('success', 'Your request has been sent successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again.');
        }
    }
}
