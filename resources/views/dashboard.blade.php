@extends('layout')
@section('content')
    <div class="container mx-auto h-full w-full my-10 lg:p-5 p-10">
        <div class="flex lg:flex-row flex-col justify-center items-start w-full h-full gap-10">
            <div class="contentLeft lg:w-full">
                <h1 class="text-2xl font-bold mb-2">Tambah Data Pembayaran</h1>

                <form id="formPembayaran">
                    <label class="form-control w-full lg:max-w-lg max-w-xs">
                        <div class="label">
                            <span class="label-text text-lg">Nama Pembayar</span>
                        </div>
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl"
                            id="namaPembayar" required />
                    </label>
                    <label class="form-control w-full lg:max-w-lg max-w-xs">
                        <div class="label">
                            <span class="label-text text-lg">Jumlah Bayar</span>
                        </div>
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xl"
                            id="jumlahBayar" required />
                    </label>
                    <label class="form-control w-full lg:max-w-lg max-w-xs">
                        <div class="label">
                            <span class="label-text text-lg">Metode Bayar</span>
                        </div>
                        <select class="select select-bordered" id="metodeBayar" required>
                            <option disabled selected value="">Pilih Salah Satu</option>
                            <option value="transfer">Transfer</option>
                            <option value="cash">Cash (COD)</option>
                        </select>
                    </label>
                    <label class="form-control w-full lg:max-w-lg max-w-xs" id="buktiBayarField">
                        <div class="label">
                            <span class="label-text text-lg">Bukti Bayar</span>
                        </div>
                        <input type="file" class="file-input file-input-bordered w-full lg:max-w-lg max-w-xs"
                            id="buktiBayar" />

                    </label>
                    <div class="flex lg:justify-start justify-end my-10">

                        <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan Data</button>
                    </div>
                </form>
            </div>
            <div class="contentRight lg:w-[100vw] w-full">
                <h1 class="text-2xl font-bold mb-2">Daftar List Sudah Pembayaran</h1>

                <div class="overflow-x-auto">
                    <table class="table table-lg" id="tablePembayaran">
                        <!-- head -->
                        <thead class="bg-success text-white text-base">
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
        <div class="w-screen h-screen bg-black opacity-45 absolute"></div>
        <div class="modal-box w-96">
            <div class="modal-action mb-2">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn close">X</button>
                </form>
            </div>
            <img class="modal-content" id="imgFullscreen">

        </div>
    </dialog>
@endsection
