document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('view_video');
    const judul = document.getElementById('judul');
    const deskripsiVideo = document.getElementById('deskripsi_video');
    const thumbnail = document.getElementById('previewThumbnail');
    const idVid = document.getElementById('id_vid_req');
    const pesanReq = document.getElementById('pesan_req');

    document.querySelectorAll('.buka_modal').forEach(btn => {

        btn.addEventListener('click', function () {

            modal.classList.remove('hidden');

            idVid.value = this.dataset.id;

            judul.value = this.dataset.judul;
            deskripsiVideo.value = this.dataset.deskripsi;

            if (this.dataset.thumbnail) {

                thumbnail.src = '/thumbnails/' + this.dataset.thumbnail;
                thumbnail.classList.remove('hidden');

            } else {

                thumbnail.src = '';
                thumbnail.classList.add('hidden');

            }

        });

    });

    document.querySelectorAll('.close').forEach(btn => {

        btn.addEventListener('click', tutupModal);

    });

    function tutupModal() {

        modal.classList.add('hidden');

        idVid.value = '';
        judul.value = '';
        deskripsiVideo.value = '';
        pesanReq.value = '';

        thumbnail.src = '';
        thumbnail.classList.add('hidden');

    }

});