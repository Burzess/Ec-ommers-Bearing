import './bootstrap';
import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Matikan alert default DataTables agar warning tidak tampil sebagai popup.
DataTable.ext.errMode = 'none';

document.addEventListener('DOMContentLoaded', () => {
	const tables = document.querySelectorAll('.js-admin-datatable');

	tables.forEach((table) => {
		// Hindari inisialisasi ganda jika ada partial render atau script dipanggil ulang.
		if (table.dataset.datatableInited === 'true') {
			return;
		}

		const pageLength = Number.parseInt(table.dataset.pageLength ?? '10', 10);
		const searching = table.dataset.searching !== 'false';

		new DataTable(table, {
			searching: searching,
			paging: true, // Pagination tetap ada
			lengthChange: false, // Dropdown dihilangkan
			pageLength: 50, // Menampilkan 50 data secara default agar "terlihat semua"
			ordering: true,
			order: [], // Jangan urutkan kolom apapun saat pertama kali dimuat
			columnDefs: [
				{ orderable: false, targets: '.no-sort' } // Matikan sorting pada kolom No.
			],
			language: {
				search: 'Cari:',
				info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
				infoEmpty: 'Tidak ada data',
				emptyTable: 'Data tidak tersedia',
				zeroRecords: 'Data tidak ditemukan',
				paginate: {
					first: '&laquo;&laquo;', // Awal
					last: '&raquo;&raquo;', // Akhir
					next: '&raquo;', // Berikutnya
					previous: '&laquo;', // Sebelumnya
				},
			},
		});

		table.dataset.datatableInited = 'true';
	});
});
