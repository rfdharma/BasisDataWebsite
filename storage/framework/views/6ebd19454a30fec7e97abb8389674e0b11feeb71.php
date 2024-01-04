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
                <h2 class="text-xl font-semibold mb-4">Total Brands</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($totalBrand); ?></p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Types</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($totalType); ?></p>
            </div>

            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Total Units</h2>
                <p class="text-3xl font-bold text-center"><?php echo e($totalUnit); ?></p>
            </div>
        </div>


        <div class="mb-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $unitCarNameChart->container(); ?>

            </div>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $BrandCarChart->container(); ?>

            </div>

            <div class="p-6 bg-white rounded shadow">
                <?php echo $TypeCarChart->container(); ?>

            </div>

        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $carYearCountChart->container(); ?>

            </div>

            <div class="p-6 bg-white rounded shadow">
                <?php echo $carCapacityChart->container(); ?>

            </div>

            <div class="p-6 bg-white rounded shadow">
                <?php echo $carTransmissionCountChart->container(); ?>

            </div>
        </div>

        <div class="mb-6 grid grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded shadow">
                <?php echo $barCarYear->container(); ?>

            </div>

            <div class="p-6 bg-white rounded shadow">
                <?php echo $barCarCapacity->container(); ?>

            </div>

            <div class="p-6 bg-white rounded shadow">
                <?php echo $barCarTransmission->container(); ?>

            </div>

        </div>
    </div>

    <!-- Include LarapexCharts library -->
    <script src="<?php echo e($unitCarNameChart->cdn()); ?>"></script>
    <script src="<?php echo e($carYearCountChart->cdn()); ?>"></script>
    <script src="<?php echo e($carTransmissionCountChart->cdn()); ?>"></script>
    <script src="<?php echo e($carCapacityChart->cdn()); ?>"></script>
    <script src="<?php echo e($BrandCarChart->cdn()); ?>"></script>
    <script src="<?php echo e($TypeCarChart->cdn()); ?>"></script>
    <script src="<?php echo e($barCarYear->cdn()); ?>"></script>
    <script src="<?php echo e($barCarCapacity->cdn()); ?>"></script>
    <script src="<?php echo e($barCarTransmission->cdn()); ?>"></script>

    <!-- Render the charts using the scripts provided by LarapexCharts -->
    <?php echo $unitCarNameChart->script(); ?>

    <?php echo $carYearCountChart->script(); ?>

    <?php echo $carCapacityChart->script(); ?>

    <?php echo $carTransmissionCountChart->script(); ?>

    <?php echo $BrandCarChart->script(); ?>

    <?php echo $TypeCarChart->script(); ?>

    <?php echo $barCarYear->script(); ?>

    <?php echo $barCarCapacity->script(); ?>

    <?php echo $barCarTransmission->script(); ?>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/dashboard.blade.php ENDPATH**/ ?>