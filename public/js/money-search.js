window.onload = function(){
    /*各画面オブジェクト*/
    const serachSubmit = document.getElementById('serachSubmit');
    const moneySerach = document.getElementById('moneySerach');
    const warningMessage = document.getElementById('warning-message');
    const reg = /^[0-9]+$/;
    
    
    moneySerach.addEventListener('blur', function() {
        moneyValue = this.value;

        if(!reg.test(moneyValue)){
            serachSubmit.disabled = true;
            warningMessage.innerText = '半角数字で入力してください';
        } else {
            serachSubmit.disabled = false;
            warningMessage.innerText = ''; 
        }
    });
};
