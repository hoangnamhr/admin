<template>
    <div class="container student-detail">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="student_id">Id</label>
                            <input
                                type="text"
                                v-model="params.id"
                                class="form-control"
                                id="student_id"
                                name="Id"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("student_id")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input
                                type="text"
                                v-model="params.full_name"
                                class="form-control"
                                id="fullname"
                                name="fullname"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("fullname")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="classmate">Class</label>
                            <input
                                type="text"
                                v-model="params.class"
                                class="form-control"
                                id="classmate"
                                name="class"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("class")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input
                                tye="number"
                                v-model="params.phone_number"
                                class="form-control"
                                id="phone_number"
                                name="Phone number"
                                v-validate="'required|numeric'"
                            />
                            <span class="error-message">{{
                                errors.first("phone_number")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                v-model="params.email"
                                class="form-control"
                                id="email"
                                name="email"
                                v-validate="'required|email'"
                            />
                            <span class="error-message">{{
                                errors.first("email")
                            }}</span>
                        </div>
                        <button
                            @click="createOrUpdateStudent()"
                            class="btn btn-primary custom-btn"
                        >
                            {{ isUpdate ? "Update" : "Create" }}
                        </button>
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
            params: {},
            isUpdate: false,
        };
    },
    watch: {
        "$route.params.isUpdate": {
            handler: function (isUpdate) {
                if (isUpdate) {
                    this.isUpdate = isUpdate;
                }
            },

            deep: true,
            immediate: true,
        },
        "$route.params.student": {
            handler: function (student) {
                if (student) {
                    this.params.id = student.id;
                    this.params.full_name = student.full_name;
                    this.params.class = student.class;
                    this.params.phone_number = student.phone_number;
                    this.params.email = student.email;
                }
            },

            deep: true,
            immediate: true,
        },
    },
    methods: {
        createOrUpdateStudent() {
            this.$validator.validate().then((result) => {
                if (!result) {
                    return;
                }
                if (this.isUpdate) {
                    this.updateStudent();
                    return;
                }

                this.createStudent();
            });
        },

        updateStudent() {
            axios
                .put("/students", this.params)
                .then((response) => {
                    this.students = response.data;
                    Vue.toasted.success("Updated successful");
                    this.$router.push({ name: "students" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        createStudent() {
            axios
                .post("/students", this.params)
                .then((response) => {
                    this.students = response.data;
                    Vue.toasted.success("Created successful");
                    this.$router.push({ name: "students" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped lang="scss">
.student-detail {
    .error-message {
        color: red;
    }
    .custom-btn {
        margin-top: 10px;
    }
}
</style>
