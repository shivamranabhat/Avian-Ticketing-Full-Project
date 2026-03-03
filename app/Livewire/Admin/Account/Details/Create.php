<?php

namespace App\Livewire\Admin\Account\Details;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Details;

class Create extends Component
{
    use WithFileUploads;

    public $user_id;
    public $bio;
    public $location;

    public $profile_pic;
    public $cover_pic;
    public $side_pic;
    public $cv;

    public $users = [];

    public function mount()
    {
        // Load users who don't already have details
        $this->users = User::whereDoesntHave('details')
            ->orderBy('name')
            ->get();
    }

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:details,user_id',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|max:2048',
            'cover_pic' => 'nullable|image|max:2048',
            'side_pic' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        DB::beginTransaction();

        try {

            $user = User::findOrFail($validated['user_id']);

            // Upload files
            $profilePicPath = $this->profile_pic
                ? $this->profile_pic->store("profile_pics", 'public')
                : null;

            $coverPicPath = $this->cover_pic
                ? $this->cover_pic->store("cover_pics", 'public')
                : null;

            $sidePicPath = $this->side_pic
                ? $this->side_pic->store("side_pics", 'public')
                : null;

            $cvPath = $this->cv
                ? $this->cv->store("cvs", 'public')
                : null;

            $slug = Str::slug($user->name) . '-' . $user->id;

            Details::create([
                'user_id' => $user->id,
                'bio' => $validated['bio'],
                'location' => $validated['location'],
                'profile_pic' => $profilePicPath,
                'cover_pic' => $coverPicPath,
                'side_pic' => $sidePicPath,
                'cv' => $cvPath,
                'slug' => $slug,
            ]);

            DB::commit();

            session()->flash('success', 'Details created successfully.');

            return redirect()->route('account.details.index');

        } catch (\Throwable $e) {

            DB::rollBack();

            if (isset($user)) {
                Storage::disk('public')->deleteDirectory("users/{$user->id}");
            }

            report($e);

            session()->flash('error', 'Something went wrong.');
        }
    }

    public function render()
    {
        return view('livewire.admin.account.details.create')->layout('layouts.app');
    }
}