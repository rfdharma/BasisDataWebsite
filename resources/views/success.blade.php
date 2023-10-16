<x-front-layout>
  <!-- Main Content -->
  <section class="relative min-h-[calc(100vh-70px)] bg-darkGrey py-[70px] lg:min-h-[calc(100vh-135px)]">
    <div class="container">
      <div class="flex items-center justify-center gap-5 lg:justify-between">
        <div class="flex flex-col items-center md:ml-12">
          <header class="mb-[30px] text-center">
            <h2 class="mb-1 text-[26px] font-bold text-dark">
              Waiting Booking
            </h2>
            <p class="text-base text-secondary">We will check for confirmation <br>
              and the next instructions</p>
          </header>
          <!-- Button Primary -->
          <div class="group w-[220px] rounded-full bg-primary p-1">
            <a href="{{ route('front.orders') }}" class="btn-primary">
              <p>
                Check Order
              </p>
              <img src="/svgs/ic-arrow-right.svg" alt="">
            </a>
          </div>
        </div>
        <img src="{{ $item->thumbnail }}" class="-mr-[100px] hidden max-w-[50%] lg:block" alt="">
      </div>
    </div>
  </section>
</x-front-layout>
