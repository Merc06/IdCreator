<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title m-0">ID List</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <select class="form-control">
                                <option>Order by:</option>
                                <option>Date Ascending</option>
                                <option>Date Descending</option>
                                <option>Name Alphabetical</option>
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
                                            <input class="form-check-input" type="checkbox" value="option1">
                                        </div>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="option1">
                                        </div>
                                    </div>
                                </td>
                                <td>John Doe</td>
                                <td>11-7-2014</td>
                                <td><span class="tag tag-success">Approved</span></td>
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            ids: {},
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
            axios.get('/loadid').then((data) => {
                this.ids = data;
                console.log(data);
            });
        }
    },

    created() {
        this.loadId();
    }
}
</script>