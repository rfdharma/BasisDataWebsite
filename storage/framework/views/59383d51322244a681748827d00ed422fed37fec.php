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
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <h1 class="text-center text-2xl font-bold mb-4">Your Bookings</h1>
            <div class="flex justify-center items-center">
                <table class="min-w-full bg-white border rounded-lg shadow overflow-hidden text-center">
                    <thead class="bg-dark text-white text-gray-600">
                    <tr>
                        <th class="py-2 px-3 text-center">Invoice</th>
                        <th class="py-2 px-3 text-center">Name</th>
                        <th class="py-2 px-3 text-center">Vehicle</th>
                        <th class="py-2 px-3 text-center">Start Date</th>
                        <th class="py-2 px-3 text-center">End Date</th>
                        <th class="py-2 px-3 text-center">Price</th>
                        <th class="py-2 px-3 text-center">Booking</th>
                        <th class="py-2 px-3 text-center">Payment</th>
                        <th class="py-2 px-3 text-center">Return</th>
                        <th class="py-2 px-3 text-center">Plate</th>
                        <th class="py-2 px-3 text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $userBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b">
                            <td class="py-2 px-3"><?php echo e($booking->id); ?></td>
                            <td class="py-2 px-3 text-left"><?php echo e($booking->name); ?></td>
                            <td class="py-2 px-3 text-left">
                                <?php if($booking->vehicle): ?>
                                    <?php echo e($booking->vehicle->brand->name); ?>

                                    <?php echo e($booking->vehicle->type->name); ?>

                                    <?php echo e($booking->vehicle->name); ?>

                                <?php else: ?>
                                    <?php
                                        $deletedVehicle = App\Models\Vehicle::withTrashed()->find($booking->vehicle_id);
                                    ?>
                                    <?php if($deletedVehicle): ?>
                                        <?php echo e($deletedVehicle->brand->name); ?>

                                        <?php echo e($deletedVehicle->type->name); ?>

                                        <?php echo e($deletedVehicle->name); ?>

                                    <?php else: ?>
                                        Data Kendaraan Tidak Ditemukan
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>


                            <td class="py-2 px-3"><?php echo e($booking->start_date); ?></td>
                            <td class="py-2 px-3"><?php echo e($booking->end_date); ?></td>
                            <td class="py-2 px-3"><?php echo e($booking->total_price); ?></td>
                            <td class="py-2 px-3 <?php if($booking->status == 'done'): ?> text-green-500 font-bold <?php elseif($booking->status == 'failed'): ?> text-red-500 font-bold <?php endif; ?>"><?php echo e($booking->status); ?></td>
                            <?php if($booking->payment_status === 'unpaid'): ?>
                                <td class="py-2 px-3">
                                    <button class="bg-red-500 rounded w-full text-white hover:bg-red-600 btn" data-target="popup-<?php echo e($booking->id); ?>">Bayar</button>
                                    <div id="popup-<?php echo e($booking->id); ?>" class="popup text-left fixed inset-0 z-50 border-gray-700 overflow-hidden bg-black flex items-center justify-center hidden" style="margin-top: -13%">
                                        <form action="<?php echo e(route('front.orders.store', ['id' => $booking->id])); ?>" method="POST" enctype="multipart/form-data" style="height: 450px;width: 50%;">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-container bg-white border-gray-700 w-11/12 md:max-w-4xl mx-auto rounded shadow-lg">
                                                <main class="p-4">
                                                    <h1 class="text-xl font-bold mb-4">Invoice (<?php echo e($booking->id); ?>)</h1>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="mb-4">
                                                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                            Detail Pesanan
                                                        </label>
                                                        <!-- Tambahkan detail pesanan di sini -->
                                                        <p class="text-gray-700">Nama: <?php echo e($booking->name); ?></p>
                                                        <p class="text-gray-700">Tanggal Mulai : <?php echo e($booking->start_date); ?></p>
                                                        <p class="text-gray-700">Tanggal Selesai : <?php echo e($booking->end_date); ?></p>
                                                        <p class="text-gray-700">Alamat : <?php echo e($booking->address); ?></p>
                                                        <p class="text-gray-700">Kota : <?php echo e($booking->city); ?></p>
                                                        <p class="text-gray-700">Kode Post : <?php echo e($booking->zip); ?></p>
                                                        <hr class="border-t-2 border-gray-400 my-4">
                                                        <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                            Detail Kendaraan
                                                        </label>
                                                        <p class="text-gray-700">Mobil : <?php echo e($booking->vehicle->brand->name); ?>

                                                            <?php echo e($booking->vehicle->type->name); ?>

                                                            <?php echo e($booking->vehicle->name); ?></p>
                                                        <p class="text-gray-700">Keluaran : <?php echo e($booking->vehicle->year); ?></p>
                                                        <p class="text-gray-700">Transmission : <?php echo e($booking->vehicle->transmission); ?></p>
                                                        <p class="text-gray-700">Capacity : <?php echo e($booking->vehicle->capacity); ?></p>
                                                        <p class="text-gray-700">Total Harga : <?php echo e($booking->total_price); ?></p>
                                                    </div>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="mt-1 flex justify-center items-center">
                                                        <div class="w-full">
                                                            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="photos">
                                                                Upload Bukti Pembayaran
                                                            </label>
                                                            <input name="photos_payments" accept="image/*" type="file"
                                                                   class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus-bg-white focus:outline-none" />
                                                            <div class="mt-2 text-sm text-gray-500">
                                                                Unggah bukti pembayaran Anda di sini.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-t-2 border-gray-400 my-4">
                                                    <div class="flex flex-wrap mt-4 mb-4 -mx-3">
                                                        <div class="w-auto px-3 text-right">
                                                            <button type="submit"
                                                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                                                Kirim Bukti Pembayaran
                                                            </button>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td class="py-2 px-3 <?php if($booking->payment_status == 'success'): ?> text-green-500 font-bold <?php elseif($booking->payment_status == 'failed'): ?> text-red-500 font-bold <?php endif; ?>"><?php echo e($booking->payment_status); ?></td>

                            <?php endif; ?>
                            <td class="py-2 px-3 <?php if($booking->return_status == 'not returned'): ?> text-red-500 font-bold <?php endif; ?>">
                                <?php if($booking->status != 'done'): ?>
                                    -
                                <?php else: ?>
                                    <?php echo e($booking->return_status); ?>

                                <?php endif; ?>

                            </td>

                            <?php if($booking->return_status == 'not returned'): ?>
                                <td class="py-2 px-3">
                                    <?php echo e($booking->rentalPlates->first()?->plate ?? '-'); ?>

                                </td>
                            <?php else: ?>
                                <td class="py-2 px-3">-</td>
                            <?php endif; ?>
                            <td class="py-2 px-3">
                                <?php if($booking->status == 'pending' && $booking->payment_status == 'pending'): ?>
                                    <form action="<?php echo e(route('front.cancel.booking', ['id' => $booking->id])); ?>" method="POST" onsubmit="return confirm('Yakin cancel sekarang?, setelah dikonfirmasi admin tidak bisa cancel')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 rounded">Cancel</button>
                                    </form>
                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Function to show a specific popup
        function showPopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.remove('hidden');
        }

        // Function to hide a specific popup
        function hidePopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.add('hidden');
        }

        // Event listeners for the "Bayar" buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const popupId = event.target.getAttribute('data-target');
                showPopup(popupId);
            });
        });

        // Event listeners to hide popups when the overlay is clicked
        document.querySelectorAll('.popup').forEach(popup => {
            popup.addEventListener('click', (event) => {
                if (event.target === popup) {
                    hidePopup(popup.id);
                }
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a)): ?>
<?php $component = $__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a; ?>
<?php unset($__componentOriginal427056743380f0127f5c6367fdb385e78ff8dc7a); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\BasisDataWebsite\resources\views/orders.blade.php ENDPATH**/ ?>