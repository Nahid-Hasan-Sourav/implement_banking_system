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

const showWithdrawDataOnTable = (data) => {
    const tbody = $("#withdrawTableBody");

    tbody.empty();

    data.forEach((item, index) => {
        const row = `<tr>
                        <th scope="row">${index + 1}</th>
                        <td>${item.amount}</td>
                        <td>${item.fee}</td>
                        <td>
                        ${item.date}
                        </td>

                    </tr>`;

        tbody.append(row);
    });
};

const getAllWithDraw = ()=>{
    $.ajax({
        url: "/all-withdraw",
        type: "GET",
        success: function (res) {
            // console.log("GET ALL CATEGORY ",res);
            if (res.status === "success") {
                let data = res?.allWithdraw;
                console.log("GET ALL CATEGORY ",data);

                $("#withdrawTotalAmount").text(res.totalWithdrawBalance);

                showWithdrawDataOnTable(data);
            }
        },
    });
}
getAllWithDraw();

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

$("#withDrawMoneyBtn").click(function(){

    let withdrawMoney = $("#withdrawMoneyInput").val();
    // let transactionType = "Deposit";
    // console.log("VALUE OF depositMoneyInput",depositMoney);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
   const data={
    withdrawMoney,
   }
    $.ajax({
        url: "/withdraw/store",
        type: "POST",
        data: data,
        success: function (response) {
            console.log("submit form data == : ", response);

            if (response.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'WITHDRAW',
                    text: 'The WITHDRAW successfull.',
                    timer: 5000,
                    showConfirmButton: true
                });
                $("#withdrawModal").modal('hide');

                getAllWithDraw();

            }
            if(response.status === "failed"){
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Withdraw Amount Is Greater Than Current Amount!",
                    
                  });


            }
        },
        error: function (xhr, status, error) {
            console.log("Error: ", error);
            var response = JSON.parse(xhr.responseText);
            console.log("Error Message: ", response.message);
        },
    });

})