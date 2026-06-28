const input = document.getElementById('bukti');
const preview = document.getElementById('preview-bukti');
const message = document.getElementById('bukti-message');

function showMessage(text) {

      if (!message) return;

        message.textContent = text;

        message.classList.remove('hidden');

        setTimeout(() => {
            message.classList.add('hidden');
    }, 3000);
}

if (input && preview) {

    let selectedFiles = [];

    input.addEventListener('change', function () {

        const newFiles = Array.from(input.files);

        newFiles.forEach(file => {

            const exists = selectedFiles.some(
                f =>
                    f.name === file.name &&
                    f.size === file.size
            );

            if (!exists) {
                selectedFiles.push(file);
            }
        });
        const totalFiles =
            document.querySelectorAll('[data-bukti-id]').length +
            selectedFiles.length;

        if (totalFiles > 3) {

            showMessage('Maksimal 3 file');

             selectedFiles = selectedFiles.slice(
                0,
                3 - document.querySelectorAll('[data-bukti-id]').length
            );

            syncInputFiles();
            renderFiles();
            return;
        }

        syncInputFiles();
        renderFiles();
    });

    function syncInputFiles() {

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }

    function renderFiles() {

        preview.innerHTML = '';

        selectedFiles.forEach((file, index) => {

            let icon = 'fa-file';

            const extension = file.name
                .split('.')
                .pop()
                .toLowerCase();

            if (extension === 'pdf') {
                icon = 'fa-file-pdf';
            }

            if (
                extension === 'jpg' ||
                extension === 'jpeg' ||
                extension === 'png'
            ) {
                icon = 'fa-file-image';
            }

            const sizeKB = (file.size / 1024).toFixed(1);
            const item = document.createElement('div');
            const fileName =
                file.name.length > 20
                    ? file.name.substring(0, 20) + "..."
                    : file.name;
            item.className =
                'flex items-center justify-between p-4 bg-white/50 rounded-lg';
            item.innerHTML = `
                <div class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-lg bg-white flex items-center justify-center"
                    >
                        <i class="fa-solid ${icon} text-primary"></i>
                    </div>

                    <div>
                        <p class="font-medium text-black line-clamp-1">
                            ${fileName}
                        </p>

                        <p class="text-xs text-black/50">
                            ${sizeKB} KB
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    class="hapus-file cursor-pointer p-2 rounded-lg bg-red-500 text-white"
                    data-index="${index}"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;

            preview.appendChild(item);
        });

        document.querySelectorAll('.hapus-file').forEach(button => {

            button.addEventListener('click', function () {
                const index = Number(this.dataset.index);
                selectedFiles.splice(index, 1);
                syncInputFiles();
                renderFiles();
            });

        });

    }
}