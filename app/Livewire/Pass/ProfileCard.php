<?php

namespace App\Livewire\Pass;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Details;

class ProfileCard extends Component
{
    use WithFileUploads;

    // Temporary uploaded files
    public $profilePic;
    public $coverPic;
    public $sidePic;

    // Feedback message
    public $uploadStatus = '';

    public function render()
    {
        return view('livewire.pass.profile-card');
    }

    // ────────────────────────────────────────────────
    //  Profile Picture Upload
    // ────────────────────────────────────────────────
    public function updatedProfilePic()
    {
        $this->validate([
            'profilePic' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB
        ]);

        $this->saveImage('profile_pic', 'profile_pics', $this->profilePic);

        $this->profilePic = null;
        $this->uploadStatus = 'Profile picture updated successfully!';
    }

    // ────────────────────────────────────────────────
    //  Cover Picture Upload
    // ────────────────────────────────────────────────
    public function updatedCoverPic()
    {
        $this->validate([
            'coverPic' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $this->saveImage('cover_pic', 'cover_pics', $this->coverPic);

        $this->coverPic = null;
        $this->uploadStatus = 'Cover picture updated successfully!';
    }

    // ────────────────────────────────────────────────
    //  Side Picture Upload
    // ────────────────────────────────────────────────
    public function updatedSidePic()
    {
        $this->validate([
            'sidePic' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $this->saveImage('side_pic', 'side_pics', $this->sidePic);

        $this->sidePic = null;
        $this->uploadStatus = 'Side picture updated successfully!';
    }

    // ────────────────────────────────────────────────
    //  Common image saving logic
    // ────────────────────────────────────────────────
    private function saveImage(string $column, string $folder, $uploadedFile): void
    {
        $user = Auth::user();

        // Get or create the details record
        $details = $user->details()->firstOrCreate(
            ['user_id' => $user->id],
            ['slug'=> $user->slug],
            []
        );

        // Delete old image if it exists
        if ($details->{$column}) {
            Storage::disk('public')->delete($details->{$column});
        }

        // Store the new image
        $path = $uploadedFile->store($folder, 'public');

        // ────────────────────────────────────────────────
        //  Notify other components that profile picture changed
        // ────────────────────────────────────────────────
        if ($column === 'profile_pic') {
            $this->dispatch('profile-picture-updated', userId: $user->id);
            // or simpler (no extra data): $this->dispatch('profile-picture-updated');
        }

        // Update the field in Details model
        $details->update([$column => $path]);
    }

    // ────────────────────────────────────────────────
    //  Optional: Remove profile picture
    // ────────────────────────────────────────────────
    public function removeProfilePic()
    {
        $user = Auth::user();
        $details = $user->details;

        if ($details && $details->profile_pic) {
            Storage::disk('public')->delete($details->profile_pic);
            $details->update(['profile_pic' => null]);
            $this->uploadStatus = 'Profile picture removed.';
        }
    }

    // You can add similar removeCoverPic() and removeSidePic() methods if needed
}