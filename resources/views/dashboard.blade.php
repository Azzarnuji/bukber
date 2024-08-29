@extends('layout')
@section('content')
    <div class="container w-full h-full p-10 mx-auto my-10 lg:p-5">
        <div class="flex flex-col items-start justify-center w-full h-full gap-10 lg:flex-row">
            @if (!request()->get('type') == 'view')
                <div class="contentLeft lg:w-full">
                    <h1 class="mb-2 text-2xl font-bold">Tambah Data Pembayaran</h1>

                    <form id="formPembayaran">
                        <label class="w-full max-w-xs form-control lg:max-w-lg">
                            <div class="label">
                                <span class="text-lg label-text">Nama Pembayar</span>
                            </div>
                            <input type="text" placeholder="Type here" class="w-full max-w-xl input input-bordered"
                                id="namaPembayar" required />
                        </label>
                        <label class="w-full max-w-xs form-control lg:max-w-lg">
                            <div class="label">
                                <span class="text-lg label-text">Jumlah Bayar</span>
                            </div>
                            <input type="text" placeholder="Type here" class="w-full max-w-xl input input-bordered"
                                id="jumlahBayar" required />
                        </label>
                        <label class="w-full max-w-xs form-control lg:max-w-lg">
                            <div class="label">
                                <span class="text-lg label-text">Metode Bayar</span>
                            </div>
                            <select class="select select-bordered" id="metodeBayar" required>
                                <option disabled selected value="">Pilih Salah Satu</option>
                                <option value="transfer">Transfer</option>
                                <option value="cash">Cash (COD)</option>
                            </select>
                        </label>
                        <label class="w-full max-w-xs form-control lg:max-w-lg" id="buktiBayarField">
                            <div class="label">
                                <span class="text-lg label-text">Bukti Bayar</span>
                            </div>
                            <input type="file" class="w-full max-w-xs file-input file-input-bordered lg:max-w-lg"
                                id="buktiBayar" />

                        </label>
                        <div class="flex justify-end my-10 lg:justify-start">

                            <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan Data</button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="contentRight lg:w-[100vw] w-full">
                <h1 class="mb-2 text-2xl font-bold">Daftar List Sudah Pembayaran</h1>
                <h2 class="mb-2 text-2xl">Total Uang Terkumpul: Rp.<span id="totalCash"></span></h2>

                <div class="overflow-x-auto">
                    <table class="table table-lg" id="tablePembayaran">
                        <!-- head -->
                        <thead class="text-base text-white bg-success">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Bayar</th>
                                <th>Metode Pembayaran</th>
                                <th>Data Dibuat</th>
                                <th>Bukti</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <dialog id="imageModal" class="modal">
        <div class="absolute w-screen h-screen bg-black opacity-45"></div>
        <div class="modal-box w-96">
            <div class="mb-2 modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn close">X</button>
                </form>
            </div>
            <img class="modal-content" id="imgFullscreen">

        </div>
    </dialog>
@endsection
