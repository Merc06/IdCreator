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
                                            <input class="form-check-input" type="checkbox" @change="checkAll()" v-model="allChecked">
                                        </div>
                                    </div>
                                </th>
                                <th>ID#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Expiration</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="userId in ids.data" :key="userId.id">
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" :value="userId.id"
                                                v-model="checked" @change="check">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ userId.empid }}</td>
                                <td>{{ userId.lastName }}, {{ userId.firstName }} {{ userId.mi }}.</td>
                                <td>{{ userId.type }}</td>
                                <td>{{ userId.status }}</td>
                                <td>{{ userId.created_at }} - {{ userId.expiration }}</td>
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

                        <div class="row" v-if="front">
                            <div class="col-sm-3 d-flex align-items-center justify-content-center pr-0"
                                v-for="selected in printViewSelected.data" :key="selected.id">
                                <div class="card printidf">
                                    <div class="card-body p-0 front">

                                        <div class="idContainer">
                                            <img :src="getPhoto(selected.photo, 1)" alt="photo" class="photo">
                                        
											<h1 class="name">
												{{ selected.firstName }} {{ selected.mi }}. {{ selected.lastName }}
											</h1>
											
											<p class="idno">{{ selected.empid }}</p>
											
											<p class="dept">
												{{ selected.designation }}
											</p>

											<span v-if="selected.sign != null">
    											<img :src="getPhoto(selected.sign, 2)" alt="sign" class="sign">
                                            </span>

											<p class="validity">
												Date Validity: {{ selected.expiration }}
											</p>
										
											<barcode :value="selected.empid" height="20" displayValue="false" width="1">
												Show this if the rendering fails.
											</barcode>
										</div>
										
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row flip" v-else>
                            <div class="col-sm-3 d-flex justify-content-center pr-0"
                                v-for="selected in printViewSelected.data" :key="selected.id">
                                <div class="card printidb">

                                    <div class="card-body p-0 back">
                                        <h3>Personal Info</h3>

                                        <div class="tbl-container">
                                            <table class="info">
                                                <tr>
                                                    <td>Address</td>
                                                    <td>:</td>
                                                    <td>{{ selected.address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact#</td>
                                                    <td>:</td>
                                                    <td>{{ selected.contactno }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Birthdate</td>
                                                    <td>:</td>
                                                    <td>{{ selected.bday }}</td>
                                                </tr>
                                                <template v-if="selected.type == 'employee'">
                                                <tr>
                                                    <td>TIN</td>
                                                    <td>:</td>
                                                    <td>{{ selected.tin }}</td>
                                                </tr>
                                                <tr>
                                                    <td>SSS</td>
                                                    <td>:</td>
                                                    <td>{{ selected.sss }}</td>
                                                </tr>
                                                <tr>
                                                    <td>PhilHealth</td>
                                                    <td>:</td>
                                                    <td>{{ selected.philhealth }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pag-ibig</td>
                                                    <td>:</td>
                                                    <td>{{ selected.pagibig }}</td>
                                                </tr>
                                                </template>
                                                <template v-else>
                                                <tr>
                                                    <td>School</td>
                                                    <td>:</td>
                                                    <td>{{ selected.school }}</td>
                                                </tr>
                                                <tr>
                                                    <td>HRS</td>
                                                    <td>:</td>
                                                    <td>{{ selected.hrs }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Adviser</td>
                                                    <td>:</td>
                                                    <td>{{ selected.adv }}</td>
                                                </tr>
                                                </template>
                                            </table>
                                        </div>
                                        
                                        <h3>In case of emergency</h3>

                                        <div class="tbl-container">
                                            <table class="info">
                                                <tr>
                                                    <td>Notify</td>
                                                    <td>:</td>
                                                    <td>{{ selected.contactPerson }}</td>
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
	import VueBarcode from 'vue-barcode';

    export default {
        data() {
            return {
                ids: {},
                sort: '',
                checked: [],
                allChecked: false,
                printViewSelected: {},
                front: true
            }
        },
		
		components: {
			'barcode': VueBarcode
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

                axios.get('api/printed?q='+this.checked).then((data) => {
                    console.log(data);
                    location.reload();
                    this.loadId();
                });

                // setTimeout(() => {
                    
                // }, 100)

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

            checkAll() {
                if(this.allChecked) {
                    this.checked = [];
                    // this.allChecked = !this.allChecked;
                    console.log(this.ids.data.length);
                    let i = this.ids.data.length;
                    for(let a = 0; a < i; a++) {
                        this.checked.push(this.ids.data[a].id);
                    }

                    // this.ids.forEach((userId) => {
                    //     this.checked.push(userId.id);
                    //     // console.log(this.ids[userId]);
                    // });
                } else {
                    this.checked = [];
                }
            },

            check() {
                this.allChecked = false;
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
	.printidf {
		height: 338px;
		width: 215px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
        margin-bottom: 1.1rem !important;
        margin-top: 1.2rem !important;
	}

    .printidb {
        height: 338px;
        width: 215px;
        margin-bottom: 1.1rem !important;
        margin-top: 1.2rem !important;
    }

    .flip {
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

	
    .front {
		background: url('/img/png/bg1.png');
		background-size: cover;
		padding-left: 2.6rem !important;
	}
	
	.idContainer {
		display: grid;
		justify-items: center;
		margin-top: 1.6rem;
	}
	
	.idContainer .photo {
		border-radius: 50%;
		border: 1px solid black;
		width: 80px;
		height: 80px;
	}
	
	.name {
		font-size: 14px;
		font-weight: bold;
		margin-top: 1rem;
        text-align: center;
	}
	
	.idno {
		font-size: 12px;
	}
	
	.dept {
		font-size: 12px;
	}
	
	.sign {
		height: 30px;
		width: 60px;
        margin-bottom: .5rem;
	}

    .validity {
        margin: 0;
        font-size: 10px;
    }

    .back {
        padding: 1rem !important;
    }

    .back h3 {
        text-align: center;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .back tr td:nth-child(1) {
        width: 30%;
    }

    .back tr td:nth-child(2) {
        width: 10%;
    }

    .back tr td:nth-child(3) {
        width: 80%;
    }

    .tbl-container {
        font-size: 9px;
        margin-bottom: .6rem;
    }

    .ppsi {
        font-size: 8px;
        text-align: center;
    }

    svg {
        max-width: 150px !important;
    }

    @page {
        size: landscape;
    }

</style>
