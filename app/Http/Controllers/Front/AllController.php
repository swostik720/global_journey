<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog;
use App\Models\Team;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Category;
use App\Models\Subscribe;
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
use App\Models\BlogAuthor;
use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\InterviewPreparation;
use App\Models\EnrollNow;
use App\Models\Gallery;
use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AllController extends Controller
{
    private const CONTACT_EMAIL = 'info@globaljourneyedu.com.np';

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
            ->with(['author:id,name', 'category:id,name'])
            ->select(['id', 'image', 'title', 'slug', 'blog_author_id', 'user_id', 'blog_date', 'short_description', 'category_id', 'faqs'])
            ->latest()
            ->limit(3)
            ->get();

        $hasMoreBlogs = Blog::active()->count() > 3;

        $homepageFaqs = Faq::active()
            ->select(['id', 'question', 'answer'])
            ->orderBy('sort_order', 'asc')
            ->latest('id')
            ->limit(6)
            ->get();

        $homepageFaqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $homepageFaqs
                ->filter(function ($faq) {
                    return filled($faq->question) && filled($faq->answer);
                })
                ->map(function ($faq) {
                    $cleanAnswer = trim((string) preg_replace('/\s+/u', ' ', strip_tags((string) $faq->answer)));

                    return [
                        '@type' => 'Question',
                        'name' => trim((string) $faq->question),
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $cleanAnswer,
                        ],
                    ];
                })
                ->values()
                ->all(),
        ];

        if (empty($homepageFaqSchema['mainEntity'])) {
            $homepageFaqSchema = null;
        }

        return view('frontend.mainindex', compact('testimonials', 'studyabroads', 'blogs', 'hasMoreBlogs', 'homepageFaqs', 'homepageFaqSchema'));
    }
    public function aboutIndex()
    {
        $teams = Team::active()
            ->select(['image', 'name', 'slug', 'email', 'phone', 'responsibility', 'fb_link', 'twitter_link', 'linkedin_link', 'instagram_link'])
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
            $contactData = $request->validated();

            // Save contact
            Contact::create($contactData);

            // Rate limiting
            RateLimiter::hit($key, 60 * 3); // Block for 3 minutes after 3 attempts

            // Prepare email data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'email1' => self::CONTACT_EMAIL,
                'subject' => 'Contact Form',
                'phone' => $request->phone,
                'contact_message' => $request->contact_message,
                'address' => $request->address,
                'interested_country' => $request->interested_country,
                'last_qualification' => $request->last_qualification,
                'test_preparation' => $request->test_preparation,
            ];

            // Send email
            try {
                Mail::send('admin.emails.contact_form_submitted', $data, function ($message) use ($data) {
                    $message->to($data['email1'])
                        ->subject($data['subject'])
                        ->replyTo($data['email']);
                });

                Log::info("Contact form email sent successfully to {$data['email1']}");
            } catch (\Throwable $e) {
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
            $enrollNow = EnrollNow::create([
                'name'                => $request->name,
                'email'               => $request->email,
                'phone'               => $request->phone,
                'test_preparation_id' => $request->test_preparation_id,
            ]);

            // Record attempt for rate limiter
            RateLimiter::hit($key, 60 * 3); // block for 3 minutes

            // Prepare email data
            $data = [
                'name'             => $request->name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'test_preparation' => optional($enrollNow->testPreparation)->title,
            ];

            // Send email
            try {
                Mail::send('admin.emails.enrollnow_form_submitted', $data, function ($message) use ($data) {
                    $message->to(self::CONTACT_EMAIL)
                        ->subject('New Enrollment Submission')
                        ->replyTo($data['email']);
                });

                Log::info('EnrollNow email sent successfully to ' . self::CONTACT_EMAIL);
            } catch (\Throwable $e) {
                Log::error('Unexpected error sending EnrollNow email to ' . self::CONTACT_EMAIL . ': ' . $e->getMessage());
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

        $testPreparationsOptions = TestPreparation::active()
            ->orderBy('title')
            ->pluck('title', 'id');

        return view('frontend.test_preparation.details', compact('testpreparation', 'testPreparationsOptions'));
    }
    public function blogIndex()
    {
        $blogs = Blog::active()
            ->with(['author:id,name', 'category:id,name'])
            ->select(['id', 'image', 'title', 'slug', 'blog_author_id', 'user_id', 'blog_date', 'short_description', 'category_id', 'faqs'])
            ->latest()
            ->paginate(3);
        return view('frontend.blogs.index', compact('blogs'));
    }
    public function blogDetails($slug, Request $request)
    {
        $blog = Blog::with(['author', 'category'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $viewedSessionKey = 'blog_viewed_' . $blog->id;
        if (!$request->session()->has($viewedSessionKey)) {
            $blog->increment('open_count');
            $request->session()->put($viewedSessionKey, true);
            $blog->refresh();
        }

        $testPreparationsOptions = TestPreparation::active()
            ->orderBy('title')
            ->pluck('title', 'id');

        $categories = Category::active()
            ->select(['id', 'name'])
            ->withCount('blogs')
            ->having('blogs_count', '>', 0)
            ->get();
        $relatedPosts = Blog::with(['author:id,name', 'category:id,name'])
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->active()
            ->latest()
            ->limit(4)
            ->get();
        $previousBlog = Blog::with('author:id,name')
            ->where('id', '<', $blog->id)
            ->active()
            ->latest('id')
            ->first();

        $nextBlog = Blog::with('author:id,name')
            ->where('id', '>', $blog->id)
            ->active()
            ->first();

        return view('frontend.blogs.details', compact('blog', 'categories', 'relatedPosts', 'previousBlog', 'nextBlog', 'testPreparationsOptions'));
    }

    public function blogProfile(string $authorSlug)
    {
        $authorId = (int) Str::afterLast($authorSlug, '-');
        $author = BlogAuthor::active()->withCount('blogs')->findOrFail($authorId);

        $authorBlogs = Blog::active()
            ->where('blog_author_id', $author->id)
            ->with(['category', 'author'])
            ->latest()
            ->paginate(6);

        $featuredBlog = Blog::active()
            ->where('blog_author_id', $author->id)
            ->latest()
            ->first();

        $categoryExpertise = Blog::active()
            ->where('blog_author_id', $author->id)
            ->with('category:id,name')
            ->latest()
            ->get()
            ->pluck('category.name')
            ->filter()
            ->unique()
            ->take(8)
            ->values();

        $publishedCount = Blog::active()->where('blog_author_id', $author->id)->count();

        return view('frontend.blogs.profile', compact(
            'author',
            'authorBlogs',
            'featuredBlog',
            'categoryExpertise',
            'publishedCount'
        ));
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
            Enquiry::create($request->validated());

            // Record attempt for rate limiter
            RateLimiter::hit($key, 60 * 3); // block for 3 minutes

            // Prepare email data
            $data = [
                'name'           => $request->name,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'enquiry_message' => $request->enquiry_message,
                'subject'        => 'Enquiry Form',
                'email1'         => self::CONTACT_EMAIL,
            ];

            // Send email
            try {
                Mail::send('admin.emails.enquiry_form_submitted', $data, function ($message) use ($data) {
                    $message->to($data['email1'])
                        ->subject($data['subject'])
                        ->replyTo($data['email']);
                });

                Log::info("Enquiry email sent successfully to {$data['email1']}");
            } catch (\Throwable $e) {
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
