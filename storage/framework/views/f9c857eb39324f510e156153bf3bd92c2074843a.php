<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="relative bg-darkGrey py-[70px]">
        <div class="container">
            <div class="flex flex-col items-center">
                <!-- Form Card -->
                <form action="<?php echo e(route('owner.create.admin')); ?>" class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10" id="registerForm" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Validation Errors -->
                    <div class="col-span-2 flex flex-col gap-3">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'jetstream::components.validation-errors','data' => ['class' => 'mb-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                    <!-- User Photo -->












                    <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
                        <!-- Full Name -->
                        <div class="col-span-2 flex flex-col gap-3">
                            <label for="" class="text-base font-semibold text-dark">
                                Full Name
                            </label>
                            <input type="text" name="name" id="name"
                                   class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                                   placeholder="Insert Full Name" value="<?php echo e(old('name')); ?>" autofocus>
                        </div>
                        <!-- Phone Number -->
                        <div class="col-span-2 flex flex-col gap-3">
                            <label for="" class="text-base font-semibold text-dark">
                                Phone Number
                            </label>
                            <input type="number" name="phone" id="phone"
                                   class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                                   placeholder="Insert Phone Number" value="<?php echo e(old('phone')); ?>">
                        </div>
                        <!-- Email -->
                        <div class="col-span-2 flex flex-col gap-3">
                            <label for="" class="text-base font-semibold text-dark">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email"
                                   class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                                   placeholder="Insert Email Address" value="<?php echo e(old('email')); ?>">
                        </div>
                        <!-- Password -->
                        <div class="col-span-2 flex flex-col gap-3">
                            <label for="" class="text-base font-semibold text-dark">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                                   placeholder="Insert password" required>
                        </div>
                        <!-- Password Confirmation -->
                        <div class="col-span-2 flex flex-col gap-3">
                            <label for="" class="text-base font-semibold text-dark">
                                Confirm Password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                                   placeholder="Confirm password" required>

                        </div>
                        <!-- Button -->
                        <div class="col-span-2 mt-[26px]">
                            <!-- Button Primary -->
                            <div class="group rounded-full bg-primary p-1">
                                <a href="#!" class="btn-primary text-white p-1 text-center" id="registerButton">
                                    <p>
                                        Create My Account
                                    </p>
                                </a>
                                <button type="submit" class="hidden"></button>
                            </div>
                        </div>
                        <!-- Create New Account Button -->
                        <div class="col-span-2 text-center">
                            <a href="<?php echo e(route('login')); ?>" class="btn-secondary">
                                <p>Sign In</p>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("toggleSidebar").addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah tautan bawa Anda ke halaman lain

            var sidebar = document.getElementById("sidebar");
            if (sidebar.style.display === "block") {
                sidebar.style.display = "none";
            } else {
                sidebar.style.display = "block";
            }
        });

    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 300,
            easing: 'ease-out'
        });
    </script>

    <script src="<?php echo e(url('js/script.js')); ?>"></script>
    <script>
        $('#registerButton').click(function() {
            $('#registerForm').submit();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/registeradmin.blade.php ENDPATH**/ ?>