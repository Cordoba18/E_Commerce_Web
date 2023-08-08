const editButtons = document.querySelectorAll('.editButton');
const cancelButtons = document.querySelectorAll('.cancelButton');

editButtons.forEach((editButton, index) => {
    editButton.addEventListener('click', () => {
        const targetProfile = editButton.closest('.target-profile');
        const readView = targetProfile.querySelector('.readView');
        const editView = targetProfile.querySelector('.editView');

        readView.style.display = 'none';
        editView.style.display = 'block';
        editButton.style.display = 'none'; 
    });
});

cancelButtons.forEach((cancelButton, index) => {
    cancelButton.addEventListener('click', () => {
        const targetProfile = cancelButton.closest('.target-profile');
        const readView = targetProfile.querySelector('.readView');
        const editView = targetProfile.querySelector('.editView');
        const editButton = targetProfile.querySelector('.editButton');

        readView.style.display = 'block';
        editView.style.display = 'none';
        editButton.style.display = 'block';
    });
});