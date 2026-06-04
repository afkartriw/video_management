document.addEventListener('DOMContentLoaded', function () {
    const modalTitle = document.getElementById('modal_title');            
    const name = document.getElementById('name');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const status = document.getElementById('status');

    document.querySelectorAll('.buka_modal').forEach(function (el) {
        el.addEventListener('click', function () {

            document.getElementById('view_customer').classList.remove('hidden');
            document.getElementById('batal_simpan').classList.remove('hidden');

            let cek = this.dataset.cek;
            let action = this.dataset.action;

            document.getElementById('cek').value = this.dataset.cek;

            const titles = {
                add: 'Tambah Customer',
                edit: 'Edit Customer',
                detail: 'Detail Customer'
            };

            modalTitle.textContent = titles[cek] || 'Customer';

            if (cek === 'edit' || cek === 'detail') {

                document.getElementById('id_users').value = this.dataset.id;
                document.getElementById('name').value = this.dataset.name;
                document.getElementById('username').value = this.dataset.username;
                document.getElementById('password').value = this.dataset.pw;
                document.getElementById('status').value = this.dataset.status;

                if (cek === 'detail') {
                    name.readOnly = true;
                    username.readOnly = true;
                    password.readOnly = true;
                    status.disabled = true;
                    document.getElementById('batal_simpan').classList.add('hidden');

                }
            }
        });
    });

    document.querySelectorAll('.close').forEach(function (el) {
        el.addEventListener('click', function () {
            tutup_modal()
        });
    });

});

function tutup_modal() {

    let id = document.getElementById('id_users');
    let name = document.getElementById('name');
    let username = document.getElementById('username');
    let password = document.getElementById('password');
    let status = document.getElementById('status');

    document.getElementById('view_customer').classList.add('hidden');

    document.getElementById('id_users').value = '';
    document.getElementById('name').value = '';
    document.getElementById('username').value = '';
    document.getElementById('password').value = '';
    document.getElementById('status').value = '';

    // reset readonly dulu
    [name, username, password].forEach(i => i.removeAttribute('readonly'));
    status.disabled = false;
}