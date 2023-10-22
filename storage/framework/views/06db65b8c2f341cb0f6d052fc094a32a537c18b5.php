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
            <a href="<?php echo e(route('owner.vehicles.index', $vehicle->id)); ?>">
                ←
            </a>
            List Plate Numbers for <?php echo e($vehicle->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if($errors->any()): ?>
                <div class="mb-5 alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if($vehicle->carPlates->isNotEmpty()): ?>
                        <table class="w-full table-auto border border-collapse">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 border-2">Plate Number</th>
                                <th class="px-4 py-2 border-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $vehicle->carPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPlate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 py-2 text-center border-2">
                                        <div class="edit-container hidden">
                                            <form method="POST" action="<?php echo e(route('owner.vehicles.plates.update', ['vehicle' => $vehicle->id, 'plate' => $carPlate->plate])); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="text" name="new_plate" value="<?php echo e($carPlate->plate); ?>" />
                                            </form>
                                        </div>
                                        <div class="display-container font-bold" style="font-size: 20px;">
                                            <?php echo e($carPlate->plate); ?>

                                        </div>
                                    </td>
                                    <td class="px-6 py-2 text-center border-2">
                                        <div class="edit-button-container mb-2">
                                            <div class="col-1 mb-2">
                                                <button type="submit" class="save-button px-6 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700 hidden" onclick="return confirm('Anda yakin ingin menyimpan data ini?')">Save</button>
                                            </div>
                                            <div class="col-2">
                                                <button class="display-button px-4 py-2 font-bold text-white bg-gray-500 rounded shadow-lg hover-bg-gray-700 hidden">Cancel</button>
                                            </div>
                                            <div class="col-3">
                                                <button class="edit-button px-6 py-2 font-bold text-white bg-gray-500 rounded shadow-lg hover:bg-gray-700" onclick="return confirm('Anda yakin ingin update data ini?')">Edit</button>
                                            </div>
                                        </div>
                                        <div class="delete-button-container">
                                            <form action="<?php echo e(route('owner.vehicles.plates.destroy', ['vehicle' => $vehicle->id, 'plate' => $carPlate->plate])); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plate?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-red-600">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No plates are associated with this vehicle.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-button');
            const displayButtons = document.querySelectorAll('.display-button');
            const saveButtons = document.querySelectorAll('.save-button');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const row = button.closest('tr');
                    const editContainer = row.querySelector('.edit-container');
                    const displayButton = row.querySelector('.edit-button-container .display-button');
                    const displayContainer = row.querySelector('.display-container');
                    const saveButton = row.querySelector('.save-button');

                    displayButton.classList.remove('hidden');
                    button.classList.add('hidden');
                    displayContainer.classList.add('hidden');
                    editContainer.classList.remove('hidden');
                    saveButton.classList.remove('hidden');
                });
            });

            displayButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const row = button.closest('tr');
                    const editContainer = row.querySelector('.edit-container');
                    const displayButton = row.querySelector('.edit-button-container .display-button');
                    const displayContainer = row.querySelector('.display-container');
                    const editButton = row.querySelector('.edit-button');
                    const saveButton = row.querySelector('.save-button');

                    editButton.classList.remove('hidden');
                    button.classList.add('hidden');
                    editContainer.classList.add('hidden');
                    displayContainer.classList.remove('hidden');
                    saveButton.classList.add('hidden');
                });
            });

            saveButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const row = button.closest('tr');
                    const editContainer = row.querySelector('.edit-container');
                    const form = editContainer.querySelector('form');
                    form.submit();
                });
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/vehicles/editplate.blade.php ENDPATH**/ ?>