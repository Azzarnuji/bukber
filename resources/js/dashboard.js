import { action, askBeforeExecution, getValueField, ajax, setValueField } from "./utils";

const TablePembayaran = $('#tablePembayaran')
let TablePembayaranInstance;
const createDataTable = () => {
    TablePembayaranInstance = new DataTable(TablePembayaran, {
        ajax: "/api/pembayaran/getAllPembayaran",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nama_pembayar', name: 'Nama' },
            { data: 'jumlah_bayar', name: 'Jumlah Bayar' },
            {
                data: 'metode_pembayaran', name: "Metode Pembayaran", render: (data) => {
                    return `<p class="capitalize">${data}</p>`
                }
            },
            { data: 'created_at', name: "Data Dibuat", render: (data) => new Date(data).toLocaleDateString() + " " + new Date(data).toLocaleTimeString() },
            {
                data: "bukti_bayar_img", name: "Bukti Bayar", render: (data) => {
                    if (data == "Tidak Ada Bukti") {
                        return `<p>Tidak Ada Bukti</p>`
                    } else {

                        return `<img src="/assets/images/${data}" class="w-20 h-full cursor-pointer" lazy data-toggle="modal"/>`
                    }
                }
            },
            {
                data: "id", name: "Action", render: (data) => {
                    return `<button type="button" onclick="window.deletePembayaran(${data})" class="btn btn-error lg:btn-md btn-sm text-white">Hapus</button>`
                }
            }
        ]
    })
    return TablePembayaranInstance
}

const getTotalCash = async () => {
    const response = await ajax('/api/pembayaran/getTotalCash', 'GET')
    if (response.httpCode === 200) {
        return response.data.totalCash
    }
}

const updateTotalCash = async () => {
    $("#totalCash").text(await getTotalCash())
}
const deletePembayaran = async (id) => {
    askBeforeExecution('Apakah anda yakin ingin menghapus data ini?', () => {
        Swal.fire({
            title: 'Loading...',
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            didOpen: async () => {
                Swal.showLoading()
                const response = await ajax(`/api/pembayaran/hapusPembayaran/${id}`, 'DELETE')
                if (response.httpCode === 200) {
                    Swal.close()
                    Swal.fire({
                        icon: 'success',
                        text: response.message
                    })
                    TablePembayaranInstance.ajax.reload()
                    await updateTotalCash()
                }
            }
        })

    })
}
action('metodeBayar', 'change', (event) => {
    const metodeBayar = getValueField('metodeBayar')
    if (metodeBayar == "cash") {
        $('#buktiBayarField').addClass('hidden')
    } else {
        $('#buktiBayarField').removeClass('hidden')
    }
})

action('formPembayaran', 'submit', async (event) => {
    event.preventDefault()
    const namaPembayar = getValueField('namaPembayar')
    const metodeBayar = getValueField('metodeBayar')
    const jumlahBayar = getValueField('jumlahBayar')
    const buktiBayar = getValueField('buktiBayar').get(0).files[0]


    let formData = new FormData()
    formData.append('namaPembayar', namaPembayar)
    formData.append('metodeBayar', metodeBayar)
    formData.append('jumlahBayar', jumlahBayar)
    formData.append('buktiBayar', buktiBayar)

    Swal.fire({
        title: "Dalam Proses",
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        didOpen: async () => {
            Swal.showLoading()
            const response = await ajax('/api/pembayaran/tambahPembayaran', 'POST', {
                processData: false,
                cache: false,
                contentType: false,
                data: formData
            })
            if (response.httpCode === 201) {
                Swal.close()
                Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil',
                    text: response.message
                })

                TablePembayaranInstance.ajax.reload()
                await updateTotalCash()
                setValueField('namaPembayar', null)
                setValueField('metodeBayar', null)
                setValueField('jumlahBayar', null)
                setValueField('buktiBayar', null)
            }
        }
    })



    // console.log(namaPembayar, metodeBayar, jumlahBayar, buktiBayar);
})

$(document).on('click', 'img[data-toggle="modal"]', function () {
    console.log('IMGMODL');
    console.log($(this).attr('src'));
    $('#imgFullscreen').attr('src', $(this).attr('src'));
    // $('#imgFullscreen').addClass('w-full h-full');
    $('#imageModal').attr('open', true);
});

window.deletePembayaran = deletePembayaran
export {
    createDataTable,
    deletePembayaran,
    getTotalCash,
    updateTotalCash
}
