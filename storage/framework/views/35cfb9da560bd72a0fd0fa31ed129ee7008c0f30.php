<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Vehicles')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="mx-auto max-w-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="<?php echo e(route('owner.vehicles.create')); ?>"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Add Vehicle
                </a>
            </div>
            <?php if(session('error')): ?>
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <div class="overflow-hidden shadow sm:rounded-md text-center">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Brand</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Transmission</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Features</th>
                            <th class="px-4 py-2">Year</th>
                            <th class="px-4 py-2">Quantity</th>
                            <th class="px-4 py-2">Photos</th> <!-- Tambah kolom untuk menampilkan foto -->
                            <th class="px-4 py-2">Actions Vehicle</th>
                            <th class="px-4 py-2">Actions Plate Vehicle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $inventory = $vehicle->inventory;
                            ?>
                            <tr>
                                <td class="px-4 py-2"><?php echo e($vehicle->id); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->name); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->brand->name); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->type->name); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->transmission); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->price); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->features); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->year); ?></td>
                                <td class="px-4 py-2"><?php echo e($vehicle->inventory->quantity); ?></td>
                                <td class="px-4 py-2">
                                    <?php if($vehicle->photos): ?>
                                        <?php
                                            $photos = json_decode($vehicle->photos, true);
                                            $photoCount = count($photos);
                                        ?>

                                        <?php if($photoCount > 0): ?>
                                            <?php
                                                $photoName = $photos[$photoCount - 1]['photos']; // Mengakses foto terakhir dalam array
                                            ?>
                                            <img src="<?php echo e(asset('storage/' . $photoName)); ?>" alt="Vehicle Photo" style="max-width: 100px; max-height: 100px">
                                        <?php else: ?>
                                            No Photos
                                        <?php endif; ?>
                                    <?php else: ?>
                                        No Photos
                                    <?php endif; ?>


                                </td>
                                <td class="px-4 py-2">
                                    <a href="<?php echo e(route('owner.vehicles.edit', $vehicle->id)); ?>"
                                       class="px-4 py-2 font-bold text-white bg-gray-500 rounded shadow-lg hover:bg-gray-700"
                                       onclick="return confirm('Are you sure you want to edit this vehicle?')">Edit</a>
                                    <form action="<?php echo e(route('owner.vehicles.destroy', $vehicle->id)); ?>" method="POST" class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-red-600">Delete</button>
                                    </form>
                                </td>

                                <td class="px-4 py-2">
                                    <a href="<?php echo e(route('owner.vehicles.plates.create', $vehicle->id)); ?>"
                                       class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700">Add Plate</a>
                                        <a href="<?php echo e(route('owner.vehicles.plates.index', $vehicle->id)); ?>"
                                           class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">List Plate</a>
                                </td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/vehicles/index.blade.php ENDPATH**/ ?>