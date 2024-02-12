const showDepositDataOnTable = (data) => {
    const tbody = $("#depositTableBody");

    tbody.empty();

    data.forEach((item, index) => {
        const row = `<tr>
                        <th scope="row">${index + 1}</th>
                        <td>${item.amount}</td>
                        <td>
                        ${item.date}
                        </td>

                    </tr>`;

        tbody.append(row);
    });
};

const getAllDeposit =()=>{
    $.ajax({
        url: "/all-deposit",
        type: "GET",
        success: function (res) {
            console.log("GET ALL CATEGORY ",res);
            if (res.status === "success") {
                let data = res.allDeposit;
                $("#totalAmount").text(res.allAmount);

                showDepositDataOnTable(data);
            }
        },
    });
}
getAllDeposit();

$("#depositOpenModalBtn").click(function(){
    $("#depositModal").modal('show');
    $("#depositMoneyInput").val('');
});

$("#addDepositMoneyBtn").click(function(){

    let depositMoney = $("#depositMoneyInput").val();
    let transactionType = "Deposit";
    // console.log("VALUE OF depositMoneyInput",depositMoney);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
   const data={
    depositMoney,
    transactionType
   }
    $.ajax({
        url: "/deposit/store",
        type: "POST",
        data: data,
        success: function (response) {
            console.log("submit form data == : ", response);

            if (response.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'DEPOSIT',
                    text: 'The Deposit successfully added.',
                    timer: 5000,
                    showConfirmButton: true
                });
                $("#depositModal").modal('hide');
                getAllDeposit();

            }
        },
        error: function (xhr, status, error) {
            console.log("Error: ", error);
            var response = JSON.parse(xhr.responseText);
            console.log("Error Message: ", response.message);
        },
    });

})




$("#withdrawOpenModalBtn").click(function(){
    $("#withdrawModal").modal('show');
    $("#withdrawMoneyInput").val('');
});
