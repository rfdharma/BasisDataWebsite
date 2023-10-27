<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Admin <?php $__env->endSlot(); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            <?php echo __('Vehicle &raquo; Create'); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <?php if(session('error')): ?>
                    <div class="mb-5" role="alert">
                        <div class="rounded-t bg-red-500 px-4 py-2 font-bold text-white">
                            Oops! Something went wrong.
                        </div>
                        <div class="rounded-b border border-t-0 border-red-400 bg-red-100 px-4 py-3 text-red-700">
                            <?php echo e(session('error')); ?>

                        </div>
                    </div>
                <?php endif; ?>



                <form class="w-full" action="<?php echo e(route('owner.vehicles.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <!-- Field for Name -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="name">Name*</label>
                            <input value="<?php echo e(old('name')); ?>" name="name"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Name" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Name of the vehicle. E.g., Vehicle 1, Vehicle 2, etc. Required. Maximum 255 characters.
                            </div>
                        </div>
                    </div>


                    <!-- Field for Brand -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="brand_id">Brand*</label>
                            <select name="brand_id"
                                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                    required>
                                <option value="">Select Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brand->id); ?>" <?php echo e(old('brand_id') == $brand->id ? 'selected' : ''); ?>>
                                        <?php echo e($brand->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Brand of the vehicle. E.g., Subaru, Toyota, etc. Required.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Type -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="type_id">Type*</label>
                            <select name="type_id"
                                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                    required>
                                <option value="">Select Type</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(old('type_id') == $type->id ? 'selected' : ''); ?>>
                                        <?php echo e($type->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Type of the vehicle. E.g., Sport Car, Electric Car, etc. Required.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Transmission -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="transmission">Transmission</label>
                            <input value="<?php echo e(old('transmission')); ?>" name="transmission"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Transmission">
                            <div class="mt-2 text-sm text-gray-500">
                                Transmission type of the vehicle. E.g., Automatic, Manual, etc.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Photos -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">Photos</label>
                            <input name="photos[]" class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" accept="image/png, image/jpeg, image/jpg, image/webp" type="file" multiple>
                            <div class="mt-2 text-sm text-gray-500">
                                Upload one or more photos of the vehicle. Optional.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Features -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="features">Features</label>
                            <input value="<?php echo e(old('features')); ?>" name="features"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Features">
                            <div class="mt-2 text-sm text-gray-500">
                                Features of the vehicle. E.g., Feature 1, Feature 2, Feature 3, etc. Optional. Comma-separated (,).
                            </div>
                        </div>
                    </div>

                    <!-- Field for Price -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="price">Price*</label>
                            <input value="<?php echo e(old('price')); ?>" name="price"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="number" placeholder="Price" min="0" step=".01" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Price of the vehicle. Numeric. E.g., 1000000. Required.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Capacity -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="capacity">Capacity</label>
                            <input value="<?php echo e(old('capacity')); ?>" name="capacity"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="number" placeholder="Capacity">
                            <div class="mt-2 text-sm text-gray-500">
                                Passenger capacity of the vehicle. Numeric.
                            </div>
                        </div>
                    </div>

                    <!-- Field for Year -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="year">Year</label>
                            <input value="<?php echo e(old('year')); ?>" name="year"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="number" placeholder="Year" min="0">
                            <div class="mt-2 text-sm text-gray-500">
                                Manufacturing year of the vehicle. Numeric.
                            </div>
                        </div>
                    </div>
























                    <!-- Submit Button -->
                    <div class="-mx-3 mb-6 flex flex-wrap">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                    class="rounded bg-green-500 px-4 py-2 font-bold text-white shadow-lg hover:bg-green-700">
                                Save Vehicle
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/owner/vehicles/create.blade.php ENDPATH**/ ?>