// Data barang dan penjualan
let items = JSON.parse(localStorage.getItem('items')) || [];
let sales = JSON.parse(localStorage.getItem('sales')) || [];

// Elemen DOM
const itemForm = document.getElementById('itemForm');
const itemTableBody = document.getElementById('itemTableBody');
const salesForm = document.getElementById('salesForm');
const saleItemSelect = document.getElementById('saleItem');
const salesTableBody = document.getElementById('salesTableBody');

// Fungsi untuk menyimpan data ke localStorage
function saveData() {
    localStorage.setItem('items', JSON.stringify(items));
    localStorage.setItem('sales', JSON.stringify(sales));
}

// Fungsi untuk memperbarui daftar barang di tabel
function updateItemTable() {
    itemTableBody.innerHTML = '';
    items.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${item.name}</td>
            <td>${item.price.toLocaleString('id-ID')}</td>
            <td>${item.stock}</td>
            <td><button class="action-btn delete-btn" onclick="deleteItem(${index})">Hapus</button></td>
        `;
        itemTableBody.appendChild(row);
    });
    updateSaleItemOptions();
}

// Fungsi untuk memperbarui opsi barang di form penjualan
function updateSaleItemOptions() {
    saleItemSelect.innerHTML = '<option value="" disabled selected>Pilih Barang</option>';
    items.forEach((item, index) => {
        if (item.stock > 0) {
            const option = document.createElement('option');
            option.value = index;
            option.textContent = `${item.name} (Stok: ${item.stock})`;
            saleItemSelect.appendChild(option);
        }
    });
}

// Fungsi untuk memperbarui tabel penjualan
function updateSalesTable() {
    salesTableBody.innerHTML = '';
    sales.forEach((sale, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${sale.itemName}</td>
            <td>${sale.quantity}</td>
            <td>${(sale.quantity * sale.price).toLocaleString('id-ID')}</td>
            <td>${sale.timestamp}</td>
        `;
        salesTableBody.appendChild(row);
    });
}

// Fungsi untuk menambah barang
itemForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('itemName').value;
    const price = parseInt(document.getElementById('itemPrice').value);
    const stock = parseInt(document.getElementById('itemStock').value);

    items.push({ name, price, stock });
    saveData();
    updateItemTable();
    itemForm.reset();
});

// Fungsi untuk menghapus barang
function deleteItem(index) {
    if (confirm('Yakin ingin menghapus barang ini?')) {
        items.splice(index, 1);
        saveData();
        updateItemTable();
    }
}

// Fungsi untuk mencatat penjualan
salesForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const itemIndex = parseInt(document.getElementById('saleItem').value);
    const quantity = parseInt(document.getElementById('saleQuantity').value);

    if (items[itemIndex].stock >= quantity) {
        items[itemIndex].stock -= quantity;
        const sale = {
            itemName: items[itemIndex].name,
            quantity,
            price: items[itemIndex].price,
            timestamp: new Date().toLocaleString('id-ID')
        };
        sales.push(sale);
        saveData();
        updateItemTable();
        updateSalesTable();
        salesForm.reset();
    } else {
        alert('Stok tidak cukup!');
    }
});

// Inisialisasi tampilan saat halaman dimuat
updateItemTable();
updateSalesTable();