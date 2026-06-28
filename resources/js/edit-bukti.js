const deleteButtons = document.querySelectorAll('.hapus-bukti-lama');
const deleteContainer = document.getElementById('hapus-bukti-container');

if (deleteButtons.length && deleteContainer) {

    deleteButtons.forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

            const card = document.querySelector(
                `[data-bukti-id="${id}"]`
            );

            if (card) {
                card.remove();
            }

            const exists = deleteContainer.querySelector(
                `input[value="${id}"]`
            );

            if (!exists) {

                const input = document.createElement('input');

                input.type = 'hidden';
                input.name = 'hapus_bukti[]';
                input.value = id;

                deleteContainer.appendChild(input);
            }
        });
    });
}