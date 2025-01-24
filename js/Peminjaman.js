const loans = [];

        document.getElementById('loan-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const loanBookTitle = document.getElementById('loan-book-title').value;
            const loanMemberName = document.getElementById('loan-member-name').value;
            const loanDate = document.getElementById('loan-date').value;
            const returnDate = document.getElementById('return-date').value;

            const loan = { loanBookTitle, loanMemberName, loanDate, returnDate, status: 'Dikembalikan' };
            loans.push(loan);
            updateLoanList();
            this.reset();
        });

        function updateLoanList() {
            const loanList = document.getElementById('loan-list');
            loanList.innerHTML = '';
            loans.forEach((loan) => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.textContent = `${loan.loanBookTitle} dipinjam oleh ${loan.loanMemberName} pada ${loan.loanDate}, harus kembali pada ${loan.returnDate}`;
                loanList.appendChild(listItem);
            });
        }