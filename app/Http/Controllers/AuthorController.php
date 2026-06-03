<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\manuscript_status;
use App\Models\manuscripts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function login()
    {
        if (session()->has('AuthorLoggedUser')) {
            return redirect()->route('author.dashboard');
        }

        return view('author.login');
    }

    public function register()
    {
        if (session()->has('AuthorLoggedUser')) {
            return redirect()->route('author.dashboard');
        }

        return view('author.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150|unique:authors,email',
            'mobile' => 'required|string|max:30',
            'affiliation' => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $author = Author::create([
            'name' => strip_tags($request->name),
            'email' => strtolower(strip_tags($request->email)),
            'mobile' => strip_tags($request->mobile),
            'affiliation' => strip_tags($request->affiliation),
            'password' => Hash::make($request->password),
            'ip_address' => $request->ip(),
        ]);

        session()->put('AuthorLoggedUser', $author->id);

        return redirect()->route('author.dashboard')->with('message', 'Registration completed successfully.');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $author = Author::where('email', strtolower($request->email))->first();

        if (!$author || !Hash::check($request->password, $author->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        session()->put('AuthorLoggedUser', $author->id);

        return redirect()->route('author.dashboard')->with('message', 'Logged in successfully.');
    }

    public function dashboard()
    {
        $author = $this->currentAuthor();

        if (!$author) {
            return redirect()->route('author.login')->with('message', 'Please login to continue.');
        }

        $manuscripts = manuscripts::where('author_id', $author->id)
            ->orWhere('email', $author->email)
            ->orderBy('m_id', 'DESC')
            ->get();

        $statusHistory = manuscript_status::whereIn('muuid', $manuscripts->pluck('muuid'))
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy('muuid');

        return view('author.dashboard', [
            'author' => $author,
            'manuscripts' => $manuscripts,
            'statusHistory' => $statusHistory,
            'statusLabels' => $this->statusLabels(),
        ]);
    }

    public function logout()
    {
        session()->forget('AuthorLoggedUser');

        return redirect()->route('author.login')->with('message', 'Logged out successfully.');
    }

    private function currentAuthor()
    {
        return Author::find(session('AuthorLoggedUser'));
    }

    private function statusLabels()
    {
        return [
            0 => 'Initial stage',
            1 => 'Review',
            2 => 'Awaiting Editorial Approval',
            3 => 'Re-review',
            4 => 'Final Verification of Content',
            5 => 'Published',
            6 => 'Rejected',
        ];
    }
}
