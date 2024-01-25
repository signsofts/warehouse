<section id="company-services" class="padding-large">
    <div class="container p-5">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                รายการสินค้า</h2>
            <div class="btn-right fs-4">
                <a class="nav-link me-4" href="javascript:void()" data-bs-toggle="modal"
                    data-bs-target="#modalAddProduct">
                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มสินค้า</a>
            </div>
        </div>
        <h3 class="mb-5"></h3>
        <div class="row bg-gray p-5 ">
            <div class="  col-lg-6 col-md-6 pb-3">
                <div class="icon-box d-flex justify-content-center ">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="cart-outline">
                            <use xlink:href="#cart-outline" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">รายการสินค้า</h3>
                        <h2><span id="sumProduct"></span> รายการ</h2>
                    </div>
                </div>
            </div>
            <div class="  col-lg-6 col-md-6 pb-3">
                <div class="icon-box d-flex justify-content-center">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="quality">
                            <use xlink:href="#quality" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">จำนวนชิ้น</h3>
                        <h2><span id="sumItemProduct"></span> ชิ้น</h2>
                    </div>
                </div>
            </div>

            <hr>
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase"></h2>
                <div class="btn-right fs-4">
                    <input id="searchProducts" type="text" class="form-control-lg fs-4"
                        placeholder="ค้นหาคำที่ต้องการค้นหา" autofocus value='' onkeyup="tbProducts(this.value); ">
                </div>
            </div>
            <div id="tbProducts" class="post-grid d-flex flex-wrap ">

            </div>

        </div>


    </div>

    <div class="modal fade" id="modalAddProduct" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl fs-4">
            <div class="modal-content">
                <form id="formSubmitAddProduct" action="javascript:void(0)" method="post" enctype="multipart/form-data">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มสินค้า</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="mb-3 text-center ">
                                    <img id="IMAG" src="<?= base_url("static/images/products/product-item.png") ?>"
                                        style=" width: 250px; height: 250px; " alt="">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">อัพโหลภาพสินค้า
                                                <span class="text-danger">( .jpeg .png )</span> </label>
                                            <input id="PD_IMAG" type="file" class="form-control" name="PD_IMAG"
                                                accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="PD_NAME" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">ราคาต้นทุนสินค้า</label>
                                    <input type="number" min="0" value="0" class="form-control" name="PD_COST" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">ราคาขาย</label>
                                    <input type="number" min="0" value="0" class="form-control" name="PD_SELL" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">จำนวนสินค้า</label>
                                    <input type="number" min="0" value="0" class="form-control" name="PD_ITEM" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">รายละเอียดเก็บสินค้า</label>
                                    <textarea name="PD_DETAILS" class="form-control" cols="30" rows="2"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProduct" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl fs-4">
            <div class="modal-content">

            </div>
        </div>
    </div>
</section>

