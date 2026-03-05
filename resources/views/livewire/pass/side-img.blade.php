<div class="image hidden lg:flex ">
    <img src="{{ auth()->user()->details ? asset('storage/'.auth()->user()->details->side_pic) : '' }}"
        class="w-full h-full object-cover rounded-lg" id="right-sticky-col" alt="Side Image" wire:poll.keep-alive>
</div>