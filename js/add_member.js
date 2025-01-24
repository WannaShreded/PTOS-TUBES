const members = [];

document.getElementById('member-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const memberName = document.getElementsByName('member-name')[0].value;
    const address = document.getElementsByName('member-address')[0].value;
    const birthdate = document.getElementsByName('member-birthdate')[0].value;
    const phone = document.getElementsByName('member-phone')[0].value;
    const email = document.getElementsByName('member-email')[0].value;
    const job = document.getElementsByName('member-job')[0].value;
    const gender = document.getElementsByName('member-gender')[0].value;
    const password = document.getElementsByName('member-password')[0].value;
    const username = document.getElementsByName('member-usn')[0].value;

    // Validate input
    if (!memberName || !username || !address || !birthdate || !phone || !email || !job || !gender || !password) {
        alert("Semua field harus diisi!");
        return;
    }

    const memberExists = members.some(member => member.phone === phone || member.email === email);
    if (memberExists) {
        alert("No Telepon atau Email sudah terdaftar.");
        return;
    }

    const member = { memberName, username, address, birthdate, phone, email, job, gender, password};
    members.push(member);
    updateMemberList();
    this.reset();
});

function updateMemberList() {
    const memberList = document.getElementById('member-list');
    memberList.innerHTML = '';
    members.forEach((member, index) => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.textContent = `${member.memberName} - ${member.job}`;
        
        listItem.appendChild(createButton('Tampilkan', 'btn-info', () => showMemberDetails(member)));
        listItem.appendChild(createButton('Update', 'btn-warning', () => updateMember(index)));
        listItem.appendChild(createButton('Hapus', 'btn-danger', () => deleteMember(index)));
        
        memberList.appendChild(listItem);
    });
}

function createButton(text, className, onClick) {
    const button = document.createElement('button');
    button.className = `btn btn-sm ml-2 ${className}`;
    button.textContent = text;
    button.onclick = onClick;
    return button;
}

function showMemberDetails(member) {
    alert(`Keterangan Anggota:\nNama: ${member.memberName}\nAlamat: ${member.address}\nTanggal Lahir: ${member.birthdate}\nNo Telepon: ${member.phone}\nEmail: ${member.email}\nPekerjaan: ${member.job}\nJenis Kelamin: ${member.gender}`);
}

function updateMember(index) {
    const newName = prompt("Masukkan nama baru untuk anggota:", members[index].memberName);
    if (newName === null) return; // User canceled

    const newUsername = prompt("Masukkan alamat baru untuk anggota:", members[index].username);
    if (newUsername === null) return;

    const newAddress = prompt("Masukkan alamat baru untuk anggota:", members[index].address);
    if (newAddress === null) return;

    const newBirthdate = prompt("Masukkan tanggal lahir baru untuk anggota:", members[index].birthdate);
    if (newBirthdate === null) return;

    const newPhone = prompt("Masukkan no telepon baru untuk anggota:", members[index].phone);
    if (newPhone === null) return;

    const newEmail = prompt("Masukkan email baru untuk anggota:", members[index].email);
    if (newEmail === null) return;

    const newPassword = prompt("Masukkan password baru untuk anggota:", members[index].password);
    if (newPassowrd === null) return;

    const newJob = prompt("Masukkan pekerjaan baru untuk anggota:", members[index].job);
    if (newJob === null) return;

    const newGender = prompt("Masukkan jenis kelamin baru untuk anggota:", members[index].gender);
    if (newGender === null) return;

    members[index] = { memberName: newName, username: newUsername, address: newAddress, birthdate: newBirthdate, phone: newPhone, email: newEmail, job: newJob, gender: newGender};
    updateMemberList();
}

function deleteMember(index) {
    if (confirm("Apakah Anda yakin ingin menghapus anggota ini?")) {
        members.splice(index, 1);
        updateMemberList();
    }
}