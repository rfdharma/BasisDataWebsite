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
      <div class="flex flex-col items-center">
        <header class="mb-[30px] text-center">
          <h2 class="mb-1 text-[26px] font-bold text-dark">
            Sign In & Drive
          </h2>
          <p class="text-base text-secondary">We will help you get ready today</p>
        </header>
        <!-- Form Card -->
        <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10">
          <?php echo csrf_field(); ?>
          <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
            <!-- Validation Errors -->
            <div class="col-span-2 flex flex-col gap-3">
              <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.validation-errors','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
              <?php if(session('status')): ?>
                <div class="mb-4 text-sm font-medium text-green-600">
                  <?php echo e(session('status')); ?>

                </div>
              <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Email Address
              </label>
              <input type="email" name="email" id="email"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Email Address" value="<?php echo e(old('email')); ?>" autofocus required>
            </div>
            <!-- Password -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Password
              </label>
              <input type="password" name="password" id="password"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert password" required>
              <?php if(Route::has('password.request')): ?>
                <a href="<?php echo e(route('password.request')); ?>" class="mt-1 text-right text-base text-secondary underline underline-offset-2">
                  Forgot My Password
                </a>
              <?php endif; ?>
            </div>
            <!-- Sign In Button -->
            <div class="col-span-2 mt-[26px]">
              <!-- Button Primary -->
              <div class="group rounded-full bg-primary p-1">
                <a href="#!" class="btn-primary" id="loginButton">
                  <p>
                    Sign In
                  </p>
                  <img src="/svgs/ic-arrow-right.svg" alt="">
                </a>
                <button type="submit" class="hidden"></button>
              </div>
            </div>
            <?php if(Route::has('register')): ?>
              <!-- Create New Account Button -->
              <div class="col-span-2">
                <a href="<?php echo e(route('register')); ?>" class="btn-secondary">
                  <p>Create New Account</p>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    $('#loginButton').click(function() {
      $('#loginForm').submit();
    });
  </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/auth/login.blade.php ENDPATH**/ ?>