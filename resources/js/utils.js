export const getValueField = (id) => {
    const element = $(`#${id}`)
    // console.log(element.attr('type'));
    if (element.attr('type') === 'file' && element.attr('type') !== undefined) {
        return element
    } else {
        return element.val()
    }
}

export const setValueField = (id, value) => {
    $(`#${id}`).val(value)
}
export const action = (id, eventListerner, callback) => {
    $(`#${id}`).on(eventListerner, (event) => callback(event))
}

export const postData = async (url, method, config) => {
    return await $.ajax({
        url: url,
        method: method,
        ...config
    })
}

export const askBeforeExecution = (message, callback) => {
    Swal.fire({
        icon: 'info',
        text: message,
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            callback()
        }
    })
}
