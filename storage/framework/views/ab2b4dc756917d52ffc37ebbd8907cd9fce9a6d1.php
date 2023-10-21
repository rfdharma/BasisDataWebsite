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
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      <?php echo __('Item &raquo; Sunting &raquo; ' . $item->name); ?>

    </h2>
   <?php $__env->endSlot(); ?>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div>
        <?php if($errors->any()): ?>
          <div class="mb-5" role="alert">
            <div class="rounded-t bg-red-500 px-4 py-2 font-bold text-white">
              Ada kesalahan!
            </div>
            <div class="rounded-b border border-t-0 border-red-400 bg-red-100 px-4 py-3 text-red-700">
              <p>
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              </p>
            </div>
          </div>
        <?php endif; ?>

        <form class="w-full" action="<?php echo e(route('owner.items.update', $item->id)); ?>" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Nama*
              </label>
              <input value="<?php echo e(old('name') ?? $item->name); ?>" name="name"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Nama" required />
              <div class="mt-2 text-sm text-gray-500">
                Nama items. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Brand*
              </label>
              <select name="brand_id"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                required>
                <option value="<?php echo e($item->brand->id); ?>">Tidak Diubah (<?php echo e($item->brand->name); ?>)</option>
                <option disabled>&mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash;</option>
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($brand->id); ?>" <?php echo e(old('brand_id') == $brand->id ? 'selected' : ''); ?>>
                    <?php echo e($brand->name); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Brand item. Contoh: Subaru, Toyota, dsb. Wajib diisi.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Type*
              </label>
              <select name="type_id"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                required>
                <option value="<?php echo e($item->type->id); ?>">Tidak Diubah (<?php echo e($item->type->name); ?>)</option>
                <option disabled>&mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash;</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($type->id); ?>" <?php echo e(old('type_id') == $type->id ? 'selected' : ''); ?>>
                    <?php echo e($type->name); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Type item. Contoh: Sport Car, Electric Car, dsb. Wajib diisi.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Fitur
              </label>
              <input value="<?php echo e(old('features') ?? $item->features); ?>" name="features"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Fitur" />
              <div class="mt-2 text-sm text-gray-500">
                Fitur items. Contoh: Fitur 1, Fitur 2, Fitur 3, dsb. Wajib diisi. Dipisahkan dengan koma (,).
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Foto
              </label>
              <input name="photos[]"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                accept="image/png, image/jpeg, image/jpg, image/webp" type="file" multiple />
              <div class="mt-2 text-sm text-gray-500">
                Foto item. Lebih dari satu foto dapat diupload. Opsional
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 grid grid-cols-3 gap-3 px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Harga
              </label>
              <input value="<?php echo e(old('price') ?? $item->price); ?>" name="price"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Harga" />
              <div class="mt-2 text-sm text-gray-500">
                Harga item. Angka. Contoh: 1000000. Wajib diisi.
              </div>
            </div>

            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Rating
              </label>
              <input value="<?php echo e(old('star') ?? $item->star); ?>" name="star"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Rating" min="1" max="5" step=".01" />
              <div class="mt-2 text-sm text-gray-500">
                Rating item. Angka. Contoh: 5. Opsional.
              </div>
            </div>

            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Review
              </label>
              <input value="<?php echo e(old('review') ?? $item->review); ?>" name="review"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Review" />
              <div class="mt-2 text-sm text-gray-500">
                Review item. Angka. Opsional.
              </div>
            </div>
          </div>

          <div class="-mx-3 mb-6 flex flex-wrap">
            <div class="w-full px-3 text-right">
              <button type="submit" class="rounded bg-green-500 px-4 py-2 font-bold text-white shadow-lg hover:bg-green-700">
                Simpan Item
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Github\rent-car\resources\views/owner/vehicles/edit.blade.php ENDPATH**/ ?>