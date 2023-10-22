<?php if (isset($component)) { $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a = $component; } ?>
<?php $component = App\View\Components\FrontLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FrontLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="bg-dark">
        <div class="px-[26px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" style="padding-bottom: 50%">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-popular" style="margin-top: 75px">
                    <div>
                        <h5 class="mb-[2px] text-lg font-bold text-dark">
                            <?php echo e($item->name); ?>

                        </h5>
                        <p class="text-sm font-normal text-secondary">
                            <?php echo e($item->type ? $item->type->name : '-'); ?>

                        </p>
                        <a href="<?php echo e(route('front.detail', ['id' => $item->id])); ?>" class="absolute inset-0"></a>
                    </div>
                    <img src="<?php echo e(asset('storage/' . $item->photos[0]['photos'])); ?>" class="h-[150px] w-full min-w-[216px] rounded-[18px]" alt="">

                    <div class="flex items-center justify-between gap-1">
                        <!-- Price -->
                        <p class="text-sm font-normal text-secondary">
                            <span class="text-base font-bold text-primary">$<?php echo e(number_format($item->price)); ?></span>/day
                        </p>
                        <!-- Rating -->
                        <p class="flex items-center gap-[2px] text-xs font-semibold text-dark">
                            (<?php echo e($item->star); ?>/5)
                            <img src="/svgs/ic-star.svg" alt="">
                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/catalog.blade.php ENDPATH**/ ?>