<x-front-layout>
  <!-- Hero -->
    <section class="container relative pb-[100px] pt-[30px]">
        <div class="flex flex-col items-center justify-center gap-[30px]">
            <!-- Preview Image -->
            <div class="relative">
                <div class="absolute z-0 hidden lg:block">
                    <div class="text-[220px] font-extrabold leading-[101%] tracking-[-0.06em] text-darkGrey">
                        <div data-aos="fade-right" data-aos-delay="300">
                            NEW
                        </div>
                        <div data-aos="fade-left" data-aos-delay="600">
                            {{ $items_landing[count($items_landing) - 1]->brand->name }}
                        </div>
                    </div>
                </div>
                <img src="{{ $items_landing[count($items_landing) - 1]->thumbnail }}" class="relative z-5 w-full max-w-[963px] rounded-[30px] img-fluid" alt="Car.png" data-aos="zoom-in" data-aos-delay="1150">
            </div>

            <div class="flex flex-col items-center justify-around gap-7 lg:flex-row lg:gap-[60px]">
                <!-- Car Details -->
                <div data-aos="fade-left" data-aos-delay="600" style="font-size: 40px" class="font-bold">
                    {{ $items_landing[count($items_landing) - 1]->brand->name }}
                </div>
                <span class="vr" data-aos="fade-left" data-aos-delay="1100"></span>
                <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="950">
                    <h6 class="text-center font-bold text-dark md:text-[26px] pb-2" style="font-size: 35px">
                        {{ $items_landing[count($items_landing) - 1]->name }}
                    </h6>
                    @php
                        $features = explode(', ', $items_landing[count($items_landing) - 1]->features); // Membagi fitur menjadi array
                        $featuresText = implode(' | ', $features); // Menggabungkan array menjadi satu teks dengan "|" sebagai pemisah
                    @endphp
                    <p class="text-center text-sm font-normal text-secondary md:text-base">
                        {{ $featuresText }}
                    </p>
                </div>
                <span class="vr" data-aos="fade-left" data-aos-delay="1100"></span>

                <!-- Button Primary -->
                <div class="group rounded-full bg-primary p-1" data-aos="zoom-in" data-aos-delay="1200">
                    <a href="{{ route('front.checkout', ['slug' => $items[count($items) - 1]->slug, 'thumbnail' => $items_landing[count($items_landing) - 1]->thumbnail]) }}" class="btn-primary">
                        <p>
                            Rent Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>


  <!-- Popular Cars -->
  <section class="bg-dark">
    <div class="text-center container relative" style="padding-top: 10%;padding-bottom: 10%">
      <header class="mb-[50px]" style="margin-top: -30px">
        <h1 class="mb-2 font-bold text-white" style="font-size: 33px">
            Favored Rental
        </h1>
        <h1 class="text-base text-secondary text-gray-200" style="font-size: 20px">Start your big day</h1>
      </header>

      <!-- Cars -->
      <div class="grid gap-[29px] md:grid-cols-2 lg:grid-cols-4">
        @foreach ($items as $item)
          <!-- Card -->
          <div class="card-popular">
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
    </div>
  </section>

  <!-- Extra Benefits -->
    <div class="card">
        <section class="container relative" style="padding-top: 5%">
            <div class="flex flex-col flex-wrap items-center justify-center gap-8 md:flex-row lg:gap-[120px]">
                <div class="w-full max-w-[268px]">
                    <div class="flex flex-col gap-[30px]">
                        <header>
                            <h2 class="mb-1 text-[26px] font-bold text-dark">
                                Why Us?
                            </h2>
                            <p class="text-base text-secondary">You drive safety and famous</p>
                        </header>
                        <!-- Benefits Item -->
                        <div class="flex items-center gap-4">
                            <div class="rounded-[26px] bg-dark p-[19px]">
                                <img src="/svgs/ic-car.svg" alt="">
                            </div>
                            <div>
                                <h5 class="mb-[2px] text-lg font-bold text-dark">
                                    Delivery
                                </h5>
                                <p class="text-sm font-normal text-secondary">Just sit tight and wait</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="rounded-[26px] bg-dark p-[19px]">
                                <img src="/svgs/ic-card.svg" alt="">
                            </div>
                            <div>
                                <h5 class="mb-[2px] text-lg font-bold text-dark">
                                    Pricing
                                </h5>
                                <p class="text-sm font-normal text-secondary">12x Pay Installment</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="rounded-[26px] bg-dark p-[19px]">
                                <img src="/svgs/ic-securityuser.svg" alt="">
                            </div>
                            <div>
                                <h5 class="mb-[2px] text-lg font-bold text-dark">
                                    Secure
                                </h5>
                                <p class="text-sm font-normal text-secondary">Use your plate number</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="rounded-[26px] bg-dark p-[19px]">
                                <img src="/svgs/ic-convert3dcube.svg" alt="">
                            </div>
                            <div>
                                <h5 class="mb-[2px] text-lg font-bold text-dark">
                                    Fast Trade
                                </h5>
                                <p class="text-sm font-normal text-secondary">Change car faster</p>
                            </div>
                        </div>
                    </div>
                    <!-- CTA Button -->
                    <div class="mt-[50px]">
                        <!-- Button Primary -->
                        <div class="group rounded-full bg-primary p-1">
                            <a href="{{route('front.catalog')}}" class="btn-primary">
                                <p>
                                    Discover Vehicle
                                </p>
                                <img src="/svgs/ic-arrow-right.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




    <!-- FAQ -->
  <section class="container relative py-[100px]" style="padding-bottom: 10%">
    <header class="mb-[50px] text-center">
      <h2 class="mb-1 text-[26px] font-bold text-dark">
        Frequently Asked Questions
      </h2>
      <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
    </header>

    <!-- Questions -->
    <div class="mx-auto grid w-full max-w-[910px] gap-x-[50px] gap-y-6 md:grid-cols-2">
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq1">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq1-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq2">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq2-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq3">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq3-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq4">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq4-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq5">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq5-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq6">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq6-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
    </div>
  </section>

  <!-- Instant Booking -->
    <div class="block-section">
        <section class="text-center relative bg-[#060523]" style="padding-bottom: 8%;padding-top: 5%">
            <div class="container py-20">
                <div class="flex flex-col justify-center items-center">
                    <header style="margin-bottom: 15px">
                        <h2 class="font-bold text-white" style="padding-bottom: 30px;font-size: 30px">
                            Drive Yours Today & Drive Faster.
                        </h2>
                        <p class="text-base text-subtlePars" style="font-size: 15px">Get an instant booking to catch up whatever you really want to achieve today, yes.</p>
                    </header>
                    <!-- Button Primary -->
                    <div class="group w-max rounded-full bg-primary p-1 mt-4">
                        <a href="{{route('front.catalog')}}" class="btn-primary">
                            <p>
                                Book Now
                            </p>
                            <img src="/svgs/ic-arrow-right.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <footer class="container md:pb-20">
        <div class="py-10 md:pt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Bagian 1: Informasi Kontak -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 mb-3">Kontak Kami</h3>
                <p class="text-gray-600 mb-3">Jalan Mulyosari<br>Surabaya 672000</p>
                <p class="text-gray-600 mb-3">Email : BasDat2@gmail.com</p>
                <p class="text-gray-600 mb-3">Telp : 081-888-999-000</p>
            </div>

            <!-- Bagian 2: Tautan Cepat -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#our-services-section" class="text-blue-500 hover:underline">Layanan Kami</a></li>
                    <li><a href="#why-us-section" class="text-blue-500 hover:underline">Mengapa Kami</a></li>
                    <li><a href="#testimony-section" class="text-blue-500 hover:underline">Testimonial</a></li>
                    <li><a href="#section-faq" class="text-blue-500 hover:underline">FAQ</a></li>
                </ul>
            </div>

            <!-- Bagian 3: Sosial Media -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ikuti Kami</h3>
                <ul class="flex space-x-4">
                    <li><a href="#" class="text-blue-500 hover:text-blue-700"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#" class="text-blue-500 hover:text-blue-700"><i class="fab fa-linkedin"></i></a></li>
                </ul>
            </div>

            <!-- Bagian 4: Hak Cipta dan Logo -->
            <div class="text-gray-600">
                <p class="mb-4">Hak Cipta &copy; Basis Data Kelompok X 2023</p>
                <a href="#" class="inline-block bg-blue-700 h-8 w-8 rounded-full"></a>
            </div>
        </div>
    </footer>

</x-front-layout>
