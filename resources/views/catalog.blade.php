<x-front-layout>
    <section class="bg-dark">

    <div class="px-[26px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" style="padding-bottom: 50%">
        @foreach ($items as $item)
            <div class="card-popular" style="margin-top: 75px">
                <div>
                    <h5 class="mb-[2px] text-lg font-bold text-dark">
                        {{ $item->name }}
                    </h5>
                    <p class="text-sm font-normal text-secondary">
                        {{ $item->type ? $item->type->name : '-' }}
                    </p>
                    <a href="{{ route('front.detail', $item->slug) }}" class="absolute inset-0"></a>
                </div>
                <img src="{{ $item->thumbnail }}" class="h-[150px] w-full min-w-[216px] rounded-[18px]" alt="">
                <div class="flex items-center justify-between gap-1">
                    <!-- Price -->
                    <p class="text-sm font-normal text-secondary">
                        <span class="text-base font-bold text-primary">${{ number_format($item->price) }}</span>/day
                    </p>
                    <!-- Rating -->
                    <p class="flex items-center gap-[2px] text-xs font-semibold text-dark">
                        ({{ $item->star }}/5)
                        <img src="/svgs/ic-star.svg" alt="">
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    </section>
</x-front-layout>
