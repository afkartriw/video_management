document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('view_video');
    const aksesBox = document.getElementById('akses_box');

    const judul = document.getElementById('judul');
    const deskripsi = document.getElementById('deskripsi');
    const pesan = document.getElementById('pesan');
    const status = document.getElementById('status_req');
    const mulai = document.getElementById('mulai');
    const selesai = document.getElementById('selesai');
    const idReq = document.getElementById('id_req');

    // OPEN MODAL
    document.querySelectorAll('.buka_modal').forEach(btn => {
        btn.addEventListener('click', function () {

            modal.classList.remove('hidden');

            idReq.value = this.dataset.id;
            judul.value = this.dataset.judul;
            deskripsi.value = this.dataset.deskripsi;
            pesan.value = this.dataset.pesan;

            status.value = this.dataset.status || 'pending';

            // akses data
            mulai.value = this.dataset.mulai || '';
            selesai.value = this.dataset.selesai || '';

            toggleAkses(status.value);
        });
    });

    // CLOSE MODAL
    document.querySelectorAll('.close').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    });

    // STATUS CHANGE
    status.addEventListener('change', function () {
        toggleAkses(this.value);
    });

    function toggleAkses(value) {
        if (value === 'acc') {
            aksesBox.classList.remove('hidden');
        } else {
            aksesBox.classList.add('hidden');
            mulai.value = '';
            selesai.value = '';
        }
    }

});