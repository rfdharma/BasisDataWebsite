<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto pt-6">

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Most Penalized Car</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($carNameWithHighestPenalty); ?></p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Top Average Revenue Car</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($topRevenueCar); ?></p>
            </div>


            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Revenues</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($totalrevenues); ?></p>
            </div>


        </div>

        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $topRentCar->container(); ?>

            </div>
        </div>
        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $revenuesNameCarChart->container(); ?>

            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">

            <div class="p-6 bg-white rounded shadow">
                <?php echo $rentFeeHappened->container(); ?>

            </div>
            <div class="p-6 bg-white rounded shadow">
                <?php echo $revenuesBrandCarChart->container(); ?>

            </div>
        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $RentbyBrandChart->container(); ?>

            </div>
            <div class="p-6 bg-white rounded shadow">
                <?php echo $RentbyDateChart->container(); ?>

            </div>
            <div class="p-6 bg-white rounded shadow">
                <?php echo $RentbyTypeChart->container(); ?>

            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">
            <div class="mb-6">
                <div class="p-6 bg-white rounded shadow">
                    <?php echo $feeProfitCar->container(); ?>

                </div>
            </div>

            <div class="mb-6">
                <div class="p-6 bg-white rounded shadow">
                    <?php echo $feeProfitBrandCar->container(); ?>

                </div>
            </div>

        </div>




    </div>

    <!-- Include LarapexCharts library -->
    <script src="<?php echo e($revenuesBrandCarChart->cdn()); ?>"></script>
    <script src="<?php echo e($revenuesNameCarChart->cdn()); ?>"></script>
    <script src="<?php echo e($RentbyBrandChart->cdn()); ?>"></script>
    <script src="<?php echo e($RentbyTypeChart->cdn()); ?>"></script>
    <script src="<?php echo e($RentbyDateChart->cdn()); ?>"></script>
    <script src="<?php echo e($rentFeeHappened->cdn()); ?>"></script>
    <script src="<?php echo e($topRentCar->cdn()); ?>"></script>
    <script src="<?php echo e($feeProfitCar->cdn()); ?>"></script>
    <script src="<?php echo e($feeProfitBrandCar->cdn()); ?>"></script>


    <!-- Render the charts using the scripts provided by LarapexCharts -->
    <?php echo $revenuesBrandCarChart->script(); ?>

    <?php echo $revenuesNameCarChart->script(); ?>

    <?php echo $RentbyBrandChart->script(); ?>

    <?php echo $RentbyTypeChart->script(); ?>

    <?php echo $RentbyDateChart->script(); ?>

    <?php echo $rentFeeHappened->script(); ?>

    <?php echo $topRentCar->script(); ?>

    <?php echo $feeProfitCar->script(); ?>

    <?php echo $feeProfitBrandCar->script(); ?>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/dashboard_rental.blade.php ENDPATH**/ ?>