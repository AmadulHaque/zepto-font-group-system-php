<?php
include __DIR__ . "/../../views/layouts/header.php";
?>

<style>
    <?php foreach ($fonts as $font): ?>
        @font-face {
            font-family: '<?= htmlspecialchars($font['name']) ?>';
            src: url('<?= htmlspecialchars($font['path']) ?>') format('truetype');
        }
    <?php endforeach; ?>
</style>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Font Name</th>
                <th scope="col" class="px-6 py-3">File Path</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fonts)): ?>
                <?php foreach ($fonts as $font): ?>
                    <tr class=" odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 tr<?= $font['id'] ?>">
                        <th scope="row" class="px-6 py-4 text-gray-900 dark:text-white text-lg" style="font-family: '<?= htmlspecialchars($font['name']) ?>';">
                            <?= htmlspecialchars($font['name']) ?>
                        </th>
                        <td class="px-6 py-4"><?= htmlspecialchars($font['path']) ?></td>
                        <td class="px-6 py-4">
                            <span  data-id="<?= $font['id'] ?>" class=" delete-font text-red-600 dark:text-red-500 hover:underline">Delete</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center">No fonts uploaded yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
include __DIR__ . "/../../views/layouts/footer.php";
?>
