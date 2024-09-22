<?php
include __DIR__ . "/../../views/layouts/header.php";
?>

 <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Fonts</th>
                <th scope="col" class="px-6 py-3">Count</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fontGroups)): ?>
                <?php foreach ($fontGroups as $item): ?>
                    
                    <tr class=" odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 tr<?= $item['id'] ?>">
                        <th scope="row" class="px-6 py-4">
                            <?= htmlspecialchars($item['group_name']) ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php
                                $fontGroup = new  \App\Models\FontGroup();
                                $fontsInGroup = $fontGroup->getFontsByGroupId($item['id']); 
                                echo htmlspecialchars(implode(', ', array_column($fontsInGroup, 'name')));
                            ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= htmlspecialchars($item['font_count']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <a  href="/font/group/edit?id=<?= $item['id'] ?>" class=" text-green-600 dark:text-green-500 hover:underline">Edit</a>
                            <span  data-id="<?= $item['id'] ?>" class="delete_font_group text-red-600 dark:text-red-500 hover:underline">Delete</span>
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
