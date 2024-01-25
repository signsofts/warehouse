<section id="company-services" class="padding-large">
    <div class="container p-5">
        <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                ข้อมูลพนักงาน</h2>
            <div class="btn-right fs-4">
                <a class="nav-link me-4" href="javascript:void()" data-bs-toggle="modal"
                    data-bs-target="#modalAddEmployee">
                    <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มพนักงาน</a>
            </div>
        </div>
        <h3 class="mb-5"></h3>
        <div class="row bg-gray p-5 ">
            <div class="  col-lg-12 col-md-12 pb-3">
                <div class="icon-box d-flex justify-content-center ">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="cart-outline">
                            <use xlink:href="#cart-outline" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">พนักงานทั้งหมด</h3>
                        <h2> <span id="EmSum"></span> คน</h2>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="row mt-5">
            <div class="col-12 fs-5">
                <table id="tbEmployee" style="width:100%" class=" text-center ">
                    <thead>
                        <tr>
                            <th class=" text-center ">#</th>
                            <th class=" text-center ">รหัส</th>
                            <th class=" text-center ">ชื่อ</th>
                            <th class=" text-center ">เบอร์</th>
                            <th class=" text-center ">วันที่เริ่มทำงาน</th>
                            <th class=" text-center ">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade" id="modalAddEmployee" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl fs-4 " >
            <div class="modal-content">
                <form id="formSubmitAddEmployee" action="javascript:void(0)" method="post">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มพนักงาน</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">ชื่อพนักงาน</label>
                                    <input type="text" class="form-control" required name="EM_NAME">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">นามสกุลพนักงาน</label>
                                    <input type="text" class="form-control" required name="EM_LASTNAME">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" required name="EM_USERNAME">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">รหัสผ่าน</label>
                                    <input type="password" class="form-control" required name="EM_PASSWORD">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">วันเกิด</label>
                                    <input type="date" class="form-control" required name="EM_BIRTHDAY">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">เบอร์ติดต่อ</label>
                                    <input type="tel" class="form-control" required name="EM_PHONE">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">วันที่เริ่มทำงาน</label>
                                    <input type="date" value="<?= date("Y-m-d") ?>" class="form-control" required
                                        name="EM_DSTART">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">ที่อยู่</label>
                                    <textarea required name="EM_ADDRESS" class="form-control" id="" cols="30"
                                        rows="2"> </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">เพิ่มพนักงาน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditProduct" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl fs-4 ">
            <div id="modal-content-EditProduct" class="modal-content">
            </div>
        </div>
    </div>

</section>


<script>



    async function emInfoEdit(EM_ID) {
        let data = {
            EM_ID: EM_ID
        };
        const PostFetch = fetch("<?= base_url('warehouse/emInfoEdit'); ?>", {
            method: "POST",
            body: JSON.stringify(data),
        });

        let response = await PostFetch.then((response) => response.json());
        let html = `
                    <form id="formSubmitEditEmployee" action="javascript:void(0)" method="post" >
                        <input type="hidden" required name="EM_ID" value='${EM_ID}'>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขพนักงาน ${response.EM_CODE}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ชื่อพนักงาน</label>
                                        <input type="text" class="form-control" required name="EM_NAME" value='${response.EM_NAME}' >
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">นามสกุลพนักงาน</label>
                                        <input type="text" class="form-control" required name="EM_LASTNAME" value='${response.EM_LASTNAME}'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control" required name="EM_USERNAME" value='${response.EM_USERNAME}'>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">รหัสผ่าน</label>
                                        <input type="text" class="form-control" required name="EM_PASSWORD" value='${response.EM_PASSWORD}'>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">วันเกิด</label>
                                        <input type="date" class="form-control" required name="EM_BIRTHDAY" value='${response.EM_BIRTHDAY}' >
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">เบอร์ติดต่อ</label>
                                        <input type="tel" class="form-control" required name="EM_PHONE" value='${response.EM_PHONE}'>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">วันที่เริ่มทำงาน</label>
                                        <input type="date" class="form-control" required name="EM_DSTART" value='${response.EM_DSTART}'>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ที่อยู่</label>
                                        <textarea required name="EM_ADDRESS" class="form-control" id="" cols="30" rows="2">${response.EM_ADDRESS}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary">แก้ไขพนักงาน</button>
                        </div>
                    </form>
                `;

        document.getElementById("modal-content-EditProduct").innerHTML = html;
        document.getElementById("formSubmitEditEmployee").addEventListener("submit", async function (e) {
            e.preventDefault();


            const formData = new FormData(e.target);
            const PostFetch = fetch("<?= base_url('warehouse/formSubmitEditEmployee'); ?>", {
                method: "POST",
                body: formData
            });

            let response = await PostFetch.then((response) => response.json());

            if (response.statusCode) {
                bootstrap.Modal.getInstance(document.getElementById('modalEditProduct')).hide()
            }

            tbEmployee();
        });
    }

    const table = new DataTable('#tbEmployee', {
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

    document.getElementById("formSubmitAddEmployee").addEventListener("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const PostFetch = fetch("<?= base_url('warehouse/formSubmitAddEmployee'); ?>", {
            method: "POST",
            body: formData
        });

        let response = await PostFetch.then((response) => response.json());
        if (response.statusCode) {
            bootstrap.Modal.getInstance(document.getElementById('modalAddEmployee')).hide()
        }
        tbEmployee();
    });


    function getThaiDate(dateString) {
        const date = new Date(Date.parse(dateString))
        const result = date.toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        })

        return result;
    }


    async function emResign(EM_ID) {

        let data = {
            EM_ID: EM_ID
        };
        const PostFetch = fetch("<?= base_url('warehouse/emResign'); ?>", {
            method: "POST",
            body: JSON.stringify(data),
        });

        let response = await PostFetch.then((response) => response.json());

        if (response.statusCode) {
            alert('บันทึกสำเร็จ');
        }

        tbEmployee();
    }

    async function tbEmployee() {

        table
            .clear()
            .draw();
        let data = {

        };
        const PostFetch = fetch("<?= base_url('warehouse/getAllEmployee'); ?>", {
            method: "POST",
            body: JSON.stringify(data),
        });

        let response = await PostFetch.then((response) => response.json());

        document.getElementById("EmSum").innerHTML = response.length;

        response.forEach((item, key) => {
            table.row
                .add([
                    key + 1,
                    item.EM_CODE,
                    item.EM_NAME + " " + item.EM_LASTNAME,
                    item.EM_PHONE,
                    getThaiDate(item.EM_DSTART) ?? '-',
                    `<button type="button" data-bs-toggle="modal" data-bs-target="#modalEditProduct"  class="btn btn-sm btn-primary" onclick="emInfoEdit('${item.EM_ID}')" >ข้อมูล / แก้ไข</button> <button type="button" class="btn btn-sm btn-outline-danger" onclick="emResign('${item.EM_ID}')" >ออก</button>`,
                ])
                .draw(false);
        });
    }

    $(document).ready(function () {



        tbEmployee();
    });
</script>