<script>

    function getThaiDate(dateString) {
        const date = new Date(Date.parse(dateString))
        const result = date.toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        })

        return result;
    }
    async function tbProducts(keyup = '') {
        let data = {
            key: keyup,
        };

        document.getElementById("tbProducts").innerHTML = '<h3>กำลังค้นหา............</h3>';
        let html = '';
        const PostFetch = fetch("<?= base_url('warehouse/getAllProduct'); ?>", {
            method: "POST",
            body: JSON.stringify(data),
        });


        let response = await PostFetch.then((response) => response.json());

        if (response.length == 0) {
            document.getElementById("tbProducts").innerHTML = '<h3>ไม่พบรายการสินค้า</h3>';
            return false;
        }
        let sumProduct = response.length;
        let sumItemProduct = 0;

        response.forEach((item, key) => {
            sumItemProduct += parseInt( item.PD_ITEM);
            html += `
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3 p-3 ">
                    <a href="javascript:getProduct('${item.PD_ID}')">
                        <div class="card ">
                            <div class="card-image">
                                <img  style="width: 100%; height: 180px;"  src="<?= base_url("static/images/products/") ?>${item.PD_IMAG}" alt="" class="img-fluid"  >
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="card-meta text-muted m-0  d-flex justify-content-between">
                                <p class="meta-date text-dark fs-5 m-0">${item.PD_NAME}</p>
                                <p class="meta-date text-dark fs-5 m-0">${item.PD_BARCODE}</p>
                            </div>
                            <div class='card-title  d-flex justify-content-between pl-3 pr-3 ' >
                                <div>
                                    <p class='text-success m-0' >
                                        ทุน ${item.PD_COST} ฿
                                    </p>
                                    <p class='text-danger m-0'>
                                        ขาย ${item.PD_SELL} ฿
                                    </p>
                                </div>
                                <div>
                                    <p class='text-dark m-0' >
                                        คลัง ${item.PD_ITEM} 
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <p class='m-0' >Dt: ${item.PD_DETAILS}</p>
                        </div>
                    </a>
                </div>
            `;
        });

        document.getElementById("sumProduct").innerHTML = sumProduct;
        document.getElementById("sumItemProduct").innerHTML = sumItemProduct;

        document.getElementById("tbProducts").innerHTML = html;
    }

    async function getProduct(PD_ID) {
        let myModal = new bootstrap.Modal(document.getElementById('modalEditProduct'), {
            keyboard: true
        });
        myModal.show();

        let data = {
            PD_ID: PD_ID
        }
        const PostFetch = fetch("<?= base_url('warehouse/getOneProduct'); ?>", {
            method: "POST",
            body: JSON.stringify(data),
        });

        let response = await PostFetch.then((response) => response.json());
        const elements = document.querySelector("#modalEditProduct .modal-content");
        let html = '';

        html += `
            
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้สินค้า</h1>
                    <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">ข้อมูลสินค้า</a>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">นำเข้าสินค้า</button>
                            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ประวัตินำเข้า/ส่งออก</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form id="formSubmitEditProduct" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="PD_ID" value='${PD_ID}' required>
                                <div class="row">
                                    <svg class='w-100 ' id="barcode"></svg>
                                    <hr class=' mb-5' >
                                    <div class="col-sm-5 text-center" >
                                        <div class="mb-3 text-center ">
                                            <img id="IMAG" src="<?= base_url("static/images/products/") ?>${response.PD_IMAG}"
                                                style=" width: 250px; height: 250px; " alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">อัพโหลภาพสินค้า
                                                        <span class="text-danger">( .jpeg .png )</span> </label>
                                                    <input id="PD_IMAG" type="file" class="form-control" name="PD_IMAG"
                                                        accept="image/png, image/jpeg">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">ชื่อสินค้า</label>
                                                    <input type="text" class="form-control" name="PD_NAME" required value="${response.PD_NAME}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ราคาต้นทุนสินค้า</label>
                                            <input type="number" min="0" class="form-control" name="PD_COST" required  value="${response.PD_COST}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">ราคาขาย</label>
                                            <input type="number" min="0" class="form-control" name="PD_SELL" required  value="${response.PD_SELL}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">จำนวนสินค้า</label>
                                            <input type="number" min="0"  class="form-control" name="PD_ITEM" required value="${response.PD_ITEM}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">รายละเอียดเก็บสินค้า</label>
                                            <textarea name="PD_DETAILS" class="form-control" cols="30" rows="2"
                                                required>${response.PD_DETAILS}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <a id='btnEdit' class="btn btn-outline-primary" >แก้ไข</a>
                                        <button id='submit' type="submit" class="btn btn-primary">บันทึก</button>
                                        <button id='delete' type="button" class="btn btn-danger">ลบ</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="row mt-5">
                                <div class="col-12 fs-5">
                                    <form id="formSubmitAddItemProduct" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="PD_ID" value='${PD_ID}' required>
                                        <div class='row' >
                                            <div class="col-sm-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">จำนวนสินค้า</label>
                                                    <input type="number" min="0"  class="form-control" name="TS_ITEM" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <button id='ItemSubmit' type="submit" class="btn btn-primary">บันทึก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row mt-5">
                                <div class="col-12 fs-5">
                                    <table id="tbTransction" style="width:100%" class=" text-center ">
                                        <thead>
                                            <tr>
                                                <th class=" text-center ">#</th>
                                                <th class=" text-center ">รหัส</th>
                                                <th class=" text-center ">ชื่อสินค้า</th>
                                                <th class=" text-center ">จำนวน</th>
                                                <th class=" text-center ">วันที่</th>
                                                <th class=" text-center ">สถานะ</th>
                                            </tr>
                                        </thead>
  
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id='dismiss' type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
        `;



        elements.innerHTML = html;

        const tableTransction = new DataTable('#tbTransction', {
            "lengthMenu": [
                [25, 50, 100, -1], [25, 50, 100, "All"]
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
        tableTransction
            .clear()
            .draw();

        const PostFetchProfile = fetch("<?= base_url('warehouse/getAllTransction'); ?>", {
            method: "POST",
            body: JSON.stringify({ PD_BARCODE: response.PD_BARCODE }),
        });
        let responseTransction = await PostFetchProfile.then((response) => response.json());
        responseTransction.forEach((item, key) => {
            tableTransction.row
                .add([
                    key + 1,
                    item.PD_BARCODE,
                    item.PD_NAME,
                    item.TS_ITEM,
                    getThaiDate(item.TS_STAMP) ?? '-',
                    item.TS_TYPE == 1 ? `<span class=' text-success ' >นำเข้าสินค้า</span>` : `<span  class=' text-danger ' >ส่งออกสินค้า</span>`,
                ])
                .draw(false);
        })

        $("#formSubmitEditProduct :input").attr("disabled", true);
        $("#submit").hide();
        $("#delete").hide();

        JsBarcode("#barcode", response.PD_BARCODE);   // กรณีใช้ผ่าน id 

        let el_PD_IMAG = elements.querySelector("[name='PD_IMAG']");
        el_PD_IMAG.onchange = () => {
            if (!el_PD_IMAG.files || !el_PD_IMAG.files[0]) return;
            let FR = new FileReader();
            FR.addEventListener("load", function (evt) {
                elements.querySelector("#IMAG").src = evt.target.result;
            });
            FR.readAsDataURL(el_PD_IMAG.files[0]);
        }

        document.getElementById("btnEdit").addEventListener("click", function (e) {
            e.preventDefault();
            $("#formSubmitEditProduct :input").attr("disabled", false);
            $("#formSubmitEditProduct :input[name=PD_ITEM]").attr("disabled", true);
            $("#btnEdit").hide();
            $("#submit").show();
            $("#delete").show();
        });

        document.getElementById("delete").addEventListener("click", async function (e) {
            e.preventDefault();

            let data = {
                PD_ID: PD_ID
            };
            const PostFetch = fetch("<?= base_url('warehouse/formSubmitDeleteProduct'); ?>", {
                method: "POST",
                body: JSON.stringify(data)
            });
            let response = await PostFetch.then((response) => response.json());
            if (response.statusCode) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditProduct')).hide()
            }
            tbProducts(document.getElementById('searchProducts').value);
        });


        let formSubmitEditProduct = elements.querySelector("#formSubmitEditProduct");
        formSubmitEditProduct.addEventListener("submit", async function (e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const PostFetch = fetch("<?= base_url('warehouse/formSubmitEditProduct'); ?>", {
                method: "POST",
                body: formData
            });

            let response = await PostFetch.then((response) => response.json());
            if (response.statusCode) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditProduct')).hide()
            }
            tbProducts(document.getElementById('searchProducts').value);
        });


        let formSubmitAddItemProduct = elements.querySelector("#formSubmitAddItemProduct");
        formSubmitAddItemProduct.addEventListener("submit", async function (e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const PostFetch = fetch("<?= base_url('warehouse/formSubmitAddItemProduct'); ?>", {
                method: "POST",
                body: formData
            });

            let response = await PostFetch.then((response) => response.json());
            if (response.statusCode) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditProduct')).hide()
            }

            tbProducts(document.getElementById('searchProducts').value);

        });

    }


    function readFile() {

        if (!this.files || !this.files[0]) return;
        let FR = new FileReader();
        FR.addEventListener("load", function (evt) {
            document.querySelector("#IMAG").src = evt.target.result;
        });

        FR.readAsDataURL(this.files[0]);

    }

    document.getElementById("PD_IMAG").addEventListener("change", readFile);
    document.getElementById("formSubmitAddProduct").addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const PostFetch = fetch("<?= base_url('warehouse/formSubmitAddProduct'); ?>", {
            method: "POST",
            body: formData
        });

        let response = await PostFetch.then((response) => response.json());
        if (response.statusCode) {
            bootstrap.Modal.getInstance(document.getElementById('modalAddProduct')).hide()
        }
        tbProducts(document.getElementById('searchProducts').value);
    });

    $(document).ready(function () {
        tbProducts('');
    });


</script>