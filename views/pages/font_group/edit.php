<?php
include __DIR__ . "/../../views/layouts/header.php";
?>

<form id="group_form_up" class="mx-auto" method="post">
    <input type="hidden" name="group_id" value="<?= $fontGroup['id'] ?>" >
    <input type="text" name="group_name" placeholder="Enter Group Name" value="<?= htmlspecialchars($fontGroup['group_name']) ?>" class="mb-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
    
    <div id="main_item">
        <?php if (!empty($group_fonts_list)): ?>
            <?php foreach ($group_fonts_list as $item): ?>
                <input type="hidden" name="id[]" value="<?= $item['id'] ?>" >
                <div class="grid md:grid-cols-4 md:gap-3 px-[15px] py-[13px] border border-[#ebebeb] rounded-[5px] mb-2">
                    <input type="text" name="name[]" value="<?= htmlspecialchars($item['name']) ?>" placeholder="Enter Font Name" class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <select name="font_id[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($fonts as $font): ?>
                            <option value="<?= htmlspecialchars($font['id']) ?>" <?= $font['id'] == $item['font_id'] ? 'selected' : '' ?>><?= htmlspecialchars($font['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="size[]" value="<?= $item['size'] ?>" placeholder="Enter Specific Size" class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <input type="number" name="price[]" value="<?= $item['price'] ?>" placeholder="Enter Price" class="block p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="w-full pt-[10px]">    
        <button type="submit" class="float-right text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
    </div>

</form>

<?php
include __DIR__ . "/../../views/layouts/footer.php";
?>
