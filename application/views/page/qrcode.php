<section id="qrcode" class="container-grid padding-large position-relative overflow-hidden">
    <div class="container">
        <h2 class="display-7 text-dark text-uppercase"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            นำส่งออกสินค้า</h2>
        <div class="row">
            <div
                class="qrcode-content bg-dark d-flex flex-wrap justify-content-center align-items-center padding-medium">
                <div class="col-md-6 col-sm-12">
                    <div class="display-header pe-3">
                        <h2 class="display-7 text-uppercase text-light">พิมพ์รหัสบาร์โค้ด</h2>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">

                    <div class="input-group flex-wrap">
                        <input id="barcode" class="form-control btn-rounded-none" type="text" autofocus
                            placeholder="ยิงรหัสบาร์โค้ด">
                        <button id="submitScanBarcode"
                            class="btn btn-medium btn-primary text-uppercase btn-rounded-none"
                            type="submit">ค้นหา</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 fs-5">
                <form id="formSubmitRemoveItemProduct" action="javascript:void(0)" method="post">
                    <table id="tbProductsSell" style="width:100%" class=" text-center ">
                        <thead>
                            <tr>
                                <!-- <th class=" text-center ">#</th> -->
                                <th class=" text-center ">รหัสบาร์โค้ด</th>
                                <th class=" text-center ">ชื่อสินค้า</th>
                                <th class=" text-center ">จำนวน</th>
                                <th class=" text-center ">ราคาขาย</th>
                                <th class=" text-center ">จัดการ</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <div class="row mt-5 ">
                        <div class="col-sm-12 d-flex justify-content-end ">
                            <button type="submit" class="btn btn-lg btn-success">ส่งออกสินค้า</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">


            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalDeletItemProduct" data-bs-backdrop="static" tabindex="0"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm fs-4 ">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    var barcode = "";
    const table = new DataTable('#tbProductsSell', {
        'dom': 'lrt',
        "lengthMenu": [
            [-1], ["All"]
        ],
        "language": {
            "sProcessing": " กำลังดำเนินการ... ",
            "sLengthMenu": " แสดง _MENU_ แถว",
            "sZeroRecords": " ไม่พบข้อมูล ",
            "sInfo": " แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว ",
            "sInfoEmpty": " แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "( กรองข้อมูล _MAX_ ทุกแถว )",
            "sInfoPostFix": "",
            "sSearch": " ค้นหา :",
            "sUrl": "",
            "oPaginate": {
                "sFirst": " เริ่มต้น ",
                "sPrevious": " ก่อนหน้า ",
                "sNext": " ถัดไป ",
                "sLast": " สุดท้าย "
            }
        }
    });

    document.getElementById("formSubmitRemoveItemProduct").addEventListener("submit", async function (e) {
        // console.log("sdf")
        e.preventDefault();
        const formData = new FormData(e.target);
        const PostFetch = fetch("<?= base_url('warehouse/formSubmitRemoveItemProduct'); ?>", {
            method: "POST",
            body: formData
        });

        let response = await PostFetch.then((response) => response.json());
        if (response.statusCode) {
            sessionStorage.setItem("ItemOut", JSON.stringify([]));
            tbProductsSell();
        } else {
            let text = 'รายการสินค้าหมด';
            response.error.forEach(item => {
                text += " ( " + item.PD_NAME + ` คงเหลือ : ${item.PD_ITEM}  ) `;
            });
            alert(text);
        }

        tbProductsSell();
    });

    async function tbProductsSell() {
        table
            .clear()
            .draw();
        let response = await JSON.parse(sessionStorage.getItem("ItemOut"));
        response.forEach((item, key) => {
            table.row
                .add([
                    // key + 1,
                    item.PD_BARCODE,
                    item.PD_NAME,
                    item.TS_ITEM,
                    item.PD_SELL,
                    `<input type='hidden' name='PD[]' value='${item.PD_BARCODE},${item.TS_ITEM}' /><button type="button" class="btn btn-sm btn-outline-danger" onclick="updateProductsSell(${key})">ลบ</button>`,
                ])
                .draw(false);
        });
    }

    async function updateProductsSell(index) {

        let response = await JSON.parse(sessionStorage.getItem("ItemOut"));
        response.splice(index, 1);
        sessionStorage.setItem("ItemOut", JSON.stringify(response));
        tbProductsSell();

    }

    async function getBarcode(barcode) {

        let body = {
            barcode: barcode
        }
        const PostFetch = fetch("<?= base_url('warehouse/getBarcode'); ?>", {
            method: "POST",
            body: JSON.stringify(body)
        });

        let response = await PostFetch.then((response) => response.json());
        if (response.statusCode) {
            let resulte = response.data;

            resulte.TS_ITEM = 1;

            if (!sessionStorage.getItem("ItemOut")) {
                // ถ้า ItemOut ยังไม่ถูกสร้าง ให้ทำการสร้างขึ้นมาใหม่
                sessionStorage.setItem("ItemOut", JSON.stringify([]));
            }

            let ItemOutcome = [];
            ItemOutcome = JSON.parse(sessionStorage.getItem("ItemOut"));

            let checkItem = false;
            ItemOutcome.forEach((item, key) => {
                // เช็คข้อมูลก่อนหน้าว่ามีสินค้าชินนี้หรือไม่
                if (resulte.PD_BARCODE === item.PD_BARCODE) {
                    checkItem = key;
                }
            });

            if (checkItem !== false) {
                let TS_ITEM = parseInt(ItemOutcome[checkItem].TS_ITEM) + parseInt(resulte.TS_ITEM);
                // บวกจำนวนสินค้า เข้าไปในรายการก่อนหน้า
                ItemOutcome[checkItem].TS_ITEM = TS_ITEM;
                sessionStorage.setItem("ItemOut", JSON.stringify(ItemOutcome));
            } else {
                ItemOutcome.push(resulte);
                sessionStorage.setItem("ItemOut", JSON.stringify(ItemOutcome));
            }

            document.getElementById("barcode").value = '';

            tbProductsSell();
        }

    }

    document.getElementById("submitScanBarcode").addEventListener("click", function () {
        // คลิกปุ่มค้นหา
        barcode = document.getElementById("barcode").value;
        if (barcode) {
            getBarcode(barcode);
        }
    });


    $(document).ready(function () {

        if (!sessionStorage.getItem("ItemOut")) {
            // ถ้า ItemOut ยังไม่ถูกสร้าง ให้ทำการสร้างขึ้นมาใหม่
            sessionStorage.setItem("ItemOut", JSON.stringify([]));
        }

        tbProductsSell();

        $(document).keydown(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13 || code == 9)// Enter key hit
            {
                // กด Enter 
                barcode = document.getElementById("barcode").value;
                getBarcode(barcode);
            }
        });

    })
</script>