function setupAccessoryEditHandlers({
    type, // "color" hoặc "size"
    formSelector, // ví dụ: "#accessory-edit-form"
    nameInputSelector, // ví dụ: "#input-name"
}) {
    document.querySelectorAll(`.btn-edit-accessory`).forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            document.getElementById(`name-${id}`).style.display = 'none';
            document.getElementById(`input-name-${id}`).style.display = 'block';

            this.style.display = 'none';
            document.querySelector(`.btn-confirm-edit-accessory[data-id="${id}"]`).style.display = 'inline-block';

            const formAction = `/products/accessories/${type}s/update/${id}`;
            $(formSelector).attr('action', formAction);

            const currentName = document.getElementById(`input-name-${id}`).value;
            $(nameInputSelector).val(currentName);
        });
    });

    document.querySelectorAll(`.btn-confirm-edit-accessory`).forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const updatedName = document.getElementById(`input-name-${id}`).value;
            $(formSelector).find(nameInputSelector).val(updatedName);
            $(formSelector).submit();
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.container-custom');
    const type = container?.dataset.accessoryType;

    if (!type) return;

    setupAccessoryEditHandlers({
        type: type,
        formSelector: '#accessory-edit-form',
        nameInputSelector: '#input-name',
    });
});
