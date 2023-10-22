<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo e(config('app.name', 'Laravel')); ?></title>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

	<!-- Libraries -->
	<link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet"
		href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	<!-- Scripts -->
	<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
	<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js">
	</script>
	<script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js"></script>
	<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
	<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	
	<?php if(session()->has('error')): ?>
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: '<?php echo e(session('error')); ?>',
		})
	</script>
	<?php endif; ?>

	
	<?php if(session()->has('success')): ?>
	<script>
		Swal.fire({
			icon: 'success',
			title: 'Berhasil',
			text: '<?php echo e(session('success')); ?>',
		})
	</script>
	<?php endif; ?>

	<!-- Styles -->
	<style>
		/*Form fields*/
		.dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
			color: #4a5568;
			/*text-gray-700*/
			padding-left: 1rem;
			/*pl-4*/
			padding-right: 1rem;
			/*pl-4*/
			padding-top: .5rem;
			/*pl-2*/
			padding-bottom: .5rem;
			/*pl-2*/
			line-height: 1.25;
			/*leading-tight*/
			border-width: 2px;
			/*border-2*/
			border-radius: .25rem;
			border-color: #edf2f7;
			/*border-gray-200*/
			background-color: #edf2f7;
			/*bg-gray-200*/
		}
        select:disabled {
            appearance: none;
            background-image: none;
        }

		.dataTables_wrapper select {
			padding-right: 1.5rem;
		}

		/*Row Hover*/
		table.dataTable.hover tbody tr:hover,
		table.dataTable.display tbody tr:hover {
			background-color: #ebf4ff;
			/*bg-indigo-100*/
		}

		/*Pagination Buttons*/
		.dataTables_wrapper .dataTables_paginate .paginate_button {
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Pagination Buttons - Current selected */
		.dataTables_wrapper .dataTables_paginate .paginate_button.current {
			color: #fff !important;
			/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
			/*shadow*/
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			background: #008652 !important;
			/*bg-indigo-500*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Pagination Buttons - Hover */
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			color: #fff !important;
			/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
			/*shadow*/
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			background: #008652 !important;
			/*bg-indigo-500*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Add padding to bottom border */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;
			/*border-b-1 border-gray-300*/
			margin-top: 0.75em;
			margin-bottom: 0.75em;
		}

		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
		table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #008652 !important;
			/*bg-indigo-500*/
		}

		table.dataTable tr th.select-checkbox.selected::after {
			content: "✔";
			margin-top: -11px;
			margin-left: -4px;
			text-align: center;
			text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
		}
	</style>
	<?php echo \Livewire\Livewire::styles(); ?>

</head>

<body class="font-sans antialiased">

	<div class="min-h-screen bg-gray-100">
		<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-menu')->html();
} elseif ($_instance->childHasBeenRendered('5TR12BC')) {
    $componentId = $_instance->getRenderedChildComponentId('5TR12BC');
    $componentTag = $_instance->getRenderedChildComponentTagName('5TR12BC');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5TR12BC');
} else {
    $response = \Livewire\Livewire::mount('navigation-menu');
    $html = $response->html();
    $_instance->logRenderedChild('5TR12BC', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

		<!-- Page Heading -->
		<?php if(isset($header)): ?>
		<header class="bg-white shadow">
			<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
				<?php echo e($header); ?>

			</div>
		</header>
		<?php endif; ?>

		<!-- Page Content -->
		<main>
			<?php echo e($slot); ?>

		</main>
	</div>

	<?php echo $__env->yieldPushContent('modals'); ?>

	<?php echo \Livewire\Livewire::scripts(); ?>


	<?php echo e($script ?? ''); ?>

	<?php echo e($modal ?? ''); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/layouts/app.blade.php ENDPATH**/ ?>