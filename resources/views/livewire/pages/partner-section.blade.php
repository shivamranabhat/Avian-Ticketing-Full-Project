<div class="partner px-6 py-12 sm:px-14 md:px-24 xl:px-34 flex flex-col items-center gap-y-6 mb-10">
    <h2 class="text-2xl md:text-3xl font-semibold mt-3">Our Partners</h2>
    <div class="owl-carousel partner-slider">
        @forelse($partners as $partner)
        <div class="p-6">
            <img src="{{asset('storage/'.$partner->image)}}" class="w-32 object-contain" alt="{{$partner->img_alt}}">
        </div>
        @empty
        <p class="text-center">No partner found.</p>
        @endforelse
    </div>
</div>