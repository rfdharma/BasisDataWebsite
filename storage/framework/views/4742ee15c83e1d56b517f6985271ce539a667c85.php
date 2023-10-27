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
            <a href="<?php echo e(route('owner.vehicles.index')); ?>">
                ←
            </a>
            <?php echo __('Vehicle &raquo; Edit &raquo; ') . $vehicle->name; ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                <?php if($errors->any()): ?>
                    <div class="mb-5" role="alert">
                        <div class="rounded-t bg-red-500 text-white px-4 py-2 font-bold">
                            Terdapat kesalahan!
                        </div>
                        <div class="rounded-b border border-t-0 border-red-400 bg-red-100 px-4 py-3 text-red-700">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form class="w-full" action="<?php echo e(route('owner.vehicles.update', $vehicle->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Input untuk Nama Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="name">
                                Nama Kendaraan*
                            </label>
                            <input value="<?php echo e(old('name') ?? $vehicle->name); ?>" name="name"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Nama Kendaraan" required />
                            <div class="mt-2 text-sm text-gray-500">
                                Nama kendaraan. Contoh: Kendaraan 1, Kendaraan 2, Kendaraan 3, dsb. Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Type Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="type_id">Type*</label>
                            <select name="type_id"
                                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                    required>
                                <option value="">Select Type</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(old('type_id', $vehicle->type_id) == $type->id ? 'selected' : ''); ?>>
                                        <?php echo e($type->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Type of the vehicle. E.g., Sport Car, Electric Car, etc. Required.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Brand ID -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="brand_id">
                                Merek Kendaraan*
                            </label>
                            <select name="brand_id" id="brand_id" class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" required>
                                <option value="" disabled selected>Select Brand</option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brand->id); ?>" <?php echo e(old('brand_id', $vehicle->brand_id) == $brand->id ? 'selected' : ''); ?>>
                                        <?php echo e($brand->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Pilih merek kendaraan. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Capacity -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="capacity">
                                Kapasitas*
                            </label>
                            <input value="<?php echo e(old('capacity') ?? $vehicle->capacity); ?>" name="capacity"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Kapasitas Kendaraan" required />
                            <div class="mt-2 text-sm text-gray-500">
                                Kapasitas kendaraan. Contoh: 4 orang. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Harga Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="price">
                                Harga Kendaraan
                            </label>
                            <input value="<?php echo e(old('price') ?? $vehicle->price); ?>" name="price"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="number" placeholder="Harga Kendaraan" />
                            <div class="mt-2 text-sm text-gray-500">
                                Harga kendaraan. Contoh: 1000000. Opsional.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Fitur Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="features">
                                Fitur Kendaraan
                            </label>
                            <input value="<?php echo e(old('features') ?? $vehicle->features); ?>" name="features"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                                   type="text" placeholder="Fitur Kendaraan" />
                            <div class="mt-2 text-sm text-gray-500">
                                Fitur kendaraan. Misalnya: Fitur 1, Fitur 2, Fitur 3, dsb. Opsional.
                            </div>
                        </div>
                    </div>

                    <!-- Input untuk Menambah Foto Kendaraan -->
                    <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
                        <div class="w-full">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                Tambah Foto Kendaraan
                            </label>
                            <input name="photos[]" accept="image/*" multiple type="file"
                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none" />
                            <div class="mt-2 text-sm text-gray-500">
                                Unggah satu atau lebih foto kendaraan. Opsional.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

                    <!-- Tampilan Foto Kendaraan yang Sudah Ada -->
                    <?php if($photos !== null && count($photos) > 0): ?>
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold leading-tight text-gray-800">List Foto Kendaraan <?php echo e($vehicle->name); ?></h2>
                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative">
                                        <img src="<?php echo e(asset('storage/' . $photo->photos)); ?>" alt="Vehicle Photo" class="w-full h-40 object-cover">
                                        <form action="<?php echo e(route('owner.vehicles.deletePhoto', ['vehicle' => $vehicle, 'id' => $photo->id])); ?>" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Are you sure you want to delete this photo?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M6.293 5.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/owner/vehicles/edit.blade.php ENDPATH**/ ?>