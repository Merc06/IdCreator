<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title m-0">ID List</h3>

                    <div class="card-tools d-flex">
                        <button class="btn btn-success btn-sm mr-3" @click.prevent="printView('front')">
                            Front View
                        </button>
                        <button class="btn btn-danger btn-sm mr-3" @click.prevent="printView('back')">
                            Back View
                        </button>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <select class="form-control" v-model="sort" @change.prevent="sortId()">
                                <option value="">Order by:</option>
                                <option value="asc">Date Ascending</option>
                                <option value="des">Date Descending</option>
                                <option value="alp">Name Alphabetical</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-gray">
                                <th>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" v-model="checkall">
                                        </div>
                                    </div>
                                </th>
                                <th>ID#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="userId in ids.data" :key="userId.id">
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="userId.id"
                                                v-model="checked">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ userId.empid }}</td>
                                <td>{{ userId.lastName }}, {{ userId.firstName }} {{ userId.mi }}.</td>
                                <td>{{ userId.type }}</td>
                                <td>{{ userId.status }}</td>
                                <td>
                                    <div class="btn-group">
                                        <!-- <button type="button" class="btn btn-default btn-flat btn-sm" @click.prevent="previewId(userId.id)">
                                            <i class="fas fa-eye"></i>
                                        </button> -->
                                        <button type="button" class="btn btn-default btn-flat btn-sm" @click.prevent="editId(userId)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-flat btn-sm" @click.prevent="deleteId(userId.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- MODAL FOR PRINT VIEW -->
        <div class="modal fade" id="printView" tabindex="-1" role="dialog" aria-labelledby="printViewTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="btn btn-sm btn-primary" @click.prevent="print()">
                            <i class="fas fa-print mr-1"></i>
                            Print
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" id="printable">

                        <div class="row">
                            <div class="col-sm-3 d-flex justify-content-center"
                                v-for="selected in printViewSelected.data" :key="selected.id">
                                <div class="card printid">
                                    <div class="card-body p-0 front" v-if="front">
                                        <div class="logo-container">
                                            <img src="img/png/logo.png" alt="logo" class="logo">
                                        </div>

                                        <div class="photoholder">
                                            <img :src="getPhoto(selected.photo, 1)" alt="photo" class="photo">
                                        </div>

                                        <h1 class="name">
                                            {{ selected.firstName }} {{ selected.mi }}. {{ selected.lastName }}
                                        </h1>
                                        <h3 class="dept">
                                            {{ selected.designation }}
                                        </h3>

                                        <div class="tbl-container">
                                            <table class="info">
                                                <tr>
                                                    <td>ID#</td>
                                                    <td>:</td>
                                                    <td>{{ selected.empid }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact#</td>
                                                    <td>:</td>
                                                    <td>{{ selected.contactno }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="qrcode">
                                            <img :src="getPhoto(selected.qrcode, 3)" alt="qrcode">
                                        </div>

                                        <p class="validity">
                                            Validity: {{ selected.expiration }}
                                        </p>
                                    </div>

                                    <div class="card-body p-0 back" v-else>
                                        <h3>Personal Info</h3>

                                        <div class="tbl-container">
                                            <table class="info">
                                                <tr>
                                                    <td>Address</td>
                                                    <td>:</td>
                                                    <td>{{ selected.address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Birthdate</td>
                                                    <td>:</td>
                                                    <td>{{ selected.bday }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <h3>In case of emergency</h3>

                                        <div class="tbl-container">
                                            <table class="info">
                                                <tr>
                                                    <td>Please Notify</td>
                                                    <td>:</td>
                                                    <td>{{ selected.address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>:</td>
                                                    <td>{{ selected.cpa }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact#</td>
                                                    <td>:</td>
                                                    <td>{{ selected.cpc }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="signature">
                                            <img :src="getPhoto(selected.sign, 2)" alt="">
                                        </div>

                                        <p class="ppsi">
                                            Unit 602A, Summit One Tower Shaw Blvd.<br>
                                            Mandaluyong City / 123-1234 / 123-1234<br>
                                            <span>www.pierreandpaulsolinc.com/</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                ids: {},
                sort: '',
                checkall: false,
                checked: [],
                printViewSelected: {},
                front: true
            }
        },

        methods: {
            loadId() {
                axios.get('api/loadid').then((data) => {
                    this.ids = data;
                    // console.log(data);
                });
            },

            sortId() {
                axios.get('api/sortid?q=' + this.sort).then((data) => {
                    this.ids = data;
                    // console.log(data);
                });
            },

            printView(view) {
                if (this.checked.length == 0) {
                    toast.fire({
                        type: 'error',
                        title: 'Please select ID in list'
                    });
                } else {
                    axios.get('api/printview?q=' + this.checked).then((data) => {
                        this.printViewSelected = data;
                        $('#printView').modal('show');

                        if (view == 'back') {
                            this.front = false;
                        } else {
                            this.front = true;
                        }
                        // console.log(data);
                    });
                }
            },

            print() {
                let printContents = document.getElementById('printable').innerHTML;
                let originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            },

            getPhoto(photo, num) {
                if (num == 1) {
                    return "img/photo/" + photo;
                } else if (num == 2) {
                    return "img/sign/" + photo;
                } else {
                    return "img/qrcodes/" + photo;
                }
            },

            editId(info) {
                Fire.$emit('afterClickEdit', info);
                $('#modalId').modal('show');
            },

            deleteId(id) {
                swal.fire({
                    title: 'Are you sure you want to delete this?',
                    text: "You won't be able to revert back!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    // Send Request to server
                    if (result.value) {
                        this.$Progress.start();
                        axios.delete('/deleteid/' + id).then(() => {
                            swal.fire(
                                'Deleted!',
                                'ID has been deleted.',
                                'success'
                            );
                            Fire.$emit('afterCreateId');
                            this.$Progress.finish();
                        }).catch(() => {
                            swal.fire('failed!', 'There was something wrong!', 'warning');
                            this.$Progress.fail();
                        });
                    }
                });
            },
        },

        created() {
            this.loadId();

            Fire.$on('afterCreateId', () => {
                this.loadId();
            });
        },
    }

</script>

<style scoped>
    .printid {
        height: 324px;
        width: 204px;
    }

    #printable {
        font-family: Arial, Helvetica, sans-serif;
        /* color: white !important; */
    }

    .logo-container {
        width: 100%;
        padding: .7rem .8rem;
    }

    .logo {
        width: 100%;
        text-align: center;
    }

    .photoholder {
        display: grid;
        /* position: absolute;
        z-index: 2; */
    }

    .photo {
        justify-self: center;
        border-radius: 50%;
        border: 2px solid #15576f;
        height: 80px;
        width: 80px;
    }

    .name {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin-top: .7rem;
        margin-bottom: 0;
        color: white;
    }

    .dept {
        font-size: 12px;
        text-align: center;
        color: #ff6600;
        /* margin-top: .2rem; */
        margin-bottom: .7rem;
    }

    .tbl-container {
        display: grid;
        margin-left: .9rem;
    }

    .info {
        justify-self: center;
        width: 60%;
        font-size: 10px;
        line-height: 1.1rem;
        margin-bottom: .7rem;
        color: white;
    }

    .info tr td:first-child {
        color: #ff6600;
    }

    .qrcode img {
        width: 60px;
        margin: 0 1rem;
        -webkit-box-shadow: 1px 1px 3px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 1px 1px 3px 0px rgba(0,0,0,0.75);
        box-shadow: 1px 1px 3px 0px rgba(0,0,0,0.75);
    }

    .validity {
        text-align: right;
        margin-right: .8rem;
        font-size: 9px;
        color: #ff6600;
        margin-bottom: 0;
    }
    
    .front {
        background: url('/img/png/front_bg.png');
        border: 1px solid gray;
        height: 324px;
        width: 204px;
    }

    .back {
        background: url('/img/png/back_bg.png');
    }

    @page {
        size: landscape;
    }

</style>
