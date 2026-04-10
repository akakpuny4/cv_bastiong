<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-black">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-xl font-bold mb-4 text-center border-b-4 border-gray-800 pb-2">AKTIVA</h2>
            
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">AKTIVA LANCAR :</h3>
                <div class="flex justify-between py-1 border-b border-gray-100">
                    <span>KAS</span> 
                    <span>Rp {{ number_format($kas, 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-100">
                    <span>UANG DI BANK</span> 
                    <span>Rp {{ number_format($bank, 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span>JUMLAH PIUTANG</span> 
                    <span>Rp {{ number_format($piutang, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">PERSEDIAAN BARANG :</h3>
                <div class="flex justify-between py-1">
                    <span>Total Nilai Persediaan</span> 
                    <span>Rp {{ number_format($persediaan, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="border-t-4 border-gray-800 pt-4 font-bold flex justify-between text-xl mt-8">
                <span>JUMLAH AKTIVA</span>
                <span>Rp {{ number_format($total_aktiva, 2, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-xl font-bold mb-4 text-center border-b-4 border-gray-800 pb-2">PASIVA</h2>
            
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">IV. HUTANG :</h3>
                <div class="flex justify-between py-1 border-b border-gray-100 text-gray-500 italic">
                    <span>Hutang Bank / Lain-lain</span> 
                    <span>Rp 0,00</span>
                </div>
                <p class="text-xs text-gray-400 mt-1">*Catatan: Modul Hutang belum diaktifkan.</p>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">VI. KEKAYAAN BERSIH :</h3>
                <div class="flex justify-between py-1">
                    <span>Modal / Laba</span> 
                    <span>Rp {{ number_format($total_pasiva, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="border-t-4 border-gray-800 pt-4 font-bold flex justify-between text-xl mt-[105px]">
                <span>JUMLAH PASIVA</span>
                <span>Rp {{ number_format($total_pasiva, 2, ',', '.') }}</span>
            </div>
        </div>

    </div>
</x-filament-panels::page>