const editModal = document.getElementById('editModal')
if (editModal) {
    editModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const id = button.getAttribute('data-bs-id')
        const title = button.getAttribute('data-bs-title')
        const author = button.getAttribute('data-bs-author')

        // Update the modal's content.
        const modalForm = editModal.querySelector('.modal-form')
        const modalTitle = editModal.querySelector('.modal-title')
        const modalBodyInput = editModal.querySelector('.modal-body input')

        modalForm.action = modalForm.action.replace(":id", id)
        modalTitle.textContent = `Edit "${title}"`
        modalBodyInput.value = author
    })
}

const exportModal = document.getElementById('exportModal')
if (exportModal) {
    exportModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const export_type = button.getAttribute('data-bs-export')

        // Update the modal's content.
        const modalForm = exportModal.querySelector('.modal-form')
        const modalTitle = exportModal.querySelector('.modal-title')

        modalForm.action = modalForm.action.replace(":type", export_type)
        modalTitle.textContent = `Export to ${export_type.toUpperCase()}`
    })
}
