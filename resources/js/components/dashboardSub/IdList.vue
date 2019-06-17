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
                                        <button type="button" class="btn btn-default btn-flat btn-sm">
                                            <i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-default btn-flat btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-flat btn-sm">
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
                                            <img :src="getPhoto(selected.qrcode, 2)" alt="qrcode">
                                        </div>

                                        <p class="validity">
                                            Validity: {{ selected.expiration }}
                                        </p>
                                    </div>

                                    <div class="card-body p-0 back" v-else>
                                        <h1>Back View!!!</h1>
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
                front: true,
                form: new Form({
                    type: '',
                    lastName: '',
                    firstName: '',
                    mi: '',
                    address: '',
                    contactno: '',
                    designation: '',
                    bday: '',

                    contactPerson: '',
                    cpc: '',
                    cpa: '',

                    tin: '',
                    sss: '',
                    philhealth: '',
                    pagibig: '',

                    school: '',
                    hrs: '',
                    adv: '',
                    advcontact: '',

                    photo: '',
                    sign: ''
                }),
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
                        console.log(data);
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
                } else {
                    return "img/qrcodes/" + photo;
                }
            }
        },

        created() {
            this.loadId();
        }
    }

</script>

<style scoped>
    .printid {
        height: 324px;
        width: 204px;
    }

    #printable {
        font-family: Arial, Helvetica, sans-serif;
    }

    @page {
        size: landscape
    }

    .logo-container {
        width: 100%;
        padding: .8rem;
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
        border: 2px solid #ff6600;
        height: 80px;
        width: 80px;
    }

    .name {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin-top: .8rem;
        margin-bottom: 0;
    }

    .dept {
        font-size: 12px;
        text-align: center;
        color: #ff6600;
        margin-top: .4rem;
        margin-bottom: .8rem;
    }

    .tbl-container {
        display: grid;
        margin-left: .9rem;
    }

    .info {
        justify-self: center;
        width: 60%;
        font-size: 8px;
        line-height: 1.2rem;
    }

    .qrcode img {
        width: 50px;
        margin: 0 .9rem;
    }

    .validity {
        text-align: right;
        margin-right: .9rem;
        font-size: 7px;
    }

</style>
