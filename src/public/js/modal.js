const openButtons = document.querySelectorAll('.open-button');
const modal = document.querySelector('.dialog');
const buttonClose = document.querySelector('.modal__close-btn');

const fields = [
    'id',
    'name',
    'gender',
    'email',
    'category',
    'detail',
];

const modalFields = Object.fromEntries(
    fields.map(key => [key, document.getElementById(`modal-${key}`)]));

openButtons.forEach(openButton => {
    openButton.addEventListener('click', (e) => {
        e.preventDefault();
        const row = openButton.closest('tr');

        fields.forEach(key => {
            const cell = row.querySelector(`#contact-${key}`); modalFields[key][cell?.value !== undefined ? 'value' : 'textContent'] = cell?.value ?? cell?.textContent;
        });
        console.log(document.querySelector('#contact-detail'))
        modal.showModal();
    });
});

buttonClose.addEventListener('click', () => {
    modal.close();
});

let data = {
    apple: 150,
    orenge:100,
    banana:120
};

console.log(data);

for (let key in data) {
    console.log(`${key} = ${data[key]}`);
    console.log(key);
}