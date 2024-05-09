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
