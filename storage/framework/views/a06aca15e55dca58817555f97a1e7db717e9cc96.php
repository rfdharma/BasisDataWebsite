<?php if (isset($component)) { $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a = $component; } ?>
<?php $component = App\View\Components\FrontLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('front-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FrontLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto py-4">
        <?php if($userBookings->isEmpty()): ?>
            <div class="text-center bg-dark rounded-3xl flex flex-col justify-center items-center p-[30px]" style="height: 500px">
                <header style="margin-bottom: 15px">
                    <h2 class="font-bold text-white" style="padding-bottom: 15px;font-size: 30px">
                        You don't have any reservations
                    </h2>
                    <p class="text-base text-subtlePars" style="font-size: 15px">Get an instant booking to catch up whatever you really want to achieve today, yes.</p>
                </header>
                <!-- Button Primary -->
                <div class="group w-max rounded-full bg-primary p-1 mt-6">
                    <a href="<?php echo e(route('front.catalog')); ?>" class="btn-primary">
                        <p>
                            Book Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
        <?php else: ?>
            <h1 class="text-center text-2xl font-bold mb-4">Your Bookings</h1>
            <div class="flex justify-center items-center">
            <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden">
                <thead class="bg-dark text-white text-gray-600">
                <tr>
                    <th class="py-2 px-3 text-left">Invoice</th>
                    <th class="py-2 px-3 text-left">Name</th>
                    <th class="py-2 px-3 text-left">Vehicle</th>
                    <th class="py-2 px-3 text-left">Start Date</th>
                    <th class="py-2 px-3 text-left">End Date</th>
                    <th class="py-2 px-3 text-left">Booking</th>
                    <th class="py-2 px-3 text-left">Payment</th>
                    <th class="py-2 px-3 text-left">Return</th>
                    <th class="py-2 px-3 text-left">Total Price</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $userBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="py-2 px-3"><?php echo e($booking->id); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->name); ?></td>
                        <td class="py-2 px-3">
                            <?php echo e($booking->vehicle->brand->name); ?>

                            <?php echo e($booking->vehicle->type->name); ?>

                            <?php echo e($booking->vehicle->name); ?>

                        </td>

                        <td class="py-2 px-3"><?php echo e($booking->start_date); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->end_date); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->status); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->payment_status); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->return_status); ?></td>
                        <td class="py-2 px-3"><?php echo e($booking->total_price); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/orders.blade.php ENDPATH**/ ?>