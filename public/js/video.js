document.addEventListener('DOMContentLoaded', function () {

    const modalTitle = document.getElementById('modal_title');
    const judul = document.getElementById('judul');
    const deskripsi = document.getElementById('deskripsi');
    const link = document.getElementById('link');
    const tanggal = document.getElementById('tanggal');
    const status = document.getElementById('status');

    const inputVideo = document.getElementById('video');
    const previewVideo = document.getElementById('previewVideo');
    const removeVideoBtn = document.getElementById('removeVideo');

    const inputThumbnail = document.getElementById('thumbnail');
    const previewThumbnail = document.getElementById('previewThumbnail');
    const removeThumbnailBtn = document.getElementById('removeThumbnail');

    document.querySelectorAll('.buka_modal').forEach(function (el) {

        el.addEventListener('click', function () {

            document.getElementById('view_video').classList.remove('hidden');
            document.getElementById('batal_simpan').classList.remove('hidden');

            let cek = this.dataset.cek;

            document.getElementById('cek').value = cek;

            const titles = {
                add: 'Tambah Video',
                edit: 'Edit Video',
                detail: 'Detail Video'
            };

            modalTitle.textContent = titles[cek] || 'Video';

            if (cek === 'add') {
                document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
            }

            if (cek === 'edit' || cek === 'detail') {

                document.getElementById('id_vid').value = this.dataset.id;
                document.getElementById('judul').value = this.dataset.judul;
                document.getElementById('deskripsi').value = this.dataset.deskripsi;
                if (tanggal) {
                    tanggal.value = this.dataset.tanggal;
                }
                document.getElementById('status').value = this.dataset.status;

                // =========================
                // PREVIEW VIDEO LAMA
                // =========================
                if (this.dataset.link) {
                    previewVideo.src = '/videos/' + this.dataset.link;
                    previewVideo.classList.remove('hidden');

                    if (cek === 'edit') {
                        removeVideoBtn.classList.remove('hidden');
                    }
                }

                // =========================
                // PREVIEW THUMBNAIL LAMA
                // =========================
                if (this.dataset.thumbnail) {
                    previewThumbnail.src = '/thumbnails/' + this.dataset.thumbnail;
                    previewThumbnail.classList.remove('hidden');

                    if (cek === 'edit') {
                        removeThumbnailBtn.classList.remove('hidden');
                    }
                }

                if (cek === 'detail') {

                    judul.readOnly = true;
                    deskripsi.readOnly = true;

                    if (tanggal) {
                        tanggal.readOnly = true;
                    }

                    status.disabled = true;

                    inputVideo.disabled = true;
                    inputThumbnail.disabled = true;

                    document.getElementById('batal_simpan').classList.add('hidden');
                }
            }
        });

    });

    document.querySelectorAll('.close').forEach(function (el) {
        el.addEventListener('click', function () {
            tutup_modal();
        });
    });

    // =========================
    // PREVIEW VIDEO BARU
    // =========================
    if (inputVideo) {

        inputVideo.addEventListener('change', function () {

            const file = this.files[0];

            if (file) {

                previewVideo.src = URL.createObjectURL(file);
                previewVideo.classList.remove('hidden');

                removeVideoBtn.classList.remove('hidden');
            }

        });

    }

    if (removeVideoBtn) {

        removeVideoBtn.addEventListener('click', function () {

            inputVideo.value = '';
            previewVideo.src = '';
            previewVideo.classList.add('hidden');

            removeVideoBtn.classList.add('hidden');

        });

    }

    // =========================
    // PREVIEW THUMBNAIL BARU
    // =========================
    if (inputThumbnail) {

        inputThumbnail.addEventListener('change', function () {

            const file = this.files[0];

            if (file) {

                previewThumbnail.src = URL.createObjectURL(file);
                previewThumbnail.classList.remove('hidden');

                removeThumbnailBtn.classList.remove('hidden');
            }

        });

    }

    if (removeThumbnailBtn) {

        removeThumbnailBtn.addEventListener('click', function () {

            inputThumbnail.value = '';
            previewThumbnail.src = '';
            previewThumbnail.classList.add('hidden');

            removeThumbnailBtn.classList.add('hidden');

        });

    }

});

function tutup_modal() {

    const judul = document.getElementById('judul');
    const deskripsi = document.getElementById('deskripsi');
    const tanggal = document.getElementById('tanggal');
    const status = document.getElementById('status');

    const inputVideo = document.getElementById('video');
    const previewVideo = document.getElementById('previewVideo');
    const removeVideoBtn = document.getElementById('removeVideo');

    const inputThumbnail = document.getElementById('thumbnail');
    const previewThumbnail = document.getElementById('previewThumbnail');
    const removeThumbnailBtn = document.getElementById('removeThumbnail');

    document.getElementById('view_video').classList.add('hidden');

    document.getElementById('id_vid').value = '';
    document.getElementById('judul').value = '';
    document.getElementById('deskripsi').value = '';

    if (tanggal) {
        tanggal.value = '';
    }

    status.value = '';

    // reset video
    inputVideo.value = '';
    inputVideo.disabled = false;

    previewVideo.pause();
    previewVideo.src = '';
    previewVideo.classList.add('hidden');

    removeVideoBtn.classList.add('hidden');

    // reset thumbnail
    inputThumbnail.value = '';
    inputThumbnail.disabled = false;

    previewThumbnail.src = '';
    previewThumbnail.classList.add('hidden');

    removeThumbnailBtn.classList.add('hidden');

    // reset readonly
    judul.readOnly = false;
    deskripsi.readOnly = false;

    if (tanggal) {
        tanggal.readOnly = false;
    }

    status.disabled = false;
}