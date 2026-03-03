<?php

namespace App\Livewire\Admin\Account\Details;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Details;

class Edit extends Component
{
    use WithFileUploads;

    public $details;

    public $bio;
    public $location;

    public $profile_pic;
    public $cover_pic;
    public $side_pic;
    public $cv;

    // Existing file paths
    public $existing_profile_pic;
    public $existing_cover_pic;
    public $existing_side_pic;
    public $existing_cv;

    public function mount($slug)
    {
        $this->details = Details::with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        $this->bio = $this->details->bio;
        $this->location = $this->details->location;

        $this->existing_profile_pic = $this->details->profile_pic;
        $this->existing_cover_pic = $this->details->cover_pic;
        $this->existing_side_pic = $this->details->side_pic;
        $this->existing_cv = $this->details->cv;
    }

    protected function rules()
    {
        return [
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|max:2048',
            'cover_pic' => 'nullable|image|max:2048',
            'side_pic' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ];
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();

        try {

            // PROFILE PIC
            if ($this->profile_pic) {
                if ($this->existing_profile_pic) {
                    Storage::disk('public')->delete($this->existing_profile_pic);
                }

                $this->existing_profile_pic =
                    $this->profile_pic->store(
                        "profile_pics",
                        'public'
                    );
            }

            // COVER PIC
            if ($this->cover_pic) {
                if ($this->existing_cover_pic) {
                    Storage::disk('public')->delete($this->existing_cover_pic);
                }

                $this->existing_cover_pic =
                    $this->cover_pic->store(
                        "cover_pics",
                        'public'
                    );
            }

            // SIDE PIC
            if ($this->side_pic) {
                if ($this->existing_side_pic) {
                    Storage::disk('public')->delete($this->existing_side_pic);
                }

                $this->existing_side_pic =
                    $this->side_pic->store(
                        "side_pics",
                        'public'
                    );
            }

            // CV
            if ($this->cv) {
                if ($this->existing_cv) {
                    Storage::disk('public')->delete($this->existing_cv);
                }

                $this->existing_cv =
                    $this->cv->store(
                        "cvs",
                        'public'
                    );
            }

            $this->details->update([
                'bio' => $this->bio,
                'location' => $this->location,
                'profile_pic' => $this->existing_profile_pic,
                'cover_pic' => $this->existing_cover_pic,
                'side_pic' => $this->existing_side_pic,
                'cv' => $this->existing_cv,
            ]);

            DB::commit();

            session()->flash('success', 'Details updated successfully.');

            return redirect()->route('account.details.index');

        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            session()->flash('error', 'Something went wrong.');
        }
    }

    public function render()
    {
        return view('livewire.admin.account.details.edit')->layout('layouts.app');
    }
}