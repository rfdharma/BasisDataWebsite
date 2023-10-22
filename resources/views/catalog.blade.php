<x-front-layout>
    <section class="bg-dark relative">
        <div class="px-[26px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" style="padding-bottom: 50%">
            @foreach ($items as $item)
                <div class="relative">
                    <div class="card-popular @if ($item->inventory->available === 0) unavailable @endif" style="margin-top: 75px">
                        <div class="@if ($item->inventory->available === 0) opacity-30 @endif"">
                            <h5 class="mb-[2px] text-lg font-bold text-dark">
                                {{ $item->name }}
                            </h5>
                            <p class="text-sm font-normal text-secondary">
                                {{ $item->type ? $item->type->name : '-' }}
                            </p>
                            <a href="{{ route('front.detail', ['id' => $item->id]) }}"
                               class="absolute inset-0
              @if ($item->inventory->available === 0)
                  disabled
              @endif"
                               @if ($item->inventory->available === 0)
                                   style="pointer-events: none;"
                                @endif>
                            </a>
                        </div>
                        <img src="{{ asset('storage/' . $item->photos[0]['photos']) }}" class="h-[150px] w-full min-w-[216px] rounded-[18px] @if ($item->inventory->available === 0) opacity-30 @endif" alt="">

                        <div class="flex items-center justify-between gap-1 @if ($item->inventory->available === 0) opacity-30 @endif">
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
                    @if ($item->inventory->available === 0)
                        <div class="absolute inset-0 flex items-center justify-center text-black font-bold text-xl bg-opacity-80 z-10">
                            Tidak Tersedia
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
</x-front-layout>
