<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Daftar Pembayaran</h1>

        <?php if($payments->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-md">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-100 border-b">No</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pembayaran</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pemesanan</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">ID Pengguna</th>
                        <th class="px-6 py-3 bg-gray-100 border-b">Foto Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4"><?php echo e($loop->iteration); ?></td>
                            <td class="px-6 py-4"><?php echo e($payment->id); ?></td>
                            <td class="px-6 py-4"><?php echo e($payment->booking_id); ?></td>
                            <td class="px-6 py-4"><?php echo e($payment->user_id); ?></td>
                            <td class="px-6 py-4">
                                <?php if(is_array($payment->photos_payment)): ?>
                                    <?php $__currentLoopData = $payment->photos_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(asset('storage/' . $photo)); ?>" target="_blank">
                                            <img src="<?php echo e(asset('storage/' . $photo)); ?>" alt="Bukti Pembayaran" class="w-16 h-16 rounded-lg">
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $payment->photos_payment)); ?>" alt="Bukti Pembayaran" class="w-16 h-16 rounded-lg">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="mt-4">Tidak ada data pembayaran yang tersedia.</p>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>