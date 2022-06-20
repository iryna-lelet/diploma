require('./bootstrap');

const $inputpassword=document.getElementById('password');
const $showHiddenPasswordBtn=document.getElementById('eyeBtn');
const $hidePasswordBtn=document.getElementById('eyeIcon');
const $addIncommingRecord=document.getElementById('addIncomingBtn');
const $addOutgoingRecord=document.getElementById('addOutgoingBtn');
const $incommingPopup=document.getElementById('addIncomingRecord');
const $outgoingPopup=document.getElementById('addOutgoingRecord');
const $closePopupBtn=document.querySelectorAll('.popupCloseBtn');
const $popup=document.querySelectorAll('.popup');
const $addNewCategory=document.getElementById('addCategoryBtn');
const $categoryPopup=document.getElementById('addCategoryPopup');
const $addNewPayment=document.getElementById('addPaymentBtn');
const $paymentPopup=document.getElementById('addPaymentPopup');
const $addNewCurrency=document.getElementById('addCurrencyBtn');
const $currencyPopup=document.getElementById('addCurrencyPopup');
const $currencySelector=document.querySelector('.currencySelectBtn');
const $currencyDropdown=document.querySelector('.currencyDropdown');
const $currencyOption=document.querySelectorAll('.currencyOption');
const $currentCurrencyValue=document.querySelector('.currentCurrencyValue');
const $removeBtns = document.querySelectorAll('.remove-btn');
const $datePicker = document.getElementById('date-picker');
const $tr=document.querySelectorAll('tr');


if($datePicker) {
    const dateObj = new Date();
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const day = String(dateObj.getDate()).padStart(2, '0');
    const year = dateObj.getFullYear();
    const output = year  + '-' + month  + '-' + day;
    console.log('sdsdfdf')
    $datePicker.setAttribute('max', output);
}


$showHiddenPasswordBtn && $showHiddenPasswordBtn.addEventListener('click', (e)=> {
    e.preventDefault();
    let type;
    if ($inputpassword.getAttribute('type') === 'password'){
        type='text';
        $hidePasswordBtn.classList.add("fa-eye-slash");
        $hidePasswordBtn.classList.remove("fa-eye");
    } else{
        type='password';
        $hidePasswordBtn.classList.add("fa-eye");
        $hidePasswordBtn.classList.remove("fa-eye-slash");
    }
    $inputpassword.setAttribute('type', type);
})

$addIncommingRecord && $addIncommingRecord.addEventListener('click', (e)=> {
    e.preventDefault();
    $incommingPopup.style.display='flex';
    document.body.classList.add('hidden');
})

$addOutgoingRecord && $addOutgoingRecord.addEventListener('click', (e)=> {
    e.preventDefault();
    $outgoingPopup.style.display='flex';
    document.body.classList.add('hidden');
})

$addNewCategory && $addNewCategory.addEventListener('click', (e)=> {
    e.preventDefault();
    $categoryPopup.style.display='flex';
    document.body.classList.add('hidden');
})

$addNewPayment && $addNewPayment.addEventListener('click', (e)=> {
    e.preventDefault();
    $paymentPopup.style.display='flex';
    document.body.classList.add('hidden');
})

$addNewCurrency && $addNewCurrency.addEventListener('click', (e)=> {
    e.preventDefault();
    $currencyPopup.style.display='flex';
    document.body.classList.add('hidden');
})

$closePopupBtn.forEach(el =>{
    el.addEventListener('click', (e)=> {
        $popup.forEach(el =>{
            el.style.display='none';
        })
        document.body.classList.remove('hidden');
    })
})

$currencySelector && $currencySelector.addEventListener('click', (e)=>{
    console.log('deeemooon');
    if ($currencyDropdown.classList.contains('active')) {
        $currencyDropdown.classList.remove('active');
    } else {
        $currencyDropdown.classList.add('active');
    }
})

$currencyOption && $currencyOption.forEach(el => {
    el.addEventListener('click', (e)=>{
        $currentCurrencyValue.innerText = e.target.innerText;
    })
})

$removeBtns && $removeBtns.forEach(el => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        const id = e.target.getAttribute('data-ref');
        const $checkboxes = document.querySelectorAll("[data-table=" + id + "]");
        const $input = document.getElementById(`destroy-${id}`);
        const checkedCheckboxes = [];

        if($checkboxes.length) {
            $checkboxes.forEach(el => {
                if(el.checked) {
                    checkedCheckboxes.push(el.getAttribute('data-id'));
                }
            })
            $input.setAttribute(`value`, checkedCheckboxes.join(','));

            if(checkedCheckboxes.length) {
                document.getElementById(`form-${id}`).submit();
            }
        }

        console.log(checkedCheckboxes);
    })
})

$tr && $tr.forEach(el => {
    el.addEventListener('click', (e)=>{
        e.currentTarget.querySelector('input').checked=true;
    })
})

// document.body.addEventListener('click', (e) => {
//     if(e.target !== document.querySelector('.currenctCurrency')
//         && $currencyDropdown.classList.contains('active')) {
//         console.log('ssfdf')
//         $currencyDropdown.classList.remove('active');
//     }
// })

