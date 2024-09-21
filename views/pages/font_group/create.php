<?php
include __DIR__ . "/../../views/layouts/header.php";
?>


<form id="font-group-form">
    <div id="font-rows">
        <div class="font-row">
            <select class="font-select" required>
                <option value="">Select Font</option>
                <!-- Populate options dynamically with available fonts -->
                <?php foreach ($fonts as $font): ?>
                    <option value="<?= htmlspecialchars($font['id']) ?>"><?= htmlspecialchars($font['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="button" id="add-row">Add Row</button>
    <button type="submit">Create Font Group</button>
</form>
<div id="response-message"></div>

<script>
    let rowCount = 1;

    document.getElementById('add-row').addEventListener('click', function() {
        rowCount++;
        const newRow = document.createElement('div');
        newRow.classList.add('font-row');
        newRow.innerHTML = `
            <select class="font-select" required>
                <option value="">Select Font</option>
                <?php foreach ($fonts as $font): ?>
                    <option value="<?= htmlspecialchars($font['id']) ?>"><?= htmlspecialchars($font['name']) ?></option>
                <?php endforeach; ?>
            </select>
        `;
        document.getElementById('font-rows').appendChild(newRow);
    });

    document.getElementById('font-group-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedFonts = document.querySelectorAll('.font-select');
        const selectedFontIds = Array.from(selectedFonts).map(select => select.value).filter(id => id);

        if (selectedFontIds.length < 2) {
            document.getElementById('response-message').innerText = 'Please select at least two fonts.';
            return;
        }

        // Handle the AJAX submission
        const formData = new FormData(this);
        // Add selected font IDs to formData here if necessary
        // AJAX call to save the font group
    });
</script>




<?php
    include __DIR__ . "/../../views/layouts/footer.php";
?>
