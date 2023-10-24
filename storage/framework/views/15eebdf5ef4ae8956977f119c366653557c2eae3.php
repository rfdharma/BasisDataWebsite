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
            <a href="<?php echo e(route('front.orders')); ?>" class="btn-primary">
              <p>
                Check Order
              </p>
              <img src="/svgs/ic-arrow-right.svg" alt="">
            </a>
          </div>
        </div>
        <img src="<?php echo e(asset('storage/' . $item->photos[0]['photos'])); ?>" class="-mr-[100px] hidden max-w-[50%] lg:block" alt="">
      </div>
    </div>
  </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/success.blade.php ENDPATH**/ ?>