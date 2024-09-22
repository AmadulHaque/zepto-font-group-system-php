<?php
    include __DIR__ . "/../../views/layouts/header.php";
?>



<form id="group_form" class=" mx-auto"  method="post" >
    <input type="text" name="group_name" placeholder="Group Name"  class=" mb-2 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" >
    <div id="main_item">
        <div  class="grid md:grid-cols-4 md:gap-3 px-[15px] py-[13px] border border-[#ebebeb] rounded-[5px]  mb-2">
            <input type="text"  name="name[]" placeholder="Font Name" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <select name="font_id[]"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php foreach ($fonts as $font): ?>
                    <option value="<?= htmlspecialchars($font['id']) ?>"><?= htmlspecialchars($font['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="size[]" placeholder="Specific Size" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <input type="number" name="price[]" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
    </div>

    <div class="w-full pt-[10px]">    
        <button  type="button" id="add-row" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Add New
            </span>
        </button>
        <button type="submit" class="float-right text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
    </div>

</form>

<div id="copy_item" class="hidden">
    <div class="grid md:grid-cols-4 md:gap-3 px-[15px] py-[13px] border border-[#ebebeb] rounded-[5px] mb-2 relative">
        <input type="text"  name="name[]" placeholder="Font Name" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <select name="font_id[]"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php foreach ($fonts as $font): ?>
                <option value="<?= htmlspecialchars($font['id']) ?>"><?= htmlspecialchars($font['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="size[]" placeholder="Specific Size" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <input type="number" name="price[]" class="block  p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <button type="button" class="remove_item  absolute w-[19px] right-[0]"><img src="/assets/images/remove.png" alt=""></button>        
    </div>
</div>



<?php
    include __DIR__ . "/../../views/layouts/footer.php";
?>
