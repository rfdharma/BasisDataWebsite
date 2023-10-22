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
            <?php echo e(__('Bookings')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 items-center">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <div class="p-6">
                    <table class="w-full border divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="py-2">Invoice</th>
                            <th class="py-2">User</th>
                            <th class="py-2">Vehicle</th>
                            <th class="py-2">Mulai</th>
                            <th class="py-2">Selesai</th>
                            <th class="py-2">Status Booking</th>
                            <th class="py-2">Status Pembayaran</th>
                            <th class="py-2">Status Pengembalian</th>
                            <th class="py-2">Total Dibayar</th>
                            <th class="py-2">Available</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($booking->id); ?></td>
                                <td class="text-center"><?php echo e($booking->user->name); ?></td>
                                <td class="text-center">
                                    <?php echo e($booking->vehicle->brand->name); ?>

                                    <?php echo e($booking->vehicle->type->name); ?>

                                    <?php echo e($booking->vehicle->name); ?>

                                </td>
                                <td class="text-center"><?php echo e($booking->start_date); ?></td>
                                <td class="text-center"><?php echo e($booking->end_date); ?></td>
                                <td class="py-2 px-1">
                                    <form method="POST" action="<?php echo e(route('admin.bookings.update', $booking->id)); ?>" onsubmit="return confirm('Are you sure you want to update the data?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <select name="status" class="border-0 rounded-3xl block w-full outline-none <?php if($booking->status != 'done' && $booking->status != 'failed'): ?> border-2 border-blue-500 <?php endif; ?>" <?php if($booking->status == 'done' || $booking->status == 'failed'): ?> disabled <?php endif; ?>>
                                        <option value="pending" <?php echo e($booking->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="confirmed" <?php echo e($booking->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                            <option value="done" <?php echo e($booking->status == 'done' ? 'selected' : ''); ?>>Done</option>
                                            <option value="failed" <?php echo e($booking->status == 'failed' ? 'selected' : ''); ?>>Failed</option>
                                        </select>
                                </td>
                                <td class="py-2 px-1">
                                    <select name="payment_status" class="border-0 rounded-3xl block w-full outline-none <?php if($booking->status == 'confirmed'): ?> border-2 border-blue-500 <?php endif; ?>" <?php if($booking->status != 'confirmed'): ?> disabled <?php endif; ?>>
                                        <option value="pending" <?php echo e($booking->payment_status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="success" <?php echo e($booking->payment_status == 'success' ? 'selected' : ''); ?>>Success</option>
                                        <option value="failed" <?php echo e($booking->payment_status == 'failed' ? 'selected' : ''); ?>>Failed</option>
                                    </select>
                                </td>
                                <td class="py-2 px-1">
                                    <select name="return_status" class="border-0 rounded-3xl block w-full outline-none <?php if($booking->status == 'done' && $booking->return_status == 'not returned'): ?> border-2 border-blue-500 <?php endif; ?>" <?php if($booking->status != 'done' || $booking->return_status != 'not returned'): ?> disabled <?php endif; ?>>
                                        <option value="not returned" <?php echo e($booking->return_status == 'not returned' ? 'selected' : ''); ?>>Not Returned</option>
                                        <option value="returned" <?php echo e($booking->return_status == 'returned' ? 'selected' : ''); ?>>Returned</option>
                                        <option value="expired" <?php echo e($booking->return_status == 'expired' ? 'selected' : ''); ?>>Expired</option>
                                    </select>
                                </td>
                                <td class="text-center"><?php echo e($booking->total_price); ?></td>
                                <td class="text-center">
                                    <?php if($booking->vehicle->inventory->available == 1): ?>
                                        True
                                    <?php else: ?>
                                        False
                                    <?php endif; ?>
                                </td>

                                <td class="py-2 px-2">
                                    <button type="submit" class="mb-1 w-full px-2 py-1 text-xs text-white transition duration-500 rounded-md select-none ease focus:outline-none focus:shadow-outline" style="background: #008652">Save</button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('admin.bookings.destroy', $booking->id)); ?>" onsubmit="return confirm('Are you sure you want to delete the data?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline">Delete</button>
                                    </form>
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

<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>