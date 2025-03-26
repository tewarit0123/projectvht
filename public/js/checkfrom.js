function calculateAge() {
    const birthDate = document.getElementById('birth_date').value;
    const ageField = document.getElementById('age');

    if (!birthDate) {
        ageField.value = '';
        return;
    }

    const today = new Date();
    const birth = new Date(birthDate);

    // คำนวณอายุ
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
    }

    if (age >= 18) {
        ageField.value = age;
    } else {
        ageField.value = '';
        alert('ต้องมีอายุ 18 ปีขึ้นไป');
        document.getElementById('birth_date').value = '';
    }
}

function setGender() {
    const titlename = document.getElementById('titlename').value;
    const gender = document.getElementById('gender');

    if (titlename === 'นาย') {
        gender.value = 'ชาย';
    } else if (titlename === 'นาง' || titlename === 'นางสาว') {
        gender.value = 'หญิง';
    }
}

function idCardCheck(id_card) {
    if(!Number(id_card)) return false
    if(id_card.substring(0, 1) === '0') return false
    if(id_card.length !== 13) return false

    let sum = 0
    for(let i = 0; i < 12; i++) sum += parseFloat(id_card.charAt(i)) * (13 - i)

    return (11 - sum % 11) % 10 === parseFloat(id_card.charAt(12))
}

function validateForm() {
    const id_card = document.getElementById('id_card').value;
    const errorDiv = document.getElementById('id_card_error');
    
    if (!idCardCheck(id_card)) {
        errorDiv.innerHTML = 'เลขบัตรประชาชนไม่ถูกต้อง';
        alert('กรุณตรวจสอบเลขบัตรประชาชนของคุณ'); // Show content when return false
        return false;
    }
    errorDiv.innerHTML = '';
    return true;
}