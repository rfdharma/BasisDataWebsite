<?php if (isset($component)) { $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a = $component; } ?>
<?php $component = App\View\Components\FrontLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FrontLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                            <?php echo e($latestVehicle->brand->name); ?>

                        </div>
                    </div>
                </div>
                <?php if($latestVehicle && $latestVehicle->photos->count() > 0): ?>
                    <?php
                        $latestPhoto = $latestVehicle->photos->last(); // Get the last photo
                    ?>
                    <img src="<?php echo e(asset('storage/' . $latestPhoto->photos)); ?>" class="relative z-5 w-full max-w-[963px] rounded-[30px] img-fluid" alt="Car.png" data-aos="zoom-in" data-aos-delay="1150">
                <?php else: ?>
                    <p>No photos available for the latest vehicle.</p>
                <?php endif; ?>

            </div>

            <div class="flex flex-col items-center justify-around gap-7 lg:flex-row lg:gap-[60px]">
                <!-- Car Details -->
                <div data-aos="fade-left" data-aos-delay="600" style="font-size: 40px" class="font-bold">
                    <?php echo e($latestVehicle->brand->name); ?>

                </div>
                <span class="vr" data-aos="fade-left" data-aos-delay="1100"></span>
                <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="950">
                    <h6 class="text-center font-bold text-dark md:text-[26px] pb-2" style="font-size: 35px">
                        <?php echo e($latestVehicle->name); ?>

                    </h6>
                    <?php
                        $features = explode(', ', $latestVehicle->features); // Membagi fitur menjadi array
                        $featuresText = implode(' | ', $features); // Menggabungkan array menjadi satu teks dengan "|" sebagai pemisah
                    ?>
                    <p class="text-center text-sm font-normal text-secondary md:text-base">
                        <?php echo e($featuresText); ?>

                    </p>
                </div>
                <span class="vr" data-aos="fade-left" data-aos-delay="1100"></span>

                <!-- Button Primary -->
                <div class="group rounded-full bg-primary p-1" data-aos="zoom-in" data-aos-delay="1200">
                    <a href="<?php echo e(route('front.checkout', ['id' => $latestVehicle->id])); ?>" class="btn-primary">
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
        <div class="text-center container relative" style="padding-top: 10%; padding-bottom: 10%">
            <header class="mb-[50px]" style="margin-top: -30px">
                <h1 class="mb-2 font-bold text-white" style="font-size: 33px">
                    Favored Rental
                </h1>
                <h1 class="text-base text-secondary text-gray-200" style="font-size: 20px">Start your big day</h1>
            </header>

            <!-- Cars -->
            <div class="grid gap-[29px] md:grid-cols-2 lg:grid-cols-4">
                <?php $__currentLoopData = $popularVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($vehicle->inventory->available !== 0): ?>
                        <!-- Card -->
                        <div class="relative">
                            <div class="card-popular">
                                <div>
                                    <h5 class="mb-[2px] text-lg font-bold text-dark">
                                        <?php echo e($vehicle->brand ? $vehicle->brand->name : '-'); ?>

                                        <?php echo e($vehicle->name); ?>


                                    </h5>
                                    <p class="text-sm font-normal text-secondary">
                                        <?php echo e($vehicle->type ? $vehicle->type->name : '-'); ?>

                                    </p>
                                    <a href="<?php echo e(route('front.detail', $vehicle->id)); ?>" class="absolute inset-0"></a>
                                </div>
                                <?php if($vehicle->photos->count() > 0): ?>
                                    <?php
                                        $photo = $vehicle->photos->last();
                                    ?>
                                    <img src="<?php echo e(asset('storage/' . $photo->photos)); ?>" class="h-[150px] w-full min-w-[216px] rounded-[18px]" alt="<?php echo e($vehicle->name); ?> Photo">
                                <?php else: ?>
                                    <p>No photos available for this vehicle.</p>
                                <?php endif; ?>
                                <div class="flex items-center justify-between gap-1">
                                    <!-- Price -->
                                    <p class="text-sm font-normal text-secondary">
                                        <span class="text-base font-bold text-primary">$<?php echo e(number_format($vehicle->price)); ?></span>/day
                                    </p>
                                    <!-- Rating -->
                                    <p class="flex items-center text-xs font-semibold text-dark">
                                        <img src="https://static.vecteezy.com/system/resources/previews/026/546/373/non_2x/solid-icon-for-capacity-vector.jpg" class="ml-6" alt="" style="height: 10px;width: 10px">
                                        <?php echo e($vehicle->transmission); ?>

                                    </p>
                                    <p class="flex items-center text-xs font-semibold text-dark">
                                        <img src="https://cdn3.iconfinder.com/data/icons/aviation-2/500/Aviation_agile-512.png" alt="" style="height: 15px;width: 15px">
                                        (<?php echo e($vehicle->capacity); ?>)
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>


    <!-- Extra Benefits -->
    <div class="card" style="margin-bottom: 10%">
        <section class="container relative" style="margin-top: 10%">
            <div class="flex items-center justify-center flex-col gap-8 md:flex-row lg:gap-[120px] text-center">
                <div class="w-full max-w-[268px]">
                    <div class="flex align-middle text-center items-center flex-col gap-[30px]">
                        <header>
                            <h2 class="mb-1 text-[26px] font-bold text-dark">
                                Why Us?
                            </h2>
                            <p class="text-base text-secondary">You drive safety and famous</p>
                        </header>
                        <div class="flex w-max gap-8 pt-5 pb-5">
                            <!-- Benefits Item 1 -->
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

                            <!-- Benefits Item 2 -->
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

                            <!-- Benefits Item 3 -->
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

                            <!-- Benefits Item 4 -->
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

                    </div>
                    <!-- CTA Button -->
                    <div class="mt-[50px]">
                        <!-- Button Primary -->
                        <div class="group rounded-full bg-primary p-1">
                            <a href="<?php echo e(route('front.catalog')); ?>" class="btn-primary">
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
                        <a href="<?php echo e(route('front.catalog')); ?>" class="btn-primary">
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/landing.blade.php ENDPATH**/ ?>