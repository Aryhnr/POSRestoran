import './bootstrap';

const btnToggle = document.getElementById('btn-toggle-sidebar');
const sidebar = document.getElementById('sidebar-left');
const overlay = document.getElementById('sidebar-overlay');

btnToggle.addEventListener('click', () => {
    sidebar.classList.toggle('translate-x-0');
    sidebar.classList.toggle('-translate-x-full');

    overlay.classList.toggle('hidden');
});

overlay.addEventListener('click', () => {
    // Klik overlay -> tutup sidebar
    sidebar.classList.add('-translate-x-full');
    sidebar.classList.remove('translate-x-0');
    overlay.classList.add('hidden');
});

const menuCards = document.querySelectorAll('.menu-card');
const selectedMenuList = document.getElementById('selected-menu-list');
const totalHargaInput = document.getElementById('total-harga');

// Simpan menu yang dipilih
let selectedMenus = [];

// Klik card menu
menuCards.forEach(card => {
    card.addEventListener('click', () => {
        const menuName = card.dataset.menu;
        const menuHarga = parseInt(card.dataset.harga);

        // cek apakah menu sudah dipilih
        if(!selectedMenus.find(m => m.nama === menuName)){
            selectedMenus.push({nama: menuName, harga: menuHarga, jumlah: 1});
        }

        renderSidebar();
    });
});

// Render sidebar
function renderSidebar(){
    selectedMenuList.innerHTML = '';
    let total = 0;

    selectedMenus.forEach((menu, index) => {
        total += menu.harga * menu.jumlah;

        const div = document.createElement('div');
        div.className = 'flex justify-between items-center border-b pb-1';
        div.innerHTML = `
            <span>${menu.nama}</span>
            <div class="flex items-center gap-2">
                <input type="number" min="1" value="${menu.jumlah}" class="w-16 border rounded px-2 py-1 jumlah-input" data-index="${index}">
                <span>Rp ${menu.harga}</span>
                <button type="button" class="text-red-600 font-bold remove-menu" data-index="${index}">&times;</button>
            </div>
        `;
        selectedMenuList.appendChild(div);
    });

    totalHargaInput.value = total;

    // Tambah event listener untuk jumlah input
    const jumlahInputs = document.querySelectorAll('.jumlah-input');
    jumlahInputs.forEach(input => {
        input.addEventListener('change', (e)=>{
            const idx = e.target.dataset.index;
            selectedMenus[idx].jumlah = parseInt(e.target.value) || 1;
            renderSidebar();
        });
    });

    // Event listener remove menu
    const removeButtons = document.querySelectorAll('.remove-menu');
    removeButtons.forEach(btn => {
        btn.addEventListener('click', (e)=>{
            const idx = btn.dataset.index;
            selectedMenus.splice(idx,1);
            renderSidebar();
        });
    });

}

window.openModal = function(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

window.closeModal = function(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
