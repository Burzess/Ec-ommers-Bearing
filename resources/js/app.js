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

		new DataTable(table, {
			pageLength: Number.isNaN(pageLength) ? 10 : pageLength,
			lengthMenu: [10, 25, 50, 100],
			ordering: true,
			language: {
				search: 'Cari:',
				lengthMenu: 'Tampilkan _MENU_ data',
				info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
				infoEmpty: 'Tidak ada data',
				emptyTable: 'Data tidak tersedia',
				zeroRecords: 'Data tidak ditemukan',
				paginate: {
					first: 'Awal',
					last: 'Akhir',
					next: 'Berikutnya',
					previous: 'Sebelumnya',
				},
			},
		});

		table.dataset.datatableInited = 'true';
	});
});
