require('./bootstrap');

// Delete confirmation

window.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body');

    if (document.querySelector('.cancel--confirm--button')) {
        document.querySelector('.cancel--confirm--button')
            .addEventListener('click', () => {
                body.style.overflow = 'auto';
                const modal = document.querySelector('#confirm-modal');
                modal.style.display = 'none';
            })
    }

    document.querySelectorAll('.delete--button').forEach(b => {
        b.addEventListener('click', () => {
            console.log('click');
            const modal = document.querySelector('#confirm-modal');
            modal.style.display = 'flex';
            modal.style.top = window.scrollY + 'px';
            body.style.overflow = 'hidden';
            const form = modal.querySelector('form');
            form.setAttribute('action', b.dataset.action);
        })
    });

});

// Manage photos


const photoInput = `

    <button type="button" class="btn btn-danger mt-2">-</button>
    <input type="file" class="form-control" name="book_photo[]">

`;

window.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.add--photo')) {
    const addPhotoButton = document.querySelector('.add--photo');
    const inputPlaceholder = document.querySelector('.book--photos');
    addPhotoButton.addEventListener('click', () => {
    const span = document.createElement('span');
    span.innerHTML = photoInput;
    inputPlaceholder.appendChild(span);
    span.querySelector('button').addEventListener('click', () => {
        span.remove();
    })
    })
}

});

const outfitInput = `

    <button type="button" class="btn btn-danger mt-2">-</button>
    <input type="file" class="form-control" name="outfit_photo[]">

`;

window.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.add--photo')) {
    const addPhotoButton = document.querySelector('.add--photo');
    const inputPlaceholder = document.querySelector('.outfit--photos');
    addPhotoButton.addEventListener('click', () => {
    const span = document.createElement('span');
    span.innerHTML = outfitInput;
    inputPlaceholder.appendChild(span);
    span.querySelector('button').addEventListener('click', () => {
        span.remove();
    })
    })
}

});