<?php if (isset($component)) { $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a = $component; } ?>
<?php $component = App\View\Components\FrontLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FrontLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Main Content -->
    <section class="relative bg-darkGrey py-[70px]">
        <div class="container">
            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="flex flex-col gap-4 rounded-[30px] bg-white p-4" id="gallery">
                        <img src="<?php echo e(asset('storage/' . $item->photos[0]['photos'])); ?>" class="h-auto w-full rounded-[18px] md:h-[490px]" alt="">
                        <div class="grid grid-cols-4 items-center gap-3 md:gap-5">
                            <?php $__currentLoopData = $item->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    <a href="<?php echo e(asset('storage/' . $photo['photos'])); ?>" @click="changeActive(index)" target="_blank">
                                        <img src="<?php echo e(asset('storage/' . $photo['photos'])); ?>" alt="" class="thumbnail" :class="{ selected: index == activeThumbnail }">
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <!-- Details -->
                <div class="col-span-12 md:col-span-8 md:col-start-5 lg:col-span-4 lg:col-start-auto">
                    <div class="h-full rounded-3xl bg-white p-5 pb-[30px]">
                        <div class="flex h-full flex-col divide-y divide-grey">
                            <!-- Name, Category, Rating -->
                            <div class="max-w-[230px] pb-5">
                                <h1 class="mb-[6px] text-[28px] font-bold leading-[42px] text-dark">
                                    <?php echo e($item->brand->name); ?> <?php echo e($item->name); ?>

                                    <p class="mb-[10px] text-base font-normal">Keluaran (<?php echo e($item->year); ?>)</p>
                                </h1>

                                <p class="mb-[10px] text-base font-normal text-secondary"><?php echo e($item->type->name); ?></p>
                                <div class="flex items-center gap-2">
                                    <p class="flex items-center text-xs font-semibold text-dark">
                                        <img src="https://static.vecteezy.com/system/resources/previews/026/546/373/non_2x/solid-icon-for-capacity-vector.jpg" alt="" style="height: 10px;width: 10px">
                                        <?php echo e($item->transmission); ?>

                                    </p>
                                    <p class="flex items-center text-xs font-semibold text-dark">
                                        <img src="https://cdn3.iconfinder.com/data/icons/aviation-2/500/Aviation_agile-512.png" alt="" style="height: 15px;width: 15px">
                                        (<?php echo e($item->capacity); ?>)
                                    </p>
                                </div>
                            </div>
                            <!-- Features -->
                            <ul class="flex-start flex flex-col gap-4 pt-5 pb-2">
                                <?php
                                    $features = explode(',', $item->features);
                                ?>
                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                        <img src="/svgs/ic-checkDark.svg" alt="">
                                        <?php echo e($feature); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="mt-auto flex items-center justify-between gap-4 pt-5">
                                <div>
                                    <p class="text-[22px] font-bold text-dark">
                                        $<?php echo e(number_format($item->price)); ?>

                                    </p>
                                    <p class="text-base font-normal text-secondary">
                                        /day
                                    </p>
                                </div>
                                <div class="w-full max-w-[70%]">
                                    <!-- Button Primary -->
                                    <div class="group rounded-full bg-primary p-1">
                                        <a href="<?php echo e(route('front.checkout', $item->id)); ?>" class="btn-primary">
                                            <p>
                                                Rent Now
                                            </p>
                                            <img src="/svgs/ic-arrow-right.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>































    <!-- Similar Cars -->







































 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/detail.blade.php ENDPATH**/ ?>