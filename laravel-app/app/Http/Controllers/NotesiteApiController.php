<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NotesiteApiController extends Controller
{
    public function handle(Request $request)
    {
        $action = $request->query('a', $request->input('a'));

        switch ($action) {
            case 'me':
                return $this->me($request);
            case 'login':
                return $this->login($request);
            case 'register':
                return $this->register($request);
            case 'logout':
                return $this->logout($request);
            case 'notes':
                return $this->notes($request);
            case 'users':
                return $this->users($request);
            case 'save_note':
                return $this->saveNote($request);
            case 'save_user':
                return $this->saveUser($request);
            case 'delete_note':
                return $this->deleteNote($request);
            case 'delete_user':
                return $this->deleteUser($request);
            case 'save_profile':
                return $this->saveProfile($request);
            default:
                return response()->json(['error' => 'Unknown action.'], 400);
        }
    }

    private function me(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['user' => null]);
        }

        return response()->json(['user' => $this->serializeUser(Auth::user())]);
    }

    private function login(Request $request)
    {
        $email = trim((string) $request->input('email', ''));
        $password = (string) $request->input('password', $request->input('pass', ''));
        $credentials = ['email' => $email, 'password' => $password];

        if (!filter_var($credentials['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Please enter a valid email.']);
        }

        if (Auth::attempt($credentials, true)) {
            return response()->json(['user' => $this->serializeUser(Auth::user())]);
        }

        return response()->json(['error' => 'Wrong email or password.']);
    }

    private function register(Request $request)
    {
        $name = trim((string) $request->input('name', ''));
        $email = trim((string) $request->input('email', ''));
        $pass = (string) $request->input('pass', '');

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6) {
            return response()->json(['error' => 'Please provide a valid name, email, and a password with at least 6 characters.']);
        }

        if (User::where('email', $email)->exists()) {
            return response()->json(['error' => 'An account with that email already exists.']);
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pass),
            'role' => 'User',
            'addr' => '',
            'gender' => '',
            'pic' => '',
        ]);

        return response()->json(['user' => $this->serializeUser($user)]);
    }

    private function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['ok' => true]);
    }

    private function notes(Request $request)
    {
        $notes = Note::where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get()
            ->map(fn ($note) => [
                'id' => $note->id,
                'title' => $note->title,
                'body' => $note->body,
                'cat' => $note->cat,
                'clr' => $note->clr,
                'date' => $note->date,
            ]);

        return response()->json(['notes' => $notes]);
    }

    private function users(Request $request)
    {
        if (!Auth::check() || (Auth::user()->role ?? 'User') !== 'Admin') {
            return response()->json(['error' => 'Admins only.']);
        }

        $users = User::orderBy('id')->get()->map(fn ($user) => $this->serializeUser($user));

        return response()->json(['users' => $users]);
    }

    private function saveNote(Request $request)
    {
        $id = $request->input('id');
        $title = trim((string) $request->input('title', ''));
        $body = trim((string) $request->input('body', ''));
        $cat = trim((string) $request->input('cat', 'Personal'));
        $clr = (string) $request->input('clr', 'cb');

        if ($title === '' || $body === '') {
            return response()->json(['error' => 'Title and content are required.']);
        }

        $note = $id ? Note::where('id', $id)->where('user_id', Auth::id())->first() : new Note();

        if (!$note) {
            return response()->json(['error' => 'Note not found.']);
        }

        $note->fill([
            'user_id' => Auth::id(),
            'title' => $title,
            'body' => $body,
            'cat' => $cat ?: 'Personal',
            'clr' => $clr,
            'date' => $note->exists ? $note->date : now()->toDateString(),
        ]);
        $note->save();

        return response()->json(['ok' => true]);
    }

    private function saveUser(Request $request)
    {
        if (!Auth::check() || (Auth::user()->role ?? 'User') !== 'Admin') {
            return response()->json(['error' => 'Admins only.']);
        }

        $id = $request->input('id');
        $name = trim((string) $request->input('name', ''));
        $email = trim((string) $request->input('email', ''));
        $pass = (string) $request->input('pass', '');
        $role = (string) $request->input('role', 'User');

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Name and email are required.']);
        }

        $user = $id ? User::find($id) : new User();
        if (!$user) {
            return response()->json(['error' => 'User not found.']);
        }

        if ($email !== $user->email && User::where('email', $email)->exists()) {
            return response()->json(['error' => 'That email is already used.']);
        }

        $user->name = $name;
        $user->email = $email;
        $user->role = in_array($role, ['Admin', 'User'], true) ? $role : 'User';

        if ($pass !== '') {
            $user->password = Hash::make($pass);
        }

        $user->save();

        return response()->json(['ok' => true]);
    }

    private function deleteNote(Request $request)
    {
        $id = (int) $request->input('id', 0);
        $note = Note::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$note) {
            return response()->json(['error' => 'Note not found.']);
        }

        $note->delete();

        return response()->json(['ok' => true]);
    }

    private function deleteUser(Request $request)
    {
        if (!Auth::check() || (Auth::user()->role ?? 'User') !== 'Admin') {
            return response()->json(['error' => 'Admins only.']);
        }

        $id = (int) $request->input('id', 0);
        if ($id === Auth::id()) {
            return response()->json(['error' => 'You cannot delete your own account.']);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.']);
        }

        $user->delete();

        return response()->json(['ok' => true]);
    }

    private function saveProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Please sign in first.']);
        }

        $name = trim((string) $request->input('name', $user->name));
        $email = trim((string) $request->input('email', $user->email));
        $pass = (string) $request->input('pass', '');

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Name and email are required.']);
        }

        if ($email !== $user->email && User::where('email', $email)->exists()) {
            return response()->json(['error' => 'That email is already used.']);
        }

        $user->name = $name;
        $user->email = $email;
        $user->addr = (string) $request->input('addr', $user->addr);
        $user->gender = (string) $request->input('gender', $user->gender);
        $user->pic = (string) $request->input('pic', $user->pic);

        if ($pass !== '') {
            $user->password = Hash::make($pass);
        }

        $user->save();

        return response()->json(['user' => $this->serializeUser($user)]);
    }

    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'User',
            'addr' => $user->addr ?? '',
            'gender' => $user->gender ?? '',
            'pic' => $user->pic ?? '',
            'created' => $user->created_at?->format('Y-m-d'),
        ];
    }
}
