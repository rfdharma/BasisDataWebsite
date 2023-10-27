<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" xmlns:x-transition="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title><?php echo e(config('app.name', 'Laravel')); ?></title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Libraries -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous">
  </script>

  <!-- Scripts -->
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/front.css']); ?>

  <!-- Styles -->
  <?php echo \Livewire\Livewire::styles(); ?>


    <style>
        .popup-blur {
            backdrop-filter: blur(5px); /* Sesuaikan tingkat blur yang Anda inginkan */
            background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan transparansi */
        }

    </style>
</head>

<body>
<div style="display: flex;">
    <!-- Sidebar -->
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->roles == 'USER'): ?>
        <aside class="" id="sidebar" style="background: #2d3748; width: 350px; max-height: 100vh; overflow-y: auto; padding: 20px; display: none;">
            <div style="color: white; font-size: 20px; font-weight: bold; margin-bottom: 20px;" class="text-center">All Notifications</div>
            <?php if($notification == "Tidak ada notifikasi."): ?>
                <p>Tidak ada perubahan</p>
            <?php else: ?>
                <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-white flex focus:outline-none gap-2 mb-1 mt-2 ml-2">
                        <div>
                            <p tabindex="0" class="text-sm leading-none">Invoice <?php echo e($notif->booking_id); ?></p>
                        </div>
                        <div class="w-auto">
                            <p tabindex="0" class="text-sm leading-none"><?php echo e($notif->message); ?></p>
                        </div>
                    </div>
                    <div>
                        <p tabindex="0" class="text-white text-center text-sm font-bold leading-none"><?php echo e($notif->updated_at); ?></p>
                    </div>
                    <button class="btn text-sm text-dark rounded-3xl p-1 bg-gray-50" onclick="markAsRead(<?php echo e($notif->id); ?>)">Read</button>
                    <span class="block w-full border-t border-gray-400 my-4"></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </aside>
       <?php endif; ?>
    <?php endif; ?>


    <!-- Halaman Utama -->
    <main style="flex-grow: 1; display: flex; flex-direction: column;">
        <nav class="container relative my-4 lg:my-10">
            <div class="flex w-full flex-col justify-between lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="<?php echo e(route('front.index')); ?>" class="nav-link-item text-md font-bold rounded-[18px]" style="width: 100px; color: #111827;font-size: 20px">Rental-in</a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="mobileMenuButton p-1 outline-none" id="navbarToggler" data-target="#navigation">
                            <svg class="h-7 w-7 text-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div class="mt-6 flex flex-col items-baseline gap-4 lg:mt-0 lg:flex-row lg:items-center lg:justify-between">
                        <div class="ml-auto flex w-full flex-col gap-4 lg:w-auto lg:flex-row lg:items-center lg:gap-[50px]">
                            <a href="<?php echo e(route('front.index')); ?>" class="nav-link-item">Home</a>
                            <a href="<?php echo e(route('front.catalog')); ?>" class="nav-link-item">Vehicle</a>
                            <a href="<?php echo e(route('front.orders')); ?>" class="nav-link-item">Orders</a>
                            
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <div class="ml-auto flex w-full flex-col lg:w-auto lg:flex-row lg:items-center gap-3">
                                <?php if(auth()->user()->roles == 'USER'): ?>
                                    <div x-data="{ isOpen: false }" class="relative inline-block">
                                        <!-- Dropdown toggle button -->
                                        <button @click="isOpen = !isOpen" class="relative z-10 block p-2 text-gray-700 bg-white border border-transparent rounded-full dark:text-white focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:bg-gray-800 focus:outline-none">
                                            <?php if($notification == "Tidak ada notifikasi."): ?>
                                                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="secondary" d="M15,18H9a3,3,0,0,0,3,3h0A3,3,0,0,0,15,18Z" style="fill: none; stroke: white; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                                    <path id="primary" d="M19.38,14.38a2.12,2.12,0,0,1,.62,1.5h0A2.12,2.12,0,0,1,17.88,18H6.12A2.12,2.12,0,0,1,4,15.88H4a2.12,2.12,0,0,1,.62-1.5L6,13V9a6,6,0,0,1,6-6h0a6,6,0,0,1,6,6v4Z" style="fill: none; stroke: white; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                                                </svg>
                                            <?php else: ?>
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white bg-dark" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 22C10.8954 22 10 21.1046 10 20H14C14 21.1046 13.1046 22 12 22ZM20 19H4V17L6 16V10.5C6 7.038 7.421 4.793 10 4.18V2H13C12.3479 2.86394 11.9967 3.91762 12 5C12 5.25138 12.0187 5.50241 12.056 5.751H12C10.7799 5.67197 9.60301 6.21765 8.875 7.2C8.25255 8.18456 7.94714 9.33638 8 10.5V17H16V10.5C16 10.289 15.993 10.086 15.979 9.9C16.6405 10.0366 17.3226 10.039 17.985 9.907C17.996 10.118 18 10.319 18 10.507V16L20 17V19ZM17 8C16.3958 8.00073 15.8055 7.81839 15.307 7.477C14.1288 6.67158 13.6811 5.14761 14.2365 3.8329C14.7919 2.5182 16.1966 1.77678 17.5954 2.06004C18.9942 2.34329 19.9998 3.5728 20 5C20 6.65685 18.6569 8 17 8Z" fill="currentColor"></path>
                                                </svg>
                                            <?php endif; ?>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isOpen"
                                             @click.away="isOpen = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-90"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-90"
                                             class="z-50 absolute right-0 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg sm:w-80 dark:bg-gray-800">
                                            <div class="text-center text-white py-2 min-w-[216px] max-w-auto ml-2 mr-2">
                                                <?php if($notification == "Tidak ada notifikasi."): ?>
                                                    <p>Tidak ada notifikasi</p>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $notification->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="text-white flex focus:outline-none gap-2 mb-1 mt-2 ml-2">
                                                            <div>
                                                                <p tabindex="0" class="text-sm leading-none">Invoice <?php echo e($notif->booking_id); ?></p>
                                                                <button class="btn text-sm text-dark rounded-3xl p-1 mt-3 bg-gray-50" onclick="markAsRead(<?php echo e($notif->id); ?>)">Read</button>
                                                            </div>
                                                            <div class="w-auto">
                                                                <p tabindex="0" class="text-sm leading-none"><?php echo e($notif->message); ?></p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p tabindex="0" class="text-white text-right text-sm font-bold leading-none"><?php echo e($notif->updated_at); ?></p>
                                                        </div>
                                                        <span class="block w-full border-t border-gray-400 my-4"></span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="mb-1">
                                                            <a href="#" class="text-md text-white nav-link-item" id="toggleSidebar" style="color: white">See All Notifications</a>
                                                        </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                    <div x-data="{ isOpen: false }" class="relative inline-block">
                                        <!-- Dropdown toggle button -->
                                        <button @click="isOpen = !isOpen" class="relative z-10 block text-gray-700 bg-white focus:outline-none">


                                            <?php if(auth()->user()->profile_photo_path): ?>
                                                <img src="<?php echo e(asset('storage/' . auth()->user()->profile_photo_path)); ?>" class=" rounded-full w-10 h-10" alt="Profile Photo">
                                            <?php else: ?>
                                                <img src="<?php echo e(auth()->user()->profile_photo_url); ?>" alt="<?php echo e(auth()->user()->name); ?>" class="rounded-full h-10 w-10 object-cover">
                                            <?php endif; ?>

                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="isOpen"
                                             @click.away="isOpen = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-90"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-90"
                                             class="z-50 absolute right-0 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg sm:w-80 dark:bg-gray-800" style="width: 100px;">
                                            <div class="text-center text-white py-2 block gap-2 ">
                                                <a class="px-2 nav-link-item text-sm" style="color: white" href="<?php echo e(route('profile.show')); ?>">Edit Profile</a>
                                                <span class="block w-full border-t border-gray-400" style="margin-top: 5px;margin-bottom: 5px"></span>
                                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <a class="px-2 nav-link-item text-sm" style="color: white" href="<?php echo e(route('logout')); ?>"
                                                       onclick="event.preventDefault();
                  this.closest('form').submit();">
                                                        Log Out
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                








                            </div>
                        <?php else: ?>
                            <div class="rounded-3xl ml-auto flex w-full flex-col lg:w-auto lg:flex-row lg:items-center lg:gap-12">
                                <a href="<?php echo e(route('login')); ?>" class="nav-link-item text-md font-bold rounded-[18px]" style="width: 100px; color: #111827;font-size: 18px;">
                                    Log In
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </nav>

        <?php echo e($slot); ?>

    </main>
</div>


<script>
    function markAsRead(notificationId) {
        $.ajax({
            type: 'DELETE',
            url: "<?php echo e(route('front.notifications.destroy', '')); ?>" + '/' + notificationId,
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function (response) {
                // Add the 'hidden' class to trigger the fade-out animation
                $("#notification-" + notificationId).addClass('hidden');

                // Remove the element from the DOM immediately
                $("#notification-" + notificationId).remove();
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
        location.reload();
    }

</script>

<script>
    document.getElementById("toggleSidebar").addEventListener("click", function (e) {
        e.preventDefault(); // Mencegah tautan bawa Anda ke halaman lain

        var sidebar = document.getElementById("sidebar");
        if (sidebar.style.display === "block") {
            sidebar.style.display = "none";
        } else {
            sidebar.style.display = "block";
        }
    });

</script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 300,
      easing: 'ease-out'
    });
  </script>

  <script src="<?php echo e(url('js/script.js')); ?>"></script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/layouts/front.blade.php ENDPATH**/ ?>