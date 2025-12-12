// ==============================
// ELEMENT
// ==============================
const menuCards = document.querySelectorAll('.menu-card');
const selectedMenuList = document.getElementById('selected-menu-list');
const totalHargaDisplay = document.getElementById('total-harga-display');
const totalHargaHidden = document.getElementById('total-harga-hidden');
const itemsInput = document.getElementById('items-input');

const bayarInput = document.getElementById('bayar-input');
const bayarHelp = document.getElementById('bayar-help');
const kembalianDisplay = document.getElementById('kembalian-display');
const kembalianHidden = document.getElementById('kembalian-hidden');
const submitBtn = document.getElementById('submit-btn');
const orderForm = document.getElementById('order-form');

let selectedMenus = [];


// ==============================
// FORMAT RUPIAH
// ==============================
function formatRupiah(number) {
    if (!number || isNaN(number)) return "Rp 0";
    return "Rp " + number.toLocaleString("id-ID");
}

function formatInputRupiah(number) {
    if (!number || isNaN(number)) return "";
    return number.toLocaleString("id-ID");
}

function unformatRupiah(str) {
    return parseInt(str.replace(/\./g, "")) || 0;
}


// ==============================
// KLIK MENU CARD
// ==============================
menuCards.forEach(card => {
    card.addEventListener("click", () => {
        const id = card.dataset.id;
        const nama = card.dataset.menu;
        const harga = parseInt(card.dataset.harga);

        let found = selectedMenus.find(m => m.id == id);

        if (!found) {
            selectedMenus.push({
                id,
                nama,
                harga,
                jumlah: 1
            });
        } else {
            found.jumlah++;
        }
        renderSidebar();
    });
});


// ==============================
// RENDER SIDEBAR ITEM
// ==============================
function renderSidebar() {
    selectedMenuList.innerHTML = "";
    let total = 0;

    if (selectedMenus.length === 0) {
        selectedMenuList.innerHTML = `<p class="text-gray-400">Belum ada menu dipilih.</p>`;
    }

    selectedMenus.forEach((menu, index) => {
        total += menu.harga * menu.jumlah;

        const div = document.createElement("div");
        div.className = "flex justify-between items-center border-b pb-1 py-2";

        div.innerHTML = `
            <div>
                <div class="font-medium">${menu.nama}</div>
                <div class="text-sm text-gray-500">
                    Rp ${menu.harga.toLocaleString("id-ID")} x ${menu.jumlah} =
                    Rp ${(menu.harga * menu.jumlah).toLocaleString("id-ID")}
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="number" min="1" value="${menu.jumlah}"
                    class="w-16 border rounded px-2 py-1 jumlah-input"
                    data-index="${index}">

                <button type="button" class="text-red-600 font-bold remove-menu"
                    data-index="${index}">
                    &times;
                </button>
            </div>
        `;

        selectedMenuList.appendChild(div);
    });

    totalHargaDisplay.textContent = formatRupiah(total);
    totalHargaHidden.value = total;
    itemsInput.value = JSON.stringify(selectedMenus);

    updateKembalian();

    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener("change", e => {
            let i = e.target.dataset.index;
            let v = parseInt(e.target.value);
            if (v < 1) v = 1;
            selectedMenus[i].jumlah = v;
            renderSidebar();
        });
    });

    document.querySelectorAll('.remove-menu').forEach(btn => {
        btn.addEventListener("click", () => {
            let i = btn.dataset.index;
            selectedMenus.splice(i, 1);
            renderSidebar();
        });
    });
}


// ==============================
// UPDATE KEMBALIAN REALTIME
// ==============================
function updateKembalian() {
    let total = parseInt(totalHargaHidden.value) || 0;
    let bayar = unformatRupiah(bayarInput.value);
    let kembalian = bayar - total;

    if (bayar === 0) {
        kembalianDisplay.value = "Rp 0";
        kembalianHidden.value = 0;
        bayarHelp.classList.add('hidden');
        submitBtn.disabled = true;
        return;
    }

    if (kembalian < 0) {
        bayarHelp.classList.remove('hidden');
        kembalianDisplay.value = "Rp 0";
        kembalianHidden.value = 0;
        submitBtn.disabled = true;
    } else {
        bayarHelp.classList.add('hidden');
        kembalianDisplay.value = formatRupiah(kembalian);
        kembalianHidden.value = kembalian;
        submitBtn.disabled = false;
    }
}

bayarInput.addEventListener("input", function () {
    let raw = unformatRupiah(this.value);
    this.value = formatInputRupiah(raw);
    updateKembalian();
});


// ==============================
// CLEAR PESANAN
// ==============================
document.getElementById('clear-btn').addEventListener("click", () => {
    selectedMenus = [];

    selectedMenuList.innerHTML = `<p class="text-gray-400">Belum ada menu dipilih.</p>`;
    totalHargaDisplay.textContent = "Rp 0";
    totalHargaHidden.value = 0;

    bayarInput.value = "";
    bayarHelp.classList.add('hidden');

    kembalianDisplay.value = "Rp 0";
    kembalianHidden.value = 0;

    itemsInput.value = "";
    submitBtn.disabled = true;
});


// ==============================
// SEARCH MENU
// ==============================
document.getElementById('searchMenu').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase().trim();
    document.querySelectorAll('.menu-item').forEach(item => {
        let name = item.querySelector('h2').innerText.toLowerCase();
        item.style.display = name.includes(keyword) ? "" : "none";
    });
});


// ==============================
// SWEETALERT CHECKOUT
// ==============================
orderForm.addEventListener('submit', function(e) {
    e.preventDefault();

    let namaPemesan = document.querySelector('input[name="nama_pemesan"]').value;
    let totalHarga = parseInt(totalHargaHidden.value || 0);
    let bayar = unformatRupiah(bayarInput.value);
    let kembalian = bayar - totalHarga;

    if (selectedMenus.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Belum ada pesanan!',
            text: 'Pilih menu terlebih dahulu.',
        });
        return;
    }

    if (bayar < totalHarga) {
        Swal.fire({
            icon: 'error',
            title: 'Pembayaran tidak cukup!',
            text: 'Bayar harus lebih besar atau sama dengan total harga.',
        });
        return;
    }

    let listHtml = selectedMenus.map(item => `
        <div style="margin-bottom:4px">
            <b>${item.nama}</b> — 
            Rp ${item.harga.toLocaleString()} × ${item.jumlah}
        </div>
    `).join("");

    Swal.fire({
        title: 'Konfirmasi Checkout',
        html: `
            <div style="text-align:left">
                <p><b>Nama Pemesan:</b> ${namaPemesan}</p>
                
                <hr>

                <p><b>Pesanan:</b></p>
                ${listHtml}

                <hr>

                <p><b>Total:</b> Rp ${totalHarga.toLocaleString()}</p>
                <p><b>Bayar:</b> Rp ${bayar.toLocaleString()}</p>
                <p><b>Kembalian:</b> Rp ${kembalian.toLocaleString()}</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Checkout!'
    }).then((result) => {
        if (result.isConfirmed) {
            bayarInput.value = bayar;
            kembalianHidden.value = kembalian;
            itemsInput.value = JSON.stringify(selectedMenus);

            orderForm.submit();
        }
    });
});
