<template>

    <div class="d-flex flex-row">
        <h3 class="card-title m-0">ID Creator</h3>
        <a href="" class="ml-2" @click.prevent="modal()" data-toggle="tooltip" title="Create ID">
            <i class="fas fa-plus"></i>
        </a>

        <!-- MODAL -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="addUserTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create new ID</h5>
                        <!-- <h5 class="modal-title">Update ID Info</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createId()">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <label>Type:</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="type" v-model="form.type" type="radio" id="employee" value="employee">
                                            <label class="form-check-label" for="employee">Employee</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="type" v-model="form.type" type="radio" id="ojt" value="ojt">
                                            <label class="form-check-label" for="ojt">OJT</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Personal Info:</label>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" v-model="form.lastName" id="lastName"
                                                    placeholder="Last Name *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('lastName') }">
                                                <has-error :form="form" field="lastName"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" v-model="form.firstName" id="firstName"
                                                    placeholder="First Name *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('firstName') }">
                                                <has-error :form="form" field="firstName"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" v-model="form.mi" id="mi"
                                                    placeholder="Middle Initial *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('mi') }">
                                                <has-error :form="form" field="mi"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" v-model="form.address" id="address"
                                                    placeholder="Full Address *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('address') }">
                                                <has-error :form="form" field="address"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" v-model="form.contactno" id="contactno"
                                                    placeholder="Contact# *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('contactno') }">
                                                <has-error :form="form" field="contactno"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.designation" id="designation"
                                                    placeholder="Designation *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('designation') }">
                                                <has-error :form="form" field="designation"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Birth Date:</label>
                                                <input type="date" v-model="form.bday" id="bday"
                                                    placeholder="Birth date *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('bday') }">
                                                <has-error :form="form" field="bday"></has-error>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <label>Contact Person's Info</label>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.contactPerson" id="contactPerson"
                                                    placeholder="Contact Person *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('contactPerson') }">
                                                <has-error :form="form" field="contactPerson"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" v-model="form.cpc" id="cpc"
                                                    placeholder="Contact Person's# *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('cpc') }">
                                                <has-error :form="form" field="cpc"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" v-model="form.cpa" id="cpa"
                                                    placeholder="Contact Person's Address *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('cpa') }">
                                                <has-error :form="form" field="cpa"></has-error>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <label v-if="form.type == 'employee'">For Employee:</label>
                                    <div class="row" v-if="form.type == 'employee'">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.tin" id="tin" placeholder="TIN# *"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('tin') }">
                                                <has-error :form="form" field="tin"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.sss" id="sss" placeholder="SSS# *"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('sss') }">
                                                <has-error :form="form" field="sss"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.philhealth" id="philhealth"
                                                    placeholder="PhilHealth# *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('philhealth') }">
                                                <has-error :form="form" field="philhealth"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.pagibig" id="pagibig"
                                                    placeholder="PAG-IBIG# *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('pagibig') }">
                                                <has-error :form="form" field="pagibig"></has-error>
                                            </div>
                                        </div>

                                    </div>

                                    <label v-if="form.type == 'ojt'">For OJT:</label>
                                    <div class="row" v-if="form.type == 'ojt'">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.school" id="school"
                                                    placeholder="School *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('school') }">
                                                <has-error :form="form" field="school"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" v-model="form.hrs" id="hrs" placeholder="HRS *"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('hrs') }">
                                                <has-error :form="form" field="hrs"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" v-model="form.adv" id="adv" placeholder="Adviser *"
                                                    class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('adv') }">
                                                <has-error :form="form" field="adv"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" v-model="form.advcontact" id="advcontact"
                                                    placeholder="Contact# *" class="form-control"
                                                    :class="{ 'is-invalid': form.errors.has('advcontact') }">
                                                <has-error :form="form" field="advcontact"></has-error>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Photo:</label>
                                            <div class="form-group">
                                                <input type="file" id="photo" @change="updateFile" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
                                                <has-error :form="form" field="photo"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Signature:</label>
                                            <div class="form-group">
                                                <input type="file" id="sign" @change="updateFile" class="form-control" :class="{ 'is-invalid': form.errors.has('sign') }">
                                                <has-error :form="form" field="sign"></has-error>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create</button>
                            <!-- <button v-show="editMode" type="submit" class="btn btn-primary">Update</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    type: 'employee',
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
            modal() {
                $('#modalId').modal('show');
            },

            updateFile(e) {
                let file = e.target.files[0];
                // console.log(file);
                let reader = new FileReader();

                if(e.srcElement.id == 'photo') {
                    reader.onloadend = (e) => {
                        this.form.photo = reader.result;
                    }
                } else {
                    reader.onloadend = (e) => {
                        this.form.sign = reader.result;
                    }
                }

                reader.readAsDataURL(file);
            },

            createId() {
                this.$Progress.start();
                this.form.post('/createid')
                    .then((data) => {
                        console.log(data);
                        $('#modalId').modal('hide');
                        toast.fire({
                            type: 'success',
                            title: 'ID Created Successfully'
                        });
                        // this.form.reset();
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            }
        }
    }

</script>
