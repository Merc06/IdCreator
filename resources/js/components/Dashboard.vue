<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="d-flex flex-row">
                            <h3 class="card-title m-0">ID Creator</h3>
                            <a href="" class="ml-2" @click.prevent="modal()" data-toggle="tooltip" title="Create ID">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                   
                    <div class="card-body">
                        
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="addUserTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create new ID</h5>
                        <!-- <h5 class="modal-title">Update ID Info</h5> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Full Name:</label>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input v-model="form.lastName" id="lastName" placeholder="Last Name *" class="form-control" :class="{ 'is-invalid': form.errors.has('lastName') }">
                                                <has-error :form="form" field="lastName"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input v-model="form.firstName" id="firstName" placeholder="First Name *" class="form-control" :class="{ 'is-invalid': form.errors.has('firstName') }">
                                                <has-error :form="form" field="firstName"></has-error>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input v-model="form.mi" id="mi" placeholder="Middle Initial *" class="form-control" :class="{ 'is-invalid': form.errors.has('mi') }">
                                                <has-error :form="form" field="mi"></has-error>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input v-model="form.address" id="address" placeholder="Full Address *" class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                                                <has-error :form="form" field="mi"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">



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
                    lastName: '',
                    firstName: '',
                    mi: '',
                }),
            }
        },
        methods: {
            modal() {
                // this.editMode = false;
                // this.form.reset();
                $('#modalId').modal('show');
            },
            // Trigger Update Id modal
            // editModal(id) {
            //     this.editMode = true;
            //     this.form.reset();
            //     $('#modalId').modal('show');
            //     this.form.fill(id);
            // },
        }
    }
</script>

<style scoped>
   
</style